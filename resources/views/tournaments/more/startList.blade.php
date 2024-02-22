@extends('layouts.app')

@section('content')

<a href="{{ route('tournaments.tournament') }}" class="back-link ml-2">
    <i class="fas fa-arrow-left"></i> Powrót do turniejów
</a>

<div class="max-w-7xl w-3/4 mx-auto py-3 px-4 sm:px-6 lg:px-8 mt-4 dark:text-white ">
    @if($participants->isEmpty())
    <div class="flex items-center justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md my-4">
        <strong>Brak zapisów.</strong>
    </div>
    @else
    <div class="flex justify-between mb-4">
        <button id="groupByDanceStyle" class="btn btn-primary">Grupuj według stylu tańca</button>
        <button id="removeGrouping" class="btn btn-secondary">Usuń grupowanie</button>
    </div>
    
    <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Numer startowy
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Imię
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nazwisko
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Wiek
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Miasto
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Szkoła Tańca
                </th>
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Styl tańca
                </th>
                @if(auth()->check() && $tournament->user_id === auth()->id())
                <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Operacje
                </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600 ">
            @foreach($participants as $participant)
            <tr>
                <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $participant->id }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->p_name }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->p_surname }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->age }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->town }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->organizator }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    {{ $participant->dance_style_name }}
                </td>
                @if(auth()->check() && $tournament->user_id === auth()->id())
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    <form method="post" action="{{ route('removeParticipant', ['id' => $participant->id]) }}">
                        @csrf
                        @method('delete') <!-- Dodajemy metodę delete -->
                        <button type="submit" class="text-red-500" title="Usuń uczestnika">
                            <i class="fas fa-user-times"></i>
                        </button>
                    </form>
                </td> 
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
<script>
    let originalList = null; // Zmienna przechowująca pierwotną listę przed grupowaniem

    // Funkcja do grupowania według stylu tańca
    function groupByDanceStyle() {
        let groups = {};
        Array.from(document.querySelectorAll('tbody tr')).forEach(row => {
            let danceStyle = row.querySelector('td:nth-child(7)').innerText.trim();
            if (!groups[danceStyle]) {
                groups[danceStyle] = [];
            }
            groups[danceStyle].push(row);
        });
        // Zachowaj pierwotną listę przed grupowaniem
        originalList = document.querySelector('tbody').innerHTML;
        // Wyświetl zgrupowane wyniki
        document.querySelector('tbody').innerHTML = '';
        for (let danceStyle in groups) {
            let groupHeader = document.createElement('tr');
            groupHeader.innerHTML = `<td colspan="7" class="font-bold">${danceStyle}</td>`;
            document.querySelector('tbody').appendChild(groupHeader);
            groups[danceStyle].forEach(row => {
                document.querySelector('tbody').appendChild(row);
            });
        }
    }

    // Funkcja do przywrócenia pierwotnej listy
    function restoreOriginalList() {
        if (originalList) {
            document.querySelector('tbody').innerHTML = originalList;
            originalList = null; // Usuń zapisaną pierwotną listę
        }
    }

    // Obsługa kliknięcia przycisku "Grupuj według stylu tańca"
    document.getElementById('groupByDanceStyle').addEventListener('click', function () {
        groupByDanceStyle();
    });

    // Obsługa kliknięcia przycisku "Usuń grupowanie"
    document.getElementById('removeGrouping').addEventListener('click', function () {
        restoreOriginalList();
    });
</script>

@endsection
