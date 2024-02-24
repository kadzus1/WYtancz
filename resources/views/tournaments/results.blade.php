@extends('layouts.app')

@section('content')
<a href="{{ route('tournaments.tournament') }}" class="back-link ml-2">
    <i class="fas fa-arrow-left"></i> Powrót do turniejów
</a>

<div class="max-w-7xl w-3/4 mx-auto py-3 px-4 sm:px-6 lg:px-8 mt-4 dark:text-white">
    @foreach($danceStyles as $style)
    @if(isset($participants[$style->id]) && !$participants[$style->id]->isEmpty())
    <h3 class="text-lg font-semibold mb-2">{{ $style->name }}</h3>
    <form action="{{ route('save_results') }}" method="post">
        @csrf
        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Numer startowy
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Imię
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nazwisko
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Punkty
                    </th>
                    <th scope="col" class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600 text-center">
                @foreach($participants[$style->id] as $participant)
                <tr>
                    <td>{{ $participant->id }}</td>
                    <td>{{ $participant->p_name }}</td>
                    <td>{{ $participant->p_surname }}</td>
                    
                    <td>
                        @if($participant->results->isNotEmpty())
                            @foreach($participant->results as $result)
                                {{ $result->points }}
                            @endforeach
                        @else
                            Brak wyników
                        @endif
                    </td>

                    @if(auth()->user()->id === $participant->tournament->user_id)
                    <td>
                        <input type="number" name="points[{{ $participant->id }}]" class="form-input" value="{{ old('points.'.$participant->id) }}">
                    </td>
                    @endif

                    <input type="hidden" name="style_id" value="{{ $style->id }}">
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <br>
        <input type="hidden" name="tournament_id" value="{{ $tournamentId }}">
        

        @if(auth()->user()->id === $participant->tournament->user_id)
        <button type="submit" class="btn btn-primary">Zapisz wyniki</button>
        @endif
    </form>
    @endif
    @endforeach
</div>
@endsection
