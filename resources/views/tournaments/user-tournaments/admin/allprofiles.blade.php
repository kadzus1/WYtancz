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


<div class="max-w-7xl w-3/4 mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:text-white ">
    @if($profiles->isEmpty())
        <div class="flex items-center justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md my-4">
            <strong>Brak dodanych wydarzeń.</strong>
        </div>
    @else
        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nazwa użytkownika
                    </th>
                    {{-- <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Operacje
                    </th> --}}
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
                @foreach($profiles as $profile)
                    <tr>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $profile->name }}
                        </td>
                       
                            {{-- <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-300 flex items-center">
                                <a href="{{ route('tournaments.user-tournaments.edit-tournament', $tournament->id) }}" class="text-blue-500 hover:underline" title="Edytuj"><i class="fas fa-pencil-alt"></i></a>
                                <span class="ml-2 mr-2">     |     </span>
                                <form method="post" action="{{ route('tournaments.user-tournaments.destroy', $tournament->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"><i class="fas fa-dumpster"></i></button>
                                </form>
                            </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <x-modal name="confirm-tournament-deletion-{{ $tournament->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            Usunięto turniej.
        </x-modal> --}}
    @endif
</div>



@endsection
