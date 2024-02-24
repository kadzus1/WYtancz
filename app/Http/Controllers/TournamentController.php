<?php

namespace App\Http\Controllers;
use App\Models\Tournament;
use App\Models\Post;
use App\Models\TournamentParticipant;
use App\Models\TournamentResult;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DanceStyle;



class TournamentController extends Controller
{
    public function tournament()
    {
        // Pobierz nadchodzące wydarzenia
        $upcomingEvents = Tournament::where('date', '>=', now())
            ->where('type', 'solowe')
            ->paginate(5);
        
        // Pobierz archiwalne wydarzenia
        $archivedEvents = Tournament::where('date', '<', now())
            ->where('type', 'solowe')
            ->paginate(5);

        // Inicjalizuj zmienną $danceStyles jako pustą tablicę
        $danceStyles = [];

        // Iteruj przez każde wydarzenie i zbierz jego style tańca, jeśli są zapisy
        foreach ($upcomingEvents as $event) {
            if ($event->danceStyles()->exists()) {
                $danceStyles[$event->id] = $event->danceStyles()->pluck('name');
            }
        }

        // Przekaz dane do widoku
        return view('tournaments.tournament', compact('upcomingEvents', 'archivedEvents', 'danceStyles'));
    }
    

    public function tournamentGroup()
{

    // Pobierz nadchodzące wydarzenia
    $upcomingEvents = Tournament::where('date', '>=', now())
    ->where('type', 'grupowe')
    ->paginate(5);

// Pobierz archiwalne wydarzenia
$archivedEvents = Tournament::where('date', '<', now())
    ->where('type', 'grupowe')
    ->paginate(5);

    // Pobierz turnieje
    $tournaments = Tournament::where('type', 'grupowe')->paginate(5);

    // Inicjalizuj zmienną $danceStyles jako pustą tablicę
    $danceStyles = [];
    
    // Iteruj przez każdy turniej i zbierz jego style tańca, jeśli są zapisy
    foreach ($tournaments as $tournament) {
        if ($tournament->danceStyles()->exists()) {
            $danceStyles[$tournament->id] = $tournament->danceStyles()->pluck('name');
        }
    }

    // Przekazanie danych do widoku
    return view('tournaments.tournamentGroup', compact('tournaments', 'danceStyles', 'upcomingEvents', 'archivedEvents'));
}


    public function alltournament()
    {
        // Pobierz dane z tabeli 'tournament'
        $tournaments = Tournament::paginate(10);;

        // Przekaz dane do widoku
        return view('tournaments.user-tournaments.admin.alltournaments', ['tournaments' => $tournaments]);
    }

    public function moretournament($id)
{
    // Pobierz dane z tabeli 'tournament'
    $tournament = Tournament::findOrFail($id);

    // Pobierz przypisane do turnieju style tańca
    $danceStyles = $tournament->danceStyles()->pluck('name');

     // Sprawdź role aktualnie zalogowanego użytkownika
    $userRoles = auth()->user()->roles()->pluck('name'); // Pobierz nazwy ról użytkownika


    // Przekaz dane do widoku, w tym zmienną $isDancer
    return view('tournaments.more', compact('tournament', 'danceStyles', 'userRoles'));
}


    public function create()
    {
        //tutaj pobieramy style dańca
        $danceStyles = DanceStyle::all();
        return view('tournaments.addtournament', compact('danceStyles'));
    }

    public function store(Request $request)
    {
    
    //tu walidacja danceStyles
    $validatedData['danceStyles'] = $request->input('danceStyles');

    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'date' => 'required',
        'numberPeople' => 'required',
        'place' => 'required',
        'fromAge' => 'required|numeric|min:1',
        'toAge' => 'required|numeric|min:' . $request->fromAge,
        'type' => 'required',
        'user_id' => 'required',
        'danceStyles' => 'array|required',
        'danceStyles.*' => 'exists:dance_styles,id', // sprawdzenie, czy wybrane style tańca istnieją w bazie danych
   
    ]);


    // Przypisanie ID zalogowanego użytkownika do pola 'user_id'
    $validatedData['user_id'] = auth()->id();

    // Przypisanie nazwy zalogowanego użytkownika do pola 'organizator'
    $validatedData['organizator'] = auth()->user()->name;
    

    // Zapisanie danych do bazy danych i przypisanie nowego turnieju do zmiennej $tournament
    $tournament = Tournament::create($validatedData);

    // Dodanie wybranych styli tańca do turnieju
    $tournament->danceStyles()->attach($validatedData['danceStyles']);


    return redirect()->route('tournaments.tournament')->with('success', 'Turniej został dodany.');
}


public function dancerJoinForm($id)
{
    $tournament = Tournament::findOrFail($id);
    return view('tournaments.more.joinEventDancer', compact('tournament'));
}

public function joinEventDancer(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
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
    foreach ($request->input('p_name') as $key => $value) {
        $participantsData[] = [
            'p_name' => $request->input('p_name')[$key],
            'p_surname' => $request->input('p_surname')[$key],
            'birthDate' => $request->input('birthDate')[$key],
            'age' => $request->input('age')[$key],
            'town' => $request->input('town')[$key],
            'country' => $request->input('country')[$key],
            'organizator' => isset($request->input('organizator')[$key]) ? $request->input('organizator')[$key] : null,
            'teacherName' => isset($request->input('teacherName')[$key]) ? $request->input('teacherName')[$key] : null,
            'teacherSurname' => isset($request->input('teacherSurname')[$key]) ? $request->input('teacherSurname')[$key] : null,
            'teacherPhoneNumber' => isset($request->input('teacherPhoneNumber')[$key]) ? $request->input('teacherPhoneNumber')[$key] : null,
            'tournament_id' => $id,
            'user_id' => $user_id,
            'dance_style_id' => $request->input('dance_style')[$key],
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
    $user_id = auth()->id();
    $participantsData = [];

    // Dane dla wielu tancerzy
    foreach ($request->input('p_name') as $key => $value) {
        // Sprawdzamy, czy dane są dostępne
        if ($request->input('p_name.' . $key) !== null) {
            $participantsData[] = [
                'p_name' => $request->input('p_name.' . $key),
                'p_surname' => $request->input('p_surname.' . $key),
                'dance_style_id' => $request->input('dance_style.' . $key),
                'birthDate' => $request->input('birthDate.' . $key),
                'age' => $request->input('age.' . $key),
                'town' => $request->input('town.' . $key),
                'country' => $request->input('country.' . $key),
                
                'organizator' => $request->has('organizator') && isset($request->input('organizator')[0]) ? $request->input('organizator')[0] : null,
                'teacherName' => $request->has('teacherName') && isset($request->input('teacherName')[0]) ? $request->input('teacherName')[0] : null,
                'teacherSurname' => $request->has('teacherSurname') && isset($request->input('teacherSurname')[0]) ? $request->input('teacherSurname')[0] : null,
                'teacherPhoneNumber' => $request->has('teacherPhoneNumber') && isset($request->input('teacherPhoneNumber')[0]) ? $request->input('teacherPhoneNumber')[0] : null,
                'tournament_id' => $id,
                'user_id' => $user_id,
                
                
            ];
        }
    }
    // Zapisz dane uczestników do bazy danych
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

    $tournament = Tournament::findOrFail($id);

    // Sprawdź czy zapisy są otwarte
    if (!$tournament->signups_open) {
        return redirect()->route('tournaments.tournament')->with('error', 'Zapisy na ten turniej są już zamknięte.');
    }
    
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

public function startList($tournamentId)
{
    // Pobierz turniej na podstawie ID
    $tournament = Tournament::findOrFail($tournamentId);

    // Pobierz uczestników tego turnieju
    $participants = TournamentParticipant::where('tournament_id', $tournamentId)->get();

     // Dołącz modele DanceStyle do uczestników
     foreach ($participants as $participant) {
        $danceStyle = DanceStyle::find($participant->dance_style_id);
        $participant->dance_style_name = $danceStyle ? $danceStyle->name : 'Brak danych';
    }

    // Przekazanie danych do widoku
    return view('tournaments.more.startList', ['tournament' => $tournament, 'participants' => $participants]);
}


    public function getStatus($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);

        return response()->json([
            'signups_open' => $tournament->signups_open,
            'users_count' => $tournament->participants()->count(),
            'max_users' => $tournament->numberPeople,
        ]);
    }


    public function removeParticipant(Request $request, $id)
{
    // Pobierz zalogowanego użytkownika
    $user = auth()->user();
    
    // Pobierz uczestnika turnieju
    $participant = TournamentParticipant::find($id);

    // Sprawdź, czy użytkownik i uczestnik istnieją
    if (!$user || !$participant) {
        return back()->with('error', 'Nie udało się znaleźć uczestnika.');
    }

    // Sprawdź, czy zalogowany użytkownik jest organizatorem wybranego turnieju
    if ($participant->tournament->user_id !== $user->id) {
        return back()->with('error', 'Nie masz uprawnień do usunięcia tego uczestnika.');
    }

    // Usuń uczestnika turnieju
    $participant->delete();

    // Powiadom użytkownika o sukcesie
    return back()->with('success', 'Uczestnik został pomyślnie usunięty.');
}


//Dla fullcalendar
public function getTournamentDates()
    {

        $posts = Post::latest()->take(5)->get();


       // Pobierz daty turniejów z tabeli 'tournaments'
       $tournaments = Tournament::all();
       
       // Utwórz tablicę zdarzeń kalendarza
       $events = [];
       foreach ($tournaments as $tournament) {
           $events[] = [
               'title' => $tournament->name,
               'start' => $tournament->date, // Data rozpoczęcia turnieju
           ];
       }
       
       // Zwróć widok z przekazaniem danych
       return view('welcome', ['events'=>$events, 'posts' => $posts]);
       

    }

    //Dla wyników
    public function results($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);
        // Pobierz style tańca dla danego turnieju
        $danceStyles = DanceStyle::all();
        
        // Inicjalizuj pustą tablicę uczestników dla każdego stylu tańca
        $participants = [];
    
        // Dla każdego stylu tańca pobierz uczestników i posortuj ich malejąco według liczby punktów
    foreach ($danceStyles as $style) {
        $participants[$style->id] = TournamentParticipant::where('tournament_id', $tournamentId)
            ->where('dance_style_id', $style->id)
            ->get()
            ->sortByDesc(function ($participant) {
                return $participant->results->sum('points');
            });
    }
    
        // Zwróć widok wraz z danymi uczestników, stylami tańca i identyfikatorem turnieju
        return view('tournaments.results', compact('danceStyles', 'participants', 'tournamentId'));
    }
    
    

    public function save_results(Request $request)
{
    $points = $request->input('points');

    foreach ($points as $participantId => $pointsValue) {
        // Sprawdź czy wartość punktów nie jest pusta
        if ($pointsValue !== null) {
            // Sprawdź, czy dla tego uczestnika istnieją już wyniki w bazie danych
            $existingResult = TournamentResult::where('participant_id', $participantId)
                ->where('tournament_id', $request->input('tournament_id'))
                ->first();

            // Jeśli istnieją wyniki, zaktualizuj je
            if ($existingResult) {
                $existingResult->points = $pointsValue;
                $existingResult->save();
            } else {
                // W przeciwnym razie stwórz nowy rekord
                $result = new TournamentResult();
                $result->tournament_id = $request->input('tournament_id');
                $result->participant_id = $participantId;
                $result->user_id = auth()->user()->id;
                $result->style_id = $request->input('style_id'); // Możesz zmienić na odpowiednie pole, które określa styl
                $result->points = $pointsValue;
                $result->save();
            }
        }
    }

    return redirect()->back()->with('success', 'Wyniki zostały pomyślnie zapisane.');
}

    


}
