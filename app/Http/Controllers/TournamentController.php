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
        
        'p_name.*' => 'required',
        'p_surname.*' => 'required',
        'birthDate.*' => 'required',
        'age.*' => 'required',
        'town.*' => 'required',
        'country.*' => 'required',
        'organizator' => 'nullable',
        'teacherName' => 'nullable',
        'teacherSurname' => 'nullable',
        'teacherPhoneNumber' => 'nullable',
    ]);
    

    $user_id = auth()->id();
    $participantsData = [];

   
    // Dane dla wielu tancerzy
    foreach ($validator['p_name'] as $key => $value) {
        $participantsData[] = [
            'p_name' => $validator['p_name'][$key],
            'p_surname' => $validator['p_surname'][$key],
            'birthDate' => $validator['birthDate'][$key],
            'age' => $validator['age'][$key],
            'town' => $validator['town'][$key],
            'country' => $validator['country'][$key],
            'organizator' => $validator['organizator'][$key],
            'teacherName' => $validator['teacherName'][$key],
            'teacherSurname' => $validator['teacherSurname'][$key],
            'teacherPhoneNumber' => $validator['teacherPhoneNumber'][$key],
            'user_id' => $user_id,
            'tournament_id' => $id,
        ];
    
}


// Zapisz dane uczestników do bazy danych
if (TournamentParticipant::insert($participantsData)) {
    return redirect()->route('tournaments.tournament')->with('success', 'Dołączono do turnieju.');
} else {
    return redirect()->route('tournaments.tournament')->with('error', 'Wystąpił problem podczas zapisywania danych.');
}

}


public function joinEventSchool(Request $request, $id)
{
    
    $validator = $request->validate([
        'p_name.*' => 'required|array',
        'p_surname.*' => 'required|array',
        'birthDate.*' => 'required|array',
        'age.*' => 'required|array',
        'town.*' => 'required|array',
        'country.*' => 'required|array',
        
        'organizator.*' => 'nullable',
        'teacherName.*' => 'nullable',
        'teacherSurname.*' => 'nullable',
        'teacherPhoneNumber.*' => 'nullable',
    ]);
    
    $user_id = auth()->id();
    $participantsData = [];

   
        foreach ($validator['p_name'] as $key => $value) {
            $participantsData[] = [
                'p_name' => $validator['p_name'][$key],
            'p_surname' => $validator['p_surname'][$key],
            'birthDate' => $validator['birthDate'][$key],
            'age' => $validator['age'][$key],
            'town' => $validator['town'][$key],
            'country' => $validator['country'][$key],
            'organizator' => $validator['organizator'][$key],
            'teacherName' => $validator['teacherName'][$key],
            'teacherSurname' => $validator['teacherSurname'][$key],
            'teacherPhoneNumber' => $validator['teacherPhoneNumber'][$key],
            'user_id' => $user_id,
            'tournament_id' => $id,
            ];
        }


    // Zapisz dane do tabeli TournamentParticipant
    if (TournamentParticipant::insert($participantsData)) {
        return redirect()->route('tournaments.tournament')->with('success', 'Tancerze zostali dodani do turnieju.');
    } else {
        return redirect()->route('tournaments.tournament')->with('error', 'Wystąpił błąd podczas zapisywania danych.');
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

public function startList()
    {
        // Pobierz dane z tabeli 'tournament'
        $participants = TournamentParticipant::all();

        // Przekaz dane do widoku
        return view('tournaments.more.startList', ['participants' => $participants]);
    }

}
