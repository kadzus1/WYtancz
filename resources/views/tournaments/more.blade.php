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
        <h3 style="font-size: 2em; color: black; margin-top: 10px;"><a href="{{ route('startList', ['tournamentId' => $tournament->id]) }}">Listy startowe</a></h3>     
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
    
            var tournamentId = this.getAttribute('data-tournament-id');
    
            if ({{ auth()->check() ? 'true' : 'false' }}) {
                fetch(`/api/tournaments/${tournamentId}/status`)
                    .then(response => response.json())
                    .then(data => {
            if (data.signups_open) {
                if (data.users_count >= data.max_users) {
                Swal.fire({
                    title: 'Brak miejsc',
                    text: 'Limit miejsc na to wydarzenie został wyczerpany.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Dołącz do wydarzenia',
                    text: 'Czy na pewno chcesz dołączyć do tego wydarzenia?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Tak, dołącz!',
                    cancelButtonText: 'Anuluj'
                }).then((result) => {
                                if (result.isConfirmed) {
                                    // Przekazanie ról użytkownika do SweetAlert
                                    var userRoles = "{{ $userRoles }}";
    
                                    // Wyświetlenie odpowiedniego formularza w zależności od ról użytkownika
                                    if (userRoles.includes('tancerz') && userRoles.includes('szkola_tanca')) {
                                        // Jeśli użytkownik jest zarówno tancerzem, jak i szkołą tańca, wyświetl opcję wyboru formularza
                                        Swal.fire({
                                            title: 'Wybierz formularz',
                                            text: 'Wybierz odpowiedni formularz:',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonText: 'Tancerz',
                                            cancelButtonText: 'Szkoła tańca'
                                        }).then((choice) => {
                                            if (choice.isConfirmed) {
                                                window.location.href = `/tournaments/more/joinEventDancer/${tournamentId}`;
                                            } else {
                                                window.location.href = `/tournaments/more/joinEventSchool/${tournamentId}`;
                                            }
                                        });
                                    } else if (userRoles.includes('tancerz')) {
                                        // Jeśli użytkownik jest tancerzem, przekieruj go do formularza tancerza
                                        window.location.href = `/tournaments/more/joinEventDancer/${tournamentId}`;
                                    } else if (userRoles.includes('szkola_tanca')) {
                                        // Jeśli użytkownik jest szkołą tańca, przekieruj go do formularza szkoły tańca
                                        window.location.href = `/tournaments/more/joinEventSchool/${tournamentId}`;
                                    } else {
                                        // Obsługa przypadku, gdy użytkownik nie ma żadnej z wymienionych ról
                                        Swal.fire({
                                            title: 'Brak uprawnień',
                                            text: 'Nie masz wymaganych uprawnień do dołączenia do wydarzenia.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                }
                            });
                        } 
                            }else {
                                Swal.fire({
                                    title: 'Zapisy zamknięte',
                                    text: 'Zapisy na ten turniej są już zamknięte, ale są jeszcze wolne miejsca.',
                                    icon: 'warning',
                                    confirmButtonText: 'OK'
                                });
                            }
                        
                    });
            } else {
                Swal.fire({
                    title: 'Musisz być zalogowany!',
                    text: 'Aby dołączyć do wydarzenia, musisz być zalogowany.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Zaloguj',
                    cancelButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
        });
    </script>
    
    
    
</div>

@endsection
