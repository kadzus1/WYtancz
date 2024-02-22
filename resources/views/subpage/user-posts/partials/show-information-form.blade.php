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
            <input type="text" name="name" id="name" value="{{ $post->name }}" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Opis') }}
            </label>
            <textarea name="description" id="description" readonly
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">{{ $post->description }}</textarea>
        </div>
        
    </form>
</section>
