<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

                <!-- ID Number -->
                <div class="mt-4">
                    <x-label for="id_number" :value="__('ID Number')" />

                    <x-input id="id_number" class="block mt-1 w-full" type="number" name="id_number" :value="old('id_number')" required />
                </div>

                <!--image  -->
                <div class="mt-4">
                    <x-label for="image" :value="__('Image')" />
                    <input id="image" class="block mt-1 w-full" type="file" name="image" value="{{old('image')}}">
{{--                    <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"  />--}}
                </div>

                <!--date_birth  -->
                <div class="mt-4">
                    <x-label for="date_birth" :value="__('Date Birth')" />

                    <x-input id="date_birth" class="block mt-1 w-full" type="date" name="date_birth" :value="old('date_birth')" required />
                </div>

                <!--id_image  -->
                <div class="mt-4">
                    <x-label for="id_image" :value="__('ID Image')" />

                    <x-input id="id_image" class="block mt-1 w-full" type="file" name="id_image" :value="old('id_image')" required />
                </div>
                <!--Type  -->
                <div class="mt-4">
                    <x-label for="image" :value="__('Type')" />
                    <select name="type" id="type">
                        <option value="sponsor">sponsor</option>
                        <option value="orphan">orphan</option>
                    </select>

                </div>


                <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
