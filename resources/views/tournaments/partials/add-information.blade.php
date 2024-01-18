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
            <input type="date" id="date" name="date" type="text" class="mt-1 block w-full" />
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
            <x-number-input id="numberPeople" :min="0" name="numberPeople"  class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('numberPeople')" />
        </div>

        <div>
            <x-input-label for="place" :value="__('Miejsce')" />
            <x-text-input id="place" name="place" type="text" class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('place')" />
        </div>

        <div>
            <x-input-label for="fromAge" :value="__('Od jakiego wieku')" />
            <x-number-input id="fromAge" :min="0" name="fromAge"  class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('fromAge')" />
        </div>

        <div>
            <x-input-label for="toAge" :value="__('Do jakiego wieku')" />
            <x-number-input id="toAge" :min="0" name="toAge"  class="mt-1 block w-full"  />
            <x-input-error class="mt-2" :messages="$errors->get('toAge')" />
        </div>

        
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
