<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informacje o Turnieju') }}
        </h2>
    </header>

    <form method="post" action="#" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nazwa') }}
            </label>
            <input type="text" name="name" id="name" value="{{ $tournament->name }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Opis') }}
            </label>
            <textarea name="description" id="description" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">{{ $tournament->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="place" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Miejsce') }}
            </label>
            <input type="text" name="place" id="place" value="{{ $tournament->place }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="numberPeople" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Liczba osób') }}
            </label>
            <input type="text" name="numberPeople" id="numberPeople" value="{{ $tournament->numberPeople }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="organizator" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Organizator') }}
            </label>
            <input type="text" name="organizator" id="organizator" value="{{ $tournament->organizator }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="fromAge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Od wieku') }}
            </label>
            <input type="text" name="fromAge" id="fromAge" value="{{ $tournament->fromAge }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="toAge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Do wieku') }}
            </label>
            <input type="text" name="toAge" id="toAge" value="{{ $tournament->toAge }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Data') }}
            </label>
            <input type="text" name="date" id="date" value="{{ $tournament->date }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>
        
    </form>
</section>
