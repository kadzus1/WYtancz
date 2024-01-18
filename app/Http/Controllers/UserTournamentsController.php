<?php

namespace App\Http\Controllers;

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

    // Przekaz dane do widoku
    return view('tournaments.user-tournaments.edit-tournament', compact('tournament'));

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

    // Aktualizacja danych turnieju
    $tournament->update($request->all());

    return redirect()->route('tournaments.user-tournaments.edit-tournament', $tournament->id);
}
public function destroy($id)
{
    // Pobierz turniej do usunięcia
    $tournament = Tournament::findOrFail($id);

    // Sprawdź, czy użytkownik jest właścicielem turnieju
    if ($tournament->user_id != auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Usunięcie turnieju
    $tournament->delete();

    return redirect()->route('tournaments.user-tournaments.usertournaments')->with('success', 'Turniej został usunięty.');
}
}
