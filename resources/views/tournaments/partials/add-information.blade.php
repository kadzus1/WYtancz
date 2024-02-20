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

        <div>
            <x-input-label for="type" :value="__('Typ turnieju')" /><br>
            <div class="flex items-center">
                <input id="solowe" name="type" type="radio" value="solowe" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                <label for="solowe" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Solowy') }}</label>
            </div><br>
            <div class="flex items-center">
                <input id="grupowe" name="type" type="radio" value="grupowe" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                <label for="grupowe" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __('Grupowy') }}</label>
            </div>
        </div>
        

        <fieldset>
            <legend class="text-base font-medium text-gray-900 dark:text-gray-100">{{ __('Style tańca') }}</legend>
            <div class="mt-4 space-y-4">
                @foreach ($danceStyles as $style)
                    <div class="flex items-center">
                        <input id="{{ $style->id }}" name="danceStyles[]" type="checkbox" value="{{ $style->id }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:text-indigo-400 dark:bg-gray-900 dark:checked:bg-indigo-600 dark:checked:border-transparent dark:checked:focus:border-transparent dark:focus:ring-offset-gray-800 dark:focus:ring-offset-2 dark:focus:ring-indigo-500">
                        <label for="{{ $style->id }}" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">{{ __($style->name) }}</label>
                    </div>
                @endforeach
            </div>
        </fieldset>

        <x-input-error class="mt-2" :messages="$errors->get('danceStyles')" />


        
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
