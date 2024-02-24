@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif

@if(auth()->check())
<div class="flex items-center justify-center h-48 dark:bg-gray-800 my-8 ">
    <div class="shadow-md rounded-lg dark:bg-gray-700">
        <a href="{{ route('tournaments.addtournament') }}" class="flex items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-3 px-4 border border-blue-500 hover:border-transparent rounded">
            Dodaj wydarzenie
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 text-blue-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>
</div>
@endif

<div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 mt-4 dark:text-white">
    <h2 class="text-2xl font-bold mb-4">Nadchodzące wydarzenia</h2>
    @if($upcomingEvents->isEmpty())
        <div class="flex items-center justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md my-4">
            <strong>Brak zaplanowanych wydarzeń.</strong>
        </div>
    @else
        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nazwa Turnieju
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zakres wieku: od
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zakres wieku: do
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Liczba osób
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Miejsce
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Style tańca
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Operacje
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
                @foreach($upcomingEvents as $tournament)
                    <tr>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $tournament->name }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->fromAge }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->toAge }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->date }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->participants()->count() }}/{{ $tournament->numberPeople }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->place}}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            @foreach($danceStyles[$tournament->id] as $style)
                                {{ $style }}<br>
                            @endforeach
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300 flex items-center justify-center">
                            <form method="GET" action="{{ route('tournaments.more', ['id' => $tournament->id]) }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-info-circle"></i> Szczegóły
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $upcomingEvents->links() }}
        </div>
    @endif


    <h2 class="text-2xl font-bold mb-4 mt-8">Archiwalne wydarzenia</h2>
    @if($archivedEvents->isEmpty())
        <div class="flex items-center justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md my-4">
            <strong>Brak archiwalnych wydarzeń.</strong>
        </div>
    @else
        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nazwa Turnieju
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zakres wieku: od
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zakres wieku: do
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Liczba osób
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Miejsce
                    </th>
                    <th scope="col" class="py-3 px-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Style tańca
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Szczegóły
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600 text-center">
                @foreach($archivedEvents as $tournament)
                    <tr>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $tournament->name }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->fromAge }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->toAge }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300 ">
                            {{ $tournament->date }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->participants()->count() }}/{{ $tournament->numberPeople }}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            {{ $tournament->place}}
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300">
                            @foreach($danceStyles[$tournament->id] as $style)
                                {{ $style }}<br>
                            @endforeach
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300 flex items-center justify-center">
                            <form method="GET" action="{{ route('tournaments.more', ['id' => $tournament->id]) }}" >
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-info-circle"></i> Szczegóły
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $archivedEvents->links() }}
        </div>
    @endif
</div>

@endsection


