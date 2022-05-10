@extends('layouts.base')

@section('content')
    @if(auth()->user()->suspended != 0)
        <div class="mx-auto text-center bg-danger mt-5">
            <p class="text-dark font3 text-xl py-2">
                Votre compte a été modéré, veuillez-nous joindre via la page
                <a href="{{ route('contact') }}" class="text-white text-uppercase mx-1">
                    contact
                </a>
                pour le débloquer.
            </p>
        </div>
    @else
    <livewire:conversation :conversation="$conversation">
    @endif
@endsection
