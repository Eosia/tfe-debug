@extends('layouts.base')

@section('content')

    @if(Auth::check() && Auth::user()->id == $job->user_id)
        <div class="row mx-auto">
            <div class="col-12 col-sm-10 col-md-6 col-lg-5 col-xl-3 mb-5 mx-auto text-end">
                <a href="{{ route('jobs.edit', ['job'=> $job->slug]) }}" class="flex justify-content-evenly align-items-center btn btn-warning text-uppercase">
                    Modifier l'annonce
                    <span class="ml-1">
                      <i class="fa-solid fa-file-pen"></i>
                </span>
                </a>
            </div>
        </div>
    @endif


    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 col-xxl-10
    px-3 py-2 mb-3 shadow-sm hover:border-blue-300 rounded border-2 border-gray-300 w-100">

        <div class="flex justify-between mt-1">
            <h2 class="text-xl font-bold color1 font1 text-uppercase">
                {{ $job->title }}
            </h2>

        </div>

        <!--description de l'annonde-->
        <p class="text-md text-gray-800 my-3">
            {{ Str::words($job->description, 15, ' ...') }}
        </p>

        <p class="text-sm text-gray-600 my-3 font-bold">
            Durée du stage: {{ $job->time }} jours.
        </p>

        <div class="flex-column justify-content-evenly align-item-center mb-1">
            <div class="flex justify-start align-center">
                <a href="{{ route('user.show', [$job->user->slug]) }}" class="text-blue-900 hover:text-blue-400"
                   data-toggle="tooltip" data-placement="right" title="Voir le profil de l'auteur" >
                    <i class="fa-solid fa-user mr-3 pt-1 fa-2x"></i>Auteur: {{ $job->user->firstname }} {{ $job->user->lastname }}
                </a>
            </div>
            <div class="flex justify-start align-center my-3">

                <div class="flex justify-start align-items-center">
                    <i class="fa-solid fa-briefcase fa-2x mr-3 color1"></i>
                    <span>
                    Métier: {{ $job->profession->name }}
                </span>
                </div>

            </div>
            <div class="flex justify-start align-baseline">
                <div class="flex justify-start align-items-center">
                    <i class="fa-solid fa-location-dot fa-2x mr-3 color1"></i>
                    <span>
                    Ville: {{ $job->city->name }}
                </span>
                </div>
            </div>


            <div class="flex justify-content-between align-items-baseline mt-3">
                <p class="text-md font-bold text-gray-600">
                    @if($job->proposals->count() === 1)
                        <span class="text-danger mr-2">
                     {{ $job->proposals->count() }}
                </span>
                        Candidat
                    @elseif($job->proposals->count() > 1)
                        <span class="text-danger mr-2">
                     {{ $job->proposals->count() }}
                </span>
                        Candidats
                    @else
                        <span class="text-danger mr-2">
                     Pas de candidat.
                </span>
                    @endif
                </p>

                <!-- bouton ajout favoris -->
                <p>
                    Mis à jour le {{ $job->updated_at->format('d/m/Y') }}
                </p>
            </div>



        </div>

    </div>

    @if($job->user->suspended === 1)
        <div class="mx-auto text-center bg-danger my-5">
            <p class="text-dark font3 text-xl py-2">
                Votre compte a été modéré, veuillez-nous joindre via la page
                <a href="{{ route('contact') }}" class="text-white text-uppercase mx-1">
                    contact
                </a>
                pour le débloquer.
            </p>
        </div>
    @else
    <!--formulaire de candidature-->
    <section class="my-10" x-data="{open: false}">
        <a href="#" class="bg-green-700 text-white px-3 py-2 rounded text-decoration-none" @click="open = !open">
            Cliquez ici pour postuler
        </a>

        <form class="mt-10" x-show="open" x-cloak method="POST" action="{{ route('proposals.store', $job) }}">
            @csrf
            <textarea class="p-3 font-thin w-100 min-h-min" name="content"></textarea>

            <button type="submit" class="block bg-green-700 text-white px-3 py-2 my-5 rounded">
                Envoyer ma candidature
            </button>
        </form>
    </section>
    @endif


    <!-- boutons de retour-->
    <a href="{{ route('home.index') }}" class="btn-lg bg-blue-600 text-white px-2 py-1 rounded text-decoration-none">Retour à l'accueil</a>

    @if($job->isLiked() === true )
        <a href="{{ route('panel.index') }}" class="btn-lg bg2 text-white px-2 py-1 rounded ml-5 text-decoration-none">Retour aux favoris</a>
    @endif


@endsection
