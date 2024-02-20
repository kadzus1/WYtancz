<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Aktualizuj dane o turnieju') }}
        </h2>
    </header>


    <form method="post" action="{{ route('tournaments.user-tournaments.update', $tournament->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <label for="signups_open">Zapisy otwarte?</label>
                <select name="signups_open" class="form-control">
                    <option value="1" {{ $tournament->signups_open ? 'selected' : '' }}>Tak</option>
                    <option value="0" {{ !$tournament->signups_open ? 'selected' : '' }}>Nie</option>
                </select>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nazwa') }}
            </label>
            <input type="text" name="name" id="name" value="{{ $tournament->name }}"
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Opis') }}
            </label>
            <textarea name="description" id="description"
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">{{ $tournament->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="place" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Miejsce') }}
            </label>
            <input type="text" name="place" id="place" value="{{ $tournament->place }}" 
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="numberPeople" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Liczba osób') }}
            </label>
            <input type="text" name="numberPeople" id="numberPeople" value="{{ $tournament->numberPeople }}" 
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="fromAge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Od wieku') }}
            </label>
            <input type="text" name="fromAge" id="fromAge" value="{{ $tournament->fromAge }}" 
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="toAge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Do wieku') }}
            </label>
            <input type="text" name="toAge" id="toAge" value="{{ $tournament->toAge }}" 
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Data') }}
            </label>
            <input type="text" name="date" id="date" value="{{ $tournament->date }}" 
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="danceStyles" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Style tańca') }}
            </label>
            <div class="mt-1 grid grid-cols-2 gap-2" id="danceStylesContainer">
                @foreach($allDanceStyles as $style)
                    @php
                        $isChecked = $tournament->danceStyles->contains('id', $style->id);
                    @endphp
                    <label class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 cursor-pointer dance-style-checkbox">
                        <input type="checkbox" name="danceStyles[]" value="{{ $style->id }}" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ $isChecked ? 'checked' : '' }}>
                        <span class="ml-2">{{ $style->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        
        

        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Typ') }}
            </label>
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="radio" name="type" value="solowe" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ $tournament->type === 'solowe' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Solowe</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="type" value="grupowe" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ $tournament->type === 'grupowe' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Grupowe</span>
                </label>
            </div>
        </div>
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Zapisz') }}</x-primary-button>

            @if (session('status') === 'tournament-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Zapisano.') }}</p>
            @endif
        </div>

    </form>
</section>
