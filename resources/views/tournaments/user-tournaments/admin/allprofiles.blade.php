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
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rola
                    </th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Operacje
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600 dark:border-gray-600">
                @foreach($profiles as $profile)
                <tr>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ $profile->name }}
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                        @foreach($profile->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-gray-100">
                        @if(auth()->user()->hasRole('administrator') && $profile->id !== auth()->id())
                            <form method="post" action="{{ route('updateUserRole', $profile->id) }}">
                                @csrf
                                @method('PUT')
                                <select name="role" id="role" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $profile->role && $profile->role->id === $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-indigo-500">Zapisz</button>
                            </form>
                        @else
                            Brak uprawnień do edycji
                        @endif
                    </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
        <div class="mt-4">
            {{ $profiles->links() }}
        </div>
    @endif
</div>

@endsection
