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
                @if(auth()->check() && $tournament->user_id === auth()->id())
                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                    @if(auth()->check() && $tournament->user_id === auth()->id())
                <form method="post" action="{{ route('removeParticipant', ['id' => $participant->id]) }}">
            @csrf
            @method('delete') <!-- Dodajemy metodę delete -->
            <button type="submit" class="text-red-500" title="Usuń uczestnika">
                <i class="fas fa-user-times"></i>
            </button>
        </form>
    </td>
    @endif
@endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
