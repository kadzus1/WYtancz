@if(auth()->check())
    @include('layouts.navigation')
@else
    @include('layouts.navigationNU')
@endif

<x-guest-layout>
    
    <div class="text-center mt-10">
        <h2 class="text-l font-bold mb-4">Rejestrujesz się na wydarzenie</h2>
        <h2 class="text-2xl font-bold mb-4">{{ $tournament->name }}</h2>
    </div>
    
    <form method="POST" action="{{route('tournaments.dancerJoinForm', ['id' => $tournament->id])}}">
        @csrf
    
        <div class="text-center mt-4">
            <button type="button" onclick="addDancerForm()" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-plus-circle mr-2"></i>Dodaj tancerza
            </button>
        </div>
    
        <!-- Kontener na tancerzy -->
        <div id="dancerContainer" class="mt-4">
            <!-- Początkowa sekcja dla pierwszego tancerza -->
            <div class="hidden dancerSection">
                <!-- Rozdzielnik z liczbą tancerzy -->
                <br><div class="text-center text-l font-medium text-gray-500 mb-2">
                    Tancerz <span id="dancerCount">1</span>
                    <hr class="my-2 ">
                </div>

                <div>
                    <x-input-label for="p_name[]" :value="__('Imię')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="p_name[]" required autofocus />
                    <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
                </div>
    
                <div>
                    <x-input-label for="p_surname[]" :value="__('Nazwisko')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="p_surname[]" required autofocus />
                    <x-input-error :messages="$errors->get('p_surname')" class="mt-2" />
                </div>
    
                 <!-- Birth date -->
                <div>
                    <x-input-label for="birthDate[]" :value="__('Data urodzenia')" />
                    <input type="date" id="birthDate" name="birthDate[]" class="mt-1 block w-full" onchange="calculateAge()" />
                    <x-input-error class="mt-2" :messages="$errors->get('birthDate')" />
                </div>

                <br>
                 <!-- Age -->
                <div>
                    <x-input-label for="age[]" :value="__('Wiek')" />
                    <input type="text" id="age" name="age[]" class="mt-1 block w-full" readonly />
                    <x-input-error class="mt-2" :messages="$errors->get('age')" />
                </div>

                <br>
                {{-- Town --}}
                <div>
                    <x-input-label for="city[]" :value="__('Miasto')" />
                    <input id="city" class="block mt-1 w-full" type="text" name="city[]" required autofocus />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <br>
                {{-- Country --}}
                <div>
                    <x-input-label for="country[]" :value="__('Państwo')" />
                    <input id="country" class="block mt-1 w-full" type="text" name="country[]" required autofocus />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>

       <!-- Przycisk zapisu -->
       <button id="saveButton" class="relative py-2.5 px-5 me-2 mb-2 mt-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200" style="display:none;">
        <span class="relative px-10 py-2.5 rounded-md group-hover:bg-opacity-0">
            Zapisz dane
        </span>
    </button>

    
        <script>

            function calculateAge() {
            var birthDate = new Date(document.getElementById('birthDate').value);
            var today = new Date();
    
            var age = today.getFullYear() - birthDate.getFullYear();
    
            // Sprawdzamy, czy urodziny w tym roku już były
            if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }
    
            document.getElementById('age').value = age;
        }

            function addDancerForm() {
                var dancerContainer = document.getElementById('dancerContainer');
                var newDancerSection = dancerContainer.querySelector('.dancerSection').cloneNode(true);
    
                // Zwiększenie liczby tancerzy
                var dancerCount = dancerContainer.children.length;
                document.getElementById('dancerCount').innerText = dancerCount + 1;
    
                // Wyczyszczenie pól formularza w nowej sekcji
                var inputs = newDancerSection.querySelectorAll('input');
                inputs.forEach(function(input) {
                    input.value = '';
                });
    
                dancerContainer.appendChild(newDancerSection);
                newDancerSection.classList.remove('hidden');

                // Pokaż przycisk "Zapisz dane"
        document.getElementById('saveButton').style.display = 'inline-flex';
   
                
            }
        </script>
    </form>
</x-guest-layout>
