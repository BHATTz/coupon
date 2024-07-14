<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                    :value="old('phone_number')" required />
                <!-- You can add validation and error handling for phone_number -->
            </div>

            <!-- Country -->
            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"
                    required />
                <!-- You can add validation and error handling for country -->
            </div>

            <!-- Date of Birth -->
            {{-- <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-date-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                    :value="old('date_of_birth')" required />
                <!-- You can add validation and error handling for date_of_birth -->
            </div> --}}


            <!-- Profile Picture -->
            {{-- <div>
                <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                <x-file-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture"
                    :value="old('profile_picture')" required />
                <!-- You can add validation and error handling for profile_picture -->
            </div> --}}

            <!-- Last Address -->
            <div>
                <x-input-label for="last_address" :value="__('Last Address')" />
                <x-text-input id="last_address" class="block mt-1 w-full" type="text" name="last_address"
                    :value="old('last_address')" required />
                <!-- You can add validation and error handling for last_address -->
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
