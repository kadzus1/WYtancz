<!-- Formularz -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Aktualizuj dane o turnieju') }}
        </h2>
    </header>

    <form method="post" action="{{ route('posts.update', $post->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nazwa') }}
            </label>
            <input type="text" name="title" id="title" value="{{ $post->title }}"
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Opis') }}
            </label>
            <textarea name="content" id="content"
                class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
                {{ $post->content }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Aktualne zdjęcie') }}
            </label>
            <img src="{{ Storage::url($post->image) }}" alt="Aktualne zdjęcie" class="mt-1 w-full">
        </div>

        <div class="mb-4">
            <label for="new_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nowe zdjęcie') }}
            </label>
            <input type="file" name="new_image" id="new_image" accept="image/*" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-md w-full">
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Zapisz') }}</x-primary-button>
        </div>

    </form>
</section>
``
