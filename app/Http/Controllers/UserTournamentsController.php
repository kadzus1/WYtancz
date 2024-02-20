<?php

namespace App\Http\Controllers;

use App\Models\DanceStyle;
use Illuminate\Http\Request;

use App\Models\Tournament;

class UserTournamentsController extends Controller
{
    public function usertournaments()
    {
        // Pobierz wszystkie turnieje utworzone przez zalogowanego użytkownika
        $userTournaments = Tournament::where('user_id', auth()->id())->get();

        // Przekaz dane do widoku
        return view('tournaments.user-tournaments.usertournaments', ['userTournaments' => $userTournaments]);
    }

    public function show($id)
{
    // Pobierz szczegóły turnieju
    $tournament = Tournament::findOrFail($id);
    // Pobierz wszystkie dostępne style tańca
   $allDanceStyles = DanceStyle::all();

    // Przekaz dane do widoku
    return view('tournaments.user-tournaments.edit-tournament', compact('tournament', 'allDanceStyles'));

}


    public function edit($id)
{
    // Pobierz szczegóły turnieju do edycji
    $tournament = Tournament::findOrFail($id);

    // Przekaz dane do widoku
    return view('tournaments.user-tournaments.edit-tournament', compact('tournament'));
}

public function update(Request $request, $id)
{
    // Pobierz turniej do aktualizacji
    $tournament = Tournament::findOrFail($id);

    // Pobierz wszystkie dostępne style tańca
    $allDanceStyles = DanceStyle::all();

    // Sprawdź, czy pole signups_open jest obecne w żądaniu
    if ($request->has('signups_open')) {
        // Aktualizuj wartość pola signups_open na podstawie przekazanej wartości z formularza
        $tournament->signups_open = $request->input('signups_open');
    }

    // Aktualizacja pozostałych danych turnieju
    $tournament->update($request->except('signups_open'));

    // Pobierz zaznaczone style tańca z żądania
    $selectedDanceStyles = $request->input('danceStyles', []);

    // Zaktualizuj style tańca turnieju używając metody sync
    $tournament->danceStyles()->sync($selectedDanceStyles);

    return view('tournaments.user-tournaments.edit-tournament', compact('tournament', 'allDanceStyles'))->with('status', 'Turniej został zaktualizowany.');
}



public function destroy($id)
{
    // Pobierz turniej do usunięcia
    $tournament = Tournament::findOrFail($id);

    // Sprawdź, czy użytkownik jest właścicielem turnieju lub administratorem
    if ($tournament->user_id != auth()->id() && !auth()->user()->hasRole('administrator')) {
        abort(403, 'Unauthorized action.');
    }

    // Usunięcie turnieju
    $tournament->delete();

    // Sprawdź, czy użytkownik ma rolę administratora
    if (auth()->user()->hasRole('administrator')) {
        // Jeśli użytkownik jest administratorem, pozostań na stronie alltournaments
        return redirect()->route('tournaments.user-tournaments.admin.alltournaments')->with('success', 'Turniej został usunięty.');
    } else {
        // W przeciwnym razie przenieś użytkownika do usertournaments
        return redirect()->route('tournaments.user-tournaments.usertournaments')->with('success', 'Turniej został usunięty.');
    }
}





}
