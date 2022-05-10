<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home.about') }}">
                <img src="{{ asset('assets/img/logo_250x250.png') }}" alt="logo internship me"
                     class="rounded-circle" width="124" height="124"
                >
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Pseudo') }}" />
                <x-jet-input id="name" class="block my-2 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="firstname" value="{{ __('Prénom') }}" />
                <x-jet-input id="firstname" class="block my-2 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            </div>

            <div>
                <x-jet-label for="lastname" value="{{ __('Nom') }}" />
                <x-jet-input id="lastname" class="block my-2 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block my-2 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            {{--
            <div>
                <x-jet-label for="province_id" value="{{ __('Province') }}" />
                <select id="province_id" name="province_id" class="block my-3 w-full rounded border-gray-300" required>
                    <option value="{{ __('province_id') }}" selected>Choisissez votre province.</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            --}}

            <div>
                <x-jet-label for="city_id" value="{{ __('Ville') }}" />
                <select id="city_id" name="city_id" class="block my-2 w-full rounded border-gray-300" required>
                    <option value="{{ __('city_id') }}" selected >Choisissez votre ville.</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }} - {{ $city->zip }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-2 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-2 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <p for="role-select" class="font-semibold text-gray-700 my-5 mx-auto text-center">Je suis :</p>
            <div class="flex justify-evenly items-center">
                <label for="student">&Eacutetudiant
                    <input type="radio" value="2" id="student" name="role_id">
                    <span class="checkmark"></span>
                </label>
                <label for="client">Recruteur
                    <input type="radio" value="3" id="recruiter" name="role_id">
                    <span class="checkmark"></span>
                </label>
            </div>
            @error('role_id')
            <span class="text-red-400 text-sm block">{{ $message }}</span>
            @enderror


            {{--
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
            --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Déjà un enregistré ?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Inscription') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<div class="h-5 mb-20">
</div>
