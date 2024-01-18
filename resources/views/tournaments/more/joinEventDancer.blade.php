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
    
    <form method="POST" action="{{ route('tournaments.dancerJoinForm', ['id' => $tournament->id]) }}">
   
  @csrf

        <!-- Name -->
        <div>
            <x-input-label for="p_name" :value="__('Imię')" />
            <x-text-input id="p_name" class="block mt-1 w-full" type="text" name="p_name"  required autofocus />
            <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
        </div>

        <br>
        <!-- Surname -->
        <div>
            <x-input-label for="p_surname" :value="__('Nazwisko')" />
            <x-text-input id="p_surname" class="block mt-1 w-full" type="text" name="p_surname"  required autofocus />
            <x-input-error :messages="$errors->get('p_surname')" class="mt-2" />
        </div>

        <br>
        
         <!-- Birth date -->
         <div>
            <x-input-label for="birthDate" :value="__('Data urodzenia')" />
            <input type="date" id="birthDate" name="birthDate" class="mt-1 block w-full" onchange="calculateAge()" />
            <x-input-error class="mt-2" :messages="$errors->get('birthDate')" />
        </div>

        <br>
         <!-- Age -->
         <div>
            <x-input-label for="age" :value="__('Wiek')" />
            <input type="text" id="age" name="age" class="mt-1 block w-full" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <br>
        {{-- Town --}}
        <div>
            <x-input-label for="city" :value="__('Miasto')" />
            <input id="city" class="block mt-1 w-full" type="text" name="city" required autofocus />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <br>
        {{-- Country --}}
        <div>
            <x-input-label for="country" :value="__('Państwo')" />
            <input id="country" class="block mt-1 w-full" type="text" name="country" required autofocus />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>


        <br>



        <!-- Dodaj dane instruktora (przełącznik) -->
        <div class="mb-4">
            <input type="checkbox" id="addInstructor" name="addInstructor" class="form-checkbox h-5 w-5 text-blue-600"/>
            <label for="addInstructor" class="ml-2 text-blue-600 cursor-pointer">Dodaj dane instruktora</label>
        </div>

        <!-- Dane instruktora (rozwijane pola) -->
        <div id="instructorFields" style="display: none;">
            <div>
                <x-input-label for="organizator" :value="__('Organizator')" />
                <input id="organizator" class="block mt-1 w-full" type="text" name="organizator" required autofocus disabled />
                <x-input-error :messages="$errors->get('organizator')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherName" :value="__('Imię instruktora')" />
                <input id="teacherName" class="block mt-1 w-full" type="text" name="teacherName" required autofocus disabled />
                <x-input-error :messages="$errors->get('teacherName')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherSurname" :value="__('Nazwisko instruktora')" />
                <input id="teacherSurname" class="block mt-1 w-full" type="text" name="teacherSurname" required autofocus disabled />
                <x-input-error :messages="$errors->get('teacherSurname')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherPhoneNumber" :value="__('Numer telefonu instruktora')" />
                <input id="teacherPhoneNumber" class="block mt-1 w-full" type="tel" name="teacherPhoneNumber" pattern="[0-9]{1,9}" maxlength="9" required autofocus disabled />
                <x-input-error :messages="$errors->get('teacherPhoneNumber')" class="mt-2" />
            </div>
            <br>
        </div>
        <br>

        <!-- Przycisk zapisu -->
        <button class="relative inline-flex items-center justify-center mx-auto p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span class="relative px-10 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
           Zapisz dane
            </span>
            </button>
        
        


    </form>

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

        document.getElementById('addInstructor').addEventListener('change', function () {
    var instructorFields = document.getElementById('instructorFields');

    if (this.checked) {
        instructorFields.style.display = 'block';
        // Aktywuj pola instruktora
        document.getElementById('organizator').removeAttribute('disabled');
        document.getElementById('teacherName').removeAttribute('disabled');
        document.getElementById('teacherSurame').removeAttribute('disabled');
        document.getElementById('teacherPhoneNumber').removeAttribute('disabled');
    } else {
        instructorFields.style.display = 'none';
        // Zdezaktywuj pola instruktora
        document.getElementById('organizator').setAttribute('disabled', 'disabled');
        document.getElementById('teacherName').setAttribute('disabled', 'disabled');
        document.getElementById('teacherSurame').setAttribute('disabled', 'disabled');
        document.getElementById('teacherPhoneNumber').setAttribute('disabled', 'disabled');
    }
});

    </script>

</x-guest-layout>
