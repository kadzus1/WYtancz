<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informacje o turnieju') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Dodaj podstawowe informacje o Twoim wydarzeniu!") }}
        </p>
    </header>

    <form method="post" action="{{ route('tournaments.store') }}" class="mt-6 space-y-6 ">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nazwa wydarzenia')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Opis')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="date" :value="__('Data')" />
            <input type="date" id="date" name="date" type="text" class="mt-1 block w-full" min="{{ date('Y-m-d') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('date')" />
        </div>

        <div>
            <x-input-label for="organizator" :value="__('Organizator')" />
            <x-text-input id="organizator" name="organizator" type="text" class="mt-1 block w-full" :value="auth()->user()->name" readonly />
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <x-input-error class="mt-2" :messages="$errors->get('organizator')" />
        </div>

        <div>
            <x-input-label for="numberPeople" :value="__('Liczba osób')" />
            <x-number-input id="numberPeople" :min="0" name="numberPeople" min="1" class="mt-1 block w-full" onchange="checkNumber()" />
           <x-input-error class="mt-2" :messages="$errors->get('numberPeople')" />
        </div>

        <div>
            <x-input-label for="place" :value="__('Miejsce')" />
            <x-text-input id="place" name="place" type="text" class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('place')" />
        </div>

        <div>
            <x-input-label for="fromAge" :value="__('Od jakiego wieku')" />
            <x-number-input id="fromAge" :min="0" name="fromAge"  min="1" class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('fromAge')" />
        </div>

        <div>
            <x-input-label for="toAge" :value="__('Do jakiego wieku')" />
            <x-number-input id="toAge" :min="0" name="toAge"  class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('toAge')" />
        </div>

        <fieldset>
            <legend class="text-base font-medium text-gray-900 dark:text-gray-100">{{ __('Style tańca') }}</legend>
            <div class="mt-4 space-y-4">
                <div class="flex items-center">
                    <input id="hip-hop" name="danceStyles[]" type="checkbox" value="hip-hop" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                    <label for="hip-hop" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Hip-hop') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="disco-dance" name="danceStyles[]" type="checkbox" value="disco-dance" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:focus:ring-gray-500 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2">
                    <label for="disco-dance" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Disco Dance') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="balet" name="danceStyles[]" type="checkbox" value="balet" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:focus:ring-gray-500 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2">
                    <label for="balet" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Balet') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="jazz" name="danceStyles[]" type="checkbox" value="jazz" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:focus:ring-gray-500 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2">
                    <label for="jazz" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Jazz') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="nowoczesny" name="danceStyles[]" type="checkbox" value="nowoczesny" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                    <label for="nowoczesny" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Taniec nowoczesny') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="open" name="danceStyles[]" type="checkbox" value="open" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                    <label for="open" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Open') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="latino" name="danceStyles[]" type="checkbox" value="latino" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                    <label for="latino" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Latino') }}</label>
                </div>
        </fieldset>
        <x-input-error class="mt-2" :messages="$errors->get('danceStyles')" />


        {{-- <div>
            <x-input-label for="danceStyles" :value="__('Style tańca')" />
            <select id="danceStyles" name="danceStyles[]" multiple class="mt-1 block w-full">
                <option value="hip-hop">Hip-hop</option>
                <option value="disco-dance">Disco Dance</option>
                <option value="nowoczesny">Taniec nowoczesny</option>
                <option value="jazz">Jazz</option>
                <option value="balet">Balet</option>
                <option value="open">Open</option>
                <option value="latino">Latino</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('danceStyles')" />
        </div> --}}

        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Dodaj turniej') }}</x-primary-button>

            @if (session('status') === 'tournament-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Dodano.') }}</p>
            @endif
        </div>
    </form>
</section>
