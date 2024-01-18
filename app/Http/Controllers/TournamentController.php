<?php

namespace App\Http\Controllers;
use App\Models\Tournament;
use App\Models\Role;
use App\Models\TournamentParticipant;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function tournament()
    {
        // Pobierz dane z tabeli 'tournament'
        $tournaments = Tournament::all();

        // Przekaz dane do widoku
        return view('tournaments.tournament', ['tournaments' => $tournaments]);
    }

    public function moretournament($id)
    {
        // Pobierz dane z tabeli 'tournament'
        $tournament = Tournament::findOrFail($id);

        // Przekaz dane do widoku
        return view('tournaments.more', compact('tournament'));
    }

    public function create()
    {
        return view('tournaments.addtournament');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'date' => 'required',
        'numberPeople' => 'required',
        'place' => 'required',
        'fromAge' => 'required',
        'toAge' => 'required',
        'user_id' => 'required',
    ]);

    // Przypisanie ID zalogowanego użytkownika do pola 'user_id'
    $validatedData['user_id'] = auth()->id();

    // Przypisanie nazwy zalogowanego użytkownika do pola 'organizator'
    $validatedData['organizator'] = auth()->user()->name;

    // Zmiana: Zapisanie danych do bazy danych
    Tournament::create($validatedData);

    return redirect()->route('tournaments.tournament')->with('success', 'Turniej został dodany.');
}

public function dancerJoinForm($id)
{
    $tournament = Tournament::findOrFail($id);
    return view('tournaments.more.joinEventDancer', compact('tournament'));
}

public function joinEventDancer(Request $request, $id)
{
    // Validation logic
    $validatedData = $request->validate([
        'p_name'=> 'required',
        'p_surname'=> 'required',
        'birthDate'=> 'required',
        'age'=> 'required',
        'town'=> 'required',
        'country'=> 'required',
        'organizator' => 'nullable', // dodaj resztę pól
        'teacherName' => 'nullable',
        'teacherSurname' => 'nullable',
        'teacherPhoneNumber' => 'nullable',
        // Add other fields as needed
    ]);

    // Other logic, such as saving to the database
    $tournamentParticipant = new TournamentParticipant($validatedData);
    $tournamentParticipant->user_id = auth()->id();
    $tournamentParticipant->tournament_id = $id;
    $tournamentParticipant->save();

    return redirect()->route('tournaments.tournament')->with('success', 'Dołączono do turnieju.');
}


public function schoolJoinForm($id)
{
    $tournament = Tournament::findOrFail($id);
    return view('tournaments.more.joinEventSchool', compact('tournament'));
}

public function join(Request $request, $id)
{
    // Walidacja danych uczestnika
    $validatedData = $request->validate([
        'p_name' => 'required',
        'p_surname' => 'required',
        'birthDate' => 'required',
        'age' => 'required',
        'town' => 'required',
        'country' => 'required'
    ]);

    // Przypisanie ID zalogowanego użytkownika do pola 'user_id'
    $validatedData['user_id'] = auth()->id();

    // Przypisanie ID wybranego turnieju do pola 'tournament_id'
    $validatedData['tournament_id'] = $id;

    // Zapisanie danych uczestnika do bazy danych
    TournamentParticipant::create($validatedData);

    return redirect()->route('tournaments.tournament')->with('success', 'Dołączono do turnieju.');
}


}
