@extends('layouts.base')

@section('content')
    <h1 class="text-3xl text-green-500 mb-5">Vos conversations</h2>

        @if(auth()->user()->suspended === 1)
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
            @foreach($conversations as $conversation)
                <a href="{{ route('conversation.show', $conversation->id) }}" class=focus:outline-none">
                    <div class="flex items-center justify-between px-3 py-10 mb-3 shadow-md rounded mb-3 border-2 hover:border-green-300 cursor-pointer">
                        <p class="font-semibold">{{ Illuminate\Support\Str::limit($conversation->messages->last()->content, 50) }}
                        </p>

                        <p class="font-thin text-gray-500">
                            Conversation avec: {{ $conversation->messages->last()->user->firstname }} {{ $conversation->messages->last()->user->lastname }}

                        </p>

                        @if($conversation->messages->last()->user->id !== auth()->user()->id)
                            <div class="flex flex-column justify-content-center align-items-center">
                                <i class="fa-solid fa-comment-dots fa-3x text-green-600 mb-2"></i>
                                <span>
                                    Nouveau(x) Message(s)
                                </span>
                                <span class="font-thin">
                                    Reçu: {{ $conversation->messages->last()->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @else
                            <div class="flex flex-column justify-content-center align-items-center">
                                <i class="fa-solid fa-comment-slash fa-3x text-red-600 mb-2"></i>
                                <span>Pas de nouveaux messages</span>
                            </div>
                        @endif

                    </div>
                </a>
        @endforeach

    @endif
@endsection
