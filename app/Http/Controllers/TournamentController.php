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
    $validator = $request->validate([
        'p_name' => 'required|array',
        'p_name.*' => 'required',
        'p_surname' => 'required|array',
        'p_surname.*' => 'required',
        'birthDate' => 'required|array',
        'birthDate.*' => 'required',
        'age' => 'required|array',
        'age.*' => 'required',
        'town' => 'required|array',
        'town.*' => 'required',
        'country' => 'required|array',
        'country.*' => 'required',
        'organizator' => 'nullable',
        'teacherName' => 'nullable',
        'teacherSurname' => 'nullable',
        'teacherPhoneNumber' => 'nullable',
    ]);

    $user_id = auth()->id();
    $participantsData = [];

    // Sprawdź, czy dane są pojedyncze czy tablicowe
    if (!is_array($validator['p_name'])) {
        // Dane dla pojedynczego tancerza
        $participantsData[] = [
            'p_name' => $validator['p_name'],
            'p_surname' => $validator['p_surname'],
            'birthDate' => $validator['birthDate'],
            'age' => $validator['age'],
            'town' => $validator['town'],
            'country' => $validator['country'],
            'user_id' => $user_id,
            'tournament_id' => $id,
        ];
    } else {
        // Dane dla wielu tancerzy
        foreach ($validator['p_name'] as $key => $value) {
            $participantsData[] = [
                'p_name' => $value,
                'p_surname' => $validator['p_surname'][$key],
                'birthDate' => $validator['birthDate'][$key],
                'age' => $validator['age'][$key],
                'town' => $validator['town'][$key],
                'country' => $validator['country'][$key],
                'user_id' => $user_id,
                'tournament_id' => $id,
            ];
        }
    }

    // Zapisz dane uczestników do bazy danych
    if (TournamentParticipant::insert($participantsData)) {
        return redirect()->route('tournaments.tournament')->with('success', 'Dołączono do turnieju.');
    } else {
        return redirect()->route('tournaments.tournament')->with('error', 'Wystąpił problem podczas zapisywania danych.');
    }
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
