<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{asset('admin/img/'.auth()->user()->image)}}" alt="">
                {{\Illuminate\Support\Facades\Auth::user()->name}}
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('details.store') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="birth_certificate" :value="__('Birth Certificate')" />

                <x-input id="birth_certificate" class="block mt-1 w-full" type="file" name="birth_certificate" :value="old('birth_certificate')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="dead" :value="__('Dead')" />
                <select name="dead" id="dead">
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="both">Both</option>
                </select>

            </div>

            <!-- ID Number -->
            <div class="mt-4">
                <x-label for="death_certificate_father" :value="__('Death Certificate Father')" />

                <x-input id="death_certificate_father" class="block mt-1 w-full" type="file" name="death_certificate_father" :value="old('death_certificate_father')"  />
            </div>

            <!--image  -->
            <div class="mt-4">
                <x-label for="death_certificate_mother" :value="__('Death Certificate Mother')" />

                <x-input id="death_certificate_mother" class="block mt-1 w-full" type="file" name="death_certificate_mother" :value="old('death_certificate_mother')"  />
            </div>

                <x-button class="ml-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
