<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-required-input for="name" :value="__('app.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="{{__('app.enter_full_name')}}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- University ID -->
        <div class="mt-4">
            <x-required-input for="university_id" :value="__('University ID')" />
            <x-text-input id="university_id" class="block mt-1 w-full" type="number" name="university_id"
                step="1" :value="old('university_id')" required autofocus
                placeholder="Enter University ID" />
            <x-input-error :messages="$errors->get('university_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-required-input for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="Enter University Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- College -->
        <div class="mt-4">
            <x-required-input for="college" :value="__('College')" />
            <select id="college" name="college" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                <option value="" selected hidden>Select College</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}">{{ $college->name_ar }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('college')" class="mt-2" />
        </div>

        <!-- Department -->
        <!-- Department -->
        <div class="mt-4" id="departmentContainer" style="display: none;">
            <x-required-input for="department" :value="__('Department')" />
            <select id="department" name="department" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                <option value="" selected hidden>Select Department</option>
                <!-- Departments will be dynamically populated based on the selected college -->
            </select>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-required-input for="password" :value="__('Password')" />
            <div class="flex items-center">
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                              autocomplete="new-password" placeholder="Enter Password" />
                <button class="ml-2 px-3 py-2 border border-gray-300
                         rounded-md bg-white text-gray-600" type="button" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="mt-4" id="passwordValidationList" style="display: none;">
                <ul>
                    <li id="minLength"><i class="fas fa-times text-red-500"></i> Minimum 8 characters</li>
                    <li id="uppercase"><i class="fas fa-times text-red-500"></i> At least one uppercase letter</li>
                    <li id="lowercase"><i class="fas fa-times text-red-500"></i> At least one lowercase letter</li>
                </ul>
                <span id="errorMessage" class="font-semibold text-red-500"></span>
            </div>
        </div>
        

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-required-input for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('app.already_registerd') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('app.register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        // When the college selection changes
        document.getElementById('password').addEventListener('focus', function () {
            document.getElementById('passwordValidationList').style.display = 'block';
        });
        document.getElementById('college').addEventListener('change', function () {
        var collegeId = this.value;
        var departmentContainer = document.getElementById('departmentContainer');
        var departmentSelect = document.getElementById('department');

        // Clear the existing department options
        departmentSelect.innerHTML = '<option value="" selected hidden>Select Department</option>';

        if (collegeId !== '') {
            // Make an AJAX request to fetch the departments for the selected college
            fetch('/departments/' + collegeId)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // Populate the department select with the fetched departments
                    for (var departmentId in data) {
                        var option = document.createElement('option');
                        option.value = departmentId;
                        option.textContent = data[departmentId];
                        departmentSelect.appendChild(option);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            // Show the department container
            departmentContainer.style.display = 'block';
        } else {
            // Hide the department container if no college is selected
            departmentContainer.style.display = 'none';
        }
    });
    $('#togglePassword').click(function () {
            const passwordInput = $('#password');
            const icon = $(this).find('i');
 
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
 
        $('#password').on('input', function () {
            const password = $(this).val();
            const strongPasswordRegex = /^(?=.*[A-Z]).+$/;
            const errorMessage = $('#errorMessage');
 
            $('#minLength').html(password.length >= 8 ?
                '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' :
                '<i class="fas fa-times text-red-500"></i> Minimum 8 characters');
            $('#uppercase').html(/[A-Z]/.test(password) ?
                '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' :
                '<i class="fas fa-times text-red-500"></i> At least one uppercase letter');
            $('#lowercase').html(/[a-z]/.test(password) ?
                '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' :
                '<i class="fas fa-times text-red-500"></i> At least one lowercase letter');
 
            if (strongPasswordRegex.test(password)) {
                errorMessage.text('Strong Password').removeClass('text-red-500')
                    .addClass('text-green-500');
            } else {
                errorMessage.text('Weak Password').removeClass('text-green-500')
                    .addClass('text-red-500');
            }
        });
    </script>
</x-guest-layout>

