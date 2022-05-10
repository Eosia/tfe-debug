<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home.about') }}">
                <img src="{{ asset('assets/img/logo_250x250.png') }}" alt="logo internship me"
                     class="rounded-circle" width="124" height="124"
                >
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Indiquez-nous simplement votre adresse email et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra de définir un nouveau mot de passe.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Envoyer le lien de réinitialisation') }}
                </x-jet-button>
            </div>
        </form>


        <div class="mt-5 w-100">
            <x-jet-responsive-nav-link href="{{ route('register') }}" class="mt-5 bg-blue-100 rounded hover:shadow-md">
                {{ __('Inscription') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('login') }}" class="mt-5 bg-blue-100 rounded hover:shadow-md">
                {{ __('Connexion') }}
            </x-jet-responsive-nav-link>
        </div>


    </x-jet-authentication-card>
</x-guest-layout>
