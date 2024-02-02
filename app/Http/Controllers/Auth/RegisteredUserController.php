<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:tancerz,szkola_tanca'], // Dodajemy walidację roli
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Przypisanie roli na podstawie wyboru użytkownika
        if ($request->role === 'tancerz') {
            $role = Role::where('name', 'tancerz')->first();
        } elseif ($request->role === 'szkola_tanca') {
            $role = Role::where('name', 'szkola_tanca')->first(); // Sprawdź, czy nazwa roli jest zgodna z bazą danych
        } else {
            // Obsługa błędu: nieprawidłowa rola
            return redirect()->back()->withErrors(['role' => 'Nieprawidłowa rola.']);
        }

        $user->roles()->attach($role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    
}
