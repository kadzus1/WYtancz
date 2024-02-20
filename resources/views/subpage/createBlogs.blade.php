@include('layouts.navigation')


    <x-guest-layout>

        <form action="{{ route('store-post') }}" method="POST" enctype="multipart/form-data">

      @csrf
    
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Tytuł')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"  required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
    
            <br>
            <!-- Description -->
            <div>
                <x-input-label for="content" :value="__('Opis')" />
                <x-text-input id="content" class="block mt-1 w-full" type="text" name="content"  required autofocus />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>
    
             <!-- Image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Zdjęcie')" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" required />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
          
            <div class="text-center mt-4">
                <button id="saveButton" class="py-2.5 px-5 text-red-700 me-2 mb-2 text-sm font-medium focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <i class="fas fa-floppy-disk mr-2"></i>Dodaj post
                </button>
            </div>
</form>

    </x-guest-layout>