<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function show(Request $request): View
     {
         $profiles = User::paginate(3);
         $roles = Role::all();
 
         return view('tournaments.user-tournaments.admin.allprofiles', compact('profiles', 'roles'));
     }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateUserRole(Request $request, $id): RedirectResponse
    {
        // Validate request
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Find role by ID
        $role = Role::findOrFail($request->role);

        // Assign the role to the user
        $user->syncRoles([$role->name]);

        // Redirect back with success message
        return back()->with('success', 'Rola użytkownika została pomyślnie zaktualizowana.');
    }
}
