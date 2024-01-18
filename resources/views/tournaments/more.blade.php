@extends('layouts.app')

@section('content')

<div class="full-width-container" style="width: 100%; font-size: 60px; margin-top: 100px; padding: 20px; box-sizing: border-box; text-align: center;">

    <h3 class="tournament-name">{{ $tournament->name }}</h3>

</div>


<div style="display: flex; justify-content: space-between; margin-top: 200px; height: 200px; padding: 20px; box-sizing: border-box; text-align: center;">

    <div style="width: 30%; border-radius: 20%; padding: 20px; transition: transform 0.3s ease-in-out;">
        <i class="fas fa-calendar" style="font-size: 4em; color: #9d0000; padding:30px; border-radius: 50%;"></i><br>
        <h3 style="font-size: 2em; color: black; margin-top: 10px;">Harmonogram</h3>       
    </div>

    <div style="width: 30%; border-radius: 20%; padding: 20px; transition: transform 0.3s ease-in-out;">
        <i class="fas fa-list" style="font-size: 4em; color: #9d0000; padding:30px; border-radius: 50%;"></i><br>
        <h3 style="font-size: 2em; color: black; margin-top: 10px;">Listy startowe</h3>       
    </div>

    <div style="width: 30%; border-radius: 20%; padding: 20px; transition: transform 0.3s ease-in-out;">
        <i class="fas fa-plus" style="font-size: 4em; color: #9d0000; padding:30px; border-radius: 50%;"></i><br>
        <h3 style="font-size: 2em; color: black; margin-top: 10px;">
            <a href="#" id="joinEventLink" data-tournament-id="{{ $tournament->id }}">Dołącz do wydarzenia</a>
        </h3>
    </div>
    
    <script>
       document.getElementById('joinEventLink').addEventListener('click', function(event) {
    event.preventDefault();

    // Pobierz id turnieju z atrybutu data-tournament-id
    var tournamentId = this.getAttribute('data-tournament-id');

    // Sprawdź, czy użytkownik jest zalogowany
    if ({{ auth()->check() ? 'true' : 'false' }}) {
        // Użytkownik jest zalogowany, otwórz SweetAlert2 modal
        Swal.fire({
            title: 'Dołącz do wydarzenia',
            text: 'Czy na pewno chcesz dołączyć do tego wydarzenia?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Tak, dołącz!',
            cancelButtonText: 'Anuluj'
        }).then((result) => {
            if (result.isConfirmed) {
                // Po kliknięciu "Tak, dołącz!" pytaj o rolę
                Swal.fire({
                    title: 'Wybierz rolę',
                    imageUrl: "{{ asset('storage/css/images/icon.png') }}",
                    imageWidth: 200,
                    imageHeight: 200,
                    showCancelButton: true,
                    confirmButtonText: 'Tancerz',
                    cancelButtonText: 'Szkoła tańca'
                }).then((roleResult) => {
                    if (roleResult.isConfirmed) {
                        // Otwórz formularz dla tancerza
                        // Tutaj możesz przekierować do strony z formularzem dla tancerza
                        window.location.href = "http://127.0.0.1:8000/tournaments/more/joinEventDancer/" + tournamentId;
                    } else {
                        // Otwórz formularz dla szkoły tańca
                        // Tutaj możesz przekierować do strony z formularzem dla szkoły tańca
                        window.location.href = "http://127.0.0.1:8000/tournaments/more/joinEventSchool/" + tournamentId;
                    }
                });
            }
        });
    } else {
        // Użytkownik nie jest zalogowany, otwórz SweetAlert2 modal z dodatkowymi przyciskami
        Swal.fire({
            title: 'Musisz być zalogowany!',
            text: 'Aby dołączyć do wydarzenia, musisz być zalogowany.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Zaloguj',
            cancelButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Przekieruj do formularza logowania
                window.location.href = "{{ route('login') }}";
            }
        });
    }
});

    </script>
    
    
    
    
    

</div>



@endsection