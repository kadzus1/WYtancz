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
    
    <form method="POST" action="{{ route('tournaments.joinEventSchool', ['id' => $tournament->id]) }}">
        @csrf
    



        <div class="text-center mt-4">
            <button type="button" onclick="addDancerForm()" class="py-2.5 px-5 text-red-700 me-2 mb-2 text-sm font-medium  focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-plus-circle mr-2"></i>Dodaj tancerza
            </button>
        </div>
    
        <!-- Kontener na tancerzy -->
        <div id="dancerContainer" class="mt-4">
            <!-- Początkowa sekcja dla pierwszego tancerza -->
            <div class="hidden dancerSection">
                <!-- Rozdzielnik z liczbą tancerzy -->
                <br><div class="text-center text-l font-medium mb-2 text-gray-900">
                    Tancerz <span id="dancerCount">1</span>
                    <hr class="my-2 ">
                </div>

                <div>
                    <x-input-label :value="__('Imię')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="p_name[]"   />
                    <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
                </div>
    
                <div>
                    <x-input-label :value="__('Nazwisko')" />
                    <x-text-input class="block mt-1 w-full" type="text" name="p_surname[]"   />
                    <x-input-error :messages="$errors->get('p_surname')" class="mt-2" />
                </div>
    
                  <!-- Birth date -->
         <div>
            <x-input-label for="birthDate" :value="__('Data urodzenia')" />
            <input type="date" id="birthDate" name="birthDate[]" class="mt-1 block w-full" oninput="calculateAge()" max="{{ date('Y-m-d') }}"/>
            <x-input-error class="mt-2" :messages="$errors->get('birthDate')" />
        </div>

        <br>
         <!-- Age -->
         <div>
            <x-input-label for="age" :value="__('Wiek')" />
            <input type="text" id="age" name="age[]" readonly/><br>
            <label id="ageErrorMessage" class="text-red-500 hidden"></label>
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>



                <br>
                {{-- Town --}}
                <div>
                    <x-input-label :value="__('Miasto')" />
                    <input class="block mt-1 w-full" type="text" name="town[]" />
                    <x-input-error :messages="$errors->get('town')" class="mt-2" />
                </div>

                <br>
                {{-- Country --}}
                <div>
                    <x-input-label :value="__('Państwo')" />
                    <input class="block mt-1 w-full" type="text" name="country[]" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                <br>

                {{-- Dance Style --}}
            <div>
                <x-input-label :value="__('Styl tańca')" />
                <select class="block mt-1 w-full" name="dance_style[]"">
                    <option value="" selected disabled>Wybierz styl tańca</option>
                    @foreach($tournament->danceStyles as $index => $style)
                        <option value="{{ $style->id }}">{{ $style->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('dance_style')" class="mt-2" />
            </div>
            <br>


            </div>
        </div>



        <!-- Dodaj dane instruktora (przełącznik) -->
        <br><div class="mb-4">
            <input type="checkbox" id="addInstructor" name="addInstructor" class="form-checkbox h-5 w-5 text-red-700"/>
            <label for="addInstructor" class="ml-2 text-red-700 cursor-pointer">Dodaj dane instruktora</label>
        </div>

        <!-- Dane instruktora (rozwijane pola) -->
        <div id="instructorFields" style="display: none;">
            <div>
                <x-input-label for="organizator" :value="__('Organizator')" />
                <input id="organizator" class="block mt-1 w-full" type="text" name="organizator[]" disabled />
                <x-input-error :messages="$errors->get('organizator')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherName" :value="__('Imię instruktora')" />
                <input id="teacherName" class="block mt-1 w-full" type="text" name="teacherName[]" disabled />
                <x-input-error :messages="$errors->get('teacherName')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherSurname" :value="__('Nazwisko instruktora')" />
                <input id="teacherSurname" class="block mt-1 w-full" type="text" name="teacherSurname[]" disabled />
                <x-input-error :messages="$errors->get('teacherSurname')" class="mt-2" />
            </div><br>

            <div>
                <x-input-label for="teacherPhoneNumber" :value="__('Numer telefonu instruktora')" />
                <input id="teacherPhoneNumber" class="block mt-1 w-full" type="tel" name="teacherPhoneNumber[]" pattern="[0-9]{1,9}" maxlength="9" disabled />
                <x-input-error :messages="$errors->get('teacherPhoneNumber')" class="mt-2" />
            </div>
            <br>
        </div>
        <br>


       <!-- Przycisk zapisu -->

    <div class="text-center mt-4">
        <button id="saveButton" class="py-2.5 px-5 text-red-700 me-2 mb-2 text-sm font-medium focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <i class="fas fa-floppy-disk mr-2"></i>Zapisz dane
        </button>
    </div>

    
        <script>

function calculateAge() {
        var birthDate = new Date(document.getElementById('birthDate').value);
        var today = new Date();
        var age = today.getFullYear() - birthDate.getFullYear();

        // Sprawdź, czy urodziny w tym roku już były
        if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
            age--;
        }

        // Zapisz wiek do pola wieku
        document.getElementById('age').value = age;

        // Sprawdź, czy wiek mieści się w zakresie
        var minAge = {{ $tournament->fromAge }};
        var maxAge = {{ $tournament->toAge }};
        if (age < minAge || age > maxAge) {
            // Wiek nie mieści się w zakresie, wyświetl komunikat
            document.getElementById('ageErrorMessage').innerText = 'Wiek nie mieści się w wymaganym zakresie (' + minAge + '-' + maxAge + ')';
            document.getElementById('ageErrorMessage').classList.remove('hidden');
            return false; // Zwróć false, aby uniemożliwić zapis danych
        } else {
            // Wiek mieści się w zakresie, ukryj komunikat
            document.getElementById('ageErrorMessage').classList.add('hidden');
            return true; // Zwróć true, aby umożliwić zapis danych
        }
    }

    document.getElementById('saveButton').addEventListener('click', function (event) {
        // Sprawdź wiek przed zapisem danych
        if (!calculateAge()) {
            // Jeśli wiek nie jest w odpowiednim zakresie, przerwij zapis danych
            event.preventDefault();
        }
    });
 
function addDancerForm() {
    var dancerContainer = document.getElementById('dancerContainer');
    var newDancerSection = dancerContainer.querySelector('.dancerSection').cloneNode(true);

    // Zwiększenie liczby tancerzy
    var dancerCount = dancerContainer.children.length;
    document.getElementById('dancerCount').innerText = dancerCount + 1;

    // Znajdź ostatni indeks w pętli foreach
    var lastIndex = dancerCount - 1;

    // Przekazanie indeksu do funkcji calculateAge()
    newDancerSection.querySelector('#birthDate').setAttribute('onchange', 'calculateAge(this, ' + lastIndex + ')');

    // Wyczyszczenie pól formularza w nowej sekcji
    var inputs = newDancerSection.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.value = '';
    });

    dancerContainer.appendChild(newDancerSection);
    newDancerSection.classList.remove('hidden');

    // Aktualizacja obsługi zmiany stanu checkboxa
    document.getElementById('addInstructor').addEventListener('change', function () {
        var instructorFields = document.getElementById('instructorFields');

        if (this.checked) {
            instructorFields.style.display = 'block';
            // Aktywuj pola instruktora
            document.getElementById('organizator').removeAttribute('disabled');
            document.getElementById('teacherName').removeAttribute('disabled');
            document.getElementById('teacherSurname').removeAttribute('disabled');
            document.getElementById('teacherPhoneNumber').removeAttribute('disabled');
        } else {
            instructorFields.style.display = 'none';
            // Zdezaktywuj pola instruktora
            document.getElementById('organizator').setAttribute('disabled', 'disabled');
            document.getElementById('teacherName').setAttribute('disabled', 'disabled');
            document.getElementById('teacherSurname').setAttribute('disabled', 'disabled');
            document.getElementById('teacherPhoneNumber').setAttribute('disabled', 'disabled');
        }
    });
}

        </script>
    </form>
</x-guest-layout>
