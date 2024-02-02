<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tablica') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (auth()->user()->hasRole('tancerz')) {
                    <div class="p-6 text-gray-800">
                        {{ __("Pomyślnie tancerz!") }}
                    </div>
                } @endif
                
                @if (auth()->user()->hasRole('administrator')) {
                    <div class="p-6 text-gray-800">
                        {{ __("Pomyślnie szkoła!") }}
                    </div>
                } @endif



                <div class="p-6 text-gray-800">
                    {{ __("Pomyślnie zalogowano!") }}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
