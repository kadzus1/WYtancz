<?php

    namespace App\Http\Controllers;

    use App\Models\TournamentParticipant;
    use Auth;
    use Illuminate\Http\Request;

    class TournamentParticipantController extends Controller
    {
        public function show($id)
        {
            // $participant = TournamentParticipant::findOrFail($id);
            // return view('participants.show', compact('participant'));
        }

        public function create(Request $request)
        {
            $validatedData = $request->validate([
                'p_name'=> 'required',
                'p_surname'=> 'required',
                'birthDate'=> 'required',
                'age'=> 'required',
                'town'=> 'required',
                'country'=> 'required',
                'organizator' => 'nullable',
                'teacherName' => 'nullable',
                'teacherSurname' => 'nullable',
                'teacherPhoneNumber' => 'nullable',
                // Dodaj resztę walidacji zgodnie z modelem TournamentParticipant
            ]);

           // Przypisanie ID zalogowanego użytkownika do pola 'user_id' lub inne odpowiednie dane
    $validatedData['user_id'] = Auth::id();

    // Przypisanie ID wybranego turnieju do pola 'tournament_id'
    $validatedData['tournament_id'] = $request->input('tournament_id');


    // Zapisanie danych do bazy danych
    TournamentParticipant::create($validatedData);

            return redirect()->route('tournaments.tournament')->with('success', 'Dołączono do turnieju.');
        }

        public function delete($id)
        {
            // Logika usuwania uczestnika turnieju
        }
    }
