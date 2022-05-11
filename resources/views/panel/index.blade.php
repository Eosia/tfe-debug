@extends('layouts.base')

@section('content')

    @include('includes.sessions_messages')

    <div class="mx-auto text-center">
        <h1 class="color1 font3 display-6">Bonjour {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} !</h1>
    </div>

    @if(auth()->check() && auth()->user()->suspended != 0 ) 

        <div class="mx-auto text-center bg-danger mt-5">
            <p class="text-dark font3 text-xl py-2">
                Votre compte a été modéré, veuillez-nous joindre via la page
                <a href="{{ route('contact') }}" class="text-white text-uppercase mx-1">
                    contact
                </a>
                pour le débloquer.
            </p>
        </div>
    @endif

    <section class="container-fluid mt-20">

        <div class="row mx-auto">
            <div class="col-12 col-sm-11 col-md-6 col-lg-4 col-xl-2 mb-5 mx-auto text-end">
                <a href="{{ route('jobs.create') }}" class="flex justify-content-evenly align-items-center btn btn-success text-uppercase
                @if(auth()->check() && auth()->user()->suspended != 0 ) 
                disabled 
                @endif ">
                Ajouter un stage
                    <span class="ml-1">
                            <i class="fa-solid fa-circle-plus fa-1x"></i>
                    </span>
                </a>
            </div>
        </div>

        <div class="flex justify-content-evenly align-items-start flex-wrap">
            <!--mes favoris-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-11 col-xl-3">
                <h3 class="mb-5 mx-auto text-center color1 font3 display-6">
                    Favoris ({{ auth()->user()->likes()->count() }})
                </h3>
                <div class="w-30">
                    @foreach(auth()->user()->likes as $like)
                        <div class="px-3 mb-3 shadow-sm hover:shadow-md rounded border-2 border-gray-30 text-sm text-gray-700">
                            <div class="col-12  mx-auto text-end">
                                <div class="flex justify-end align-content-center mt-1">
                                    <a href="{{ route('jobs.show', [$like->slug]) }}"
                                       class="bg-blue-500 text-xs py-2 px-2 my-3 mr-3 inline-block text-white hover:bg-blue-200
                                                            hover:text-blue-500 duration-200 transition btn text-primary rounded-circle">
                                        <i class="fa-solid fa-eye fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between my-2">
                                <h2 class="text-xl font-bold text-green-800">
                                    {{ $like->title }}
                                </h2>
                            </div>
                            <p class="text-md text-gray-800">
                                {{ $like->description }}
                            </p>
                            <p class="text-sm text-gray-600 my-2">
                                 Durée: <strong>{{ $like->time }}</strong> jours.
                            </p>
                        </div>
                    @endforeach


                </div>
            </div>
            <!--mes favoris/-->

            <!--mes candidatures-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-11 col-xl-3">
                <h3 class="mb-5 mx-auto text-center color1 font3 display-6">
                    Candidatures ({{ auth()->user()->proposals->count()  }})
                </h3>
                <div>
                    @foreach(auth()->user()->proposals->all() as $proposal)
                        <div class="p-3 mb-3 shadow-sm hover:shadow-md rounded border-2 border-gray-30 text-sm text-gray-700">
                            <div class="col-12  mx-auto text-end">
                                <div class="flex justify-end align-content-center mt-1">
                                    <a href="{{ route('jobs.show', [$proposal->job->slug]) }}"
                                       class="bg-blue-500 text-xs py-2 px-2 my-3 mr-3 inline-block text-white hover:bg-blue-200
                                                            hover:text-blue-500 duration-200 transition btn text-primary rounded-circle">
                                        <i class="fa-solid fa-eye fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between my-2">
                                <h2 class="text-xl font-bold text-green-800">
                                    {{ $proposal->job->title }}
                                </h2>
                            </div>
                            <p class="text-md text-gray-800 my-2">
                                Message de candidature :
                                <br>
                                {{ $proposal->coverLetter->content }}
                            </p>
                            <p class="text-sm text-gray-600 my-2">
                                 Durée: <strong>{{ $proposal->job->time }}</strong> jour(s).
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--mes candidatures/-->

            <!--mes annonces-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-11 col-xl-3">
                <h3 class="mb-5 mx-auto text-center color1 font3 display-6">
                    Annonces ({{ auth()->user()->jobs()->count() }})
                </h3>

                <div class="w-30">
                    @foreach(auth()->user()->jobs as $job)
                        <div class="px-2 py-1  shadow-sm hover:shadow-md rounded border-2 border-gray-30 text-sm text-gray-700">

                            @if($job->moderate != 0 ) 
                            <div class="mx-auto text-center bg-danger mt-5 col-12 ">
                                <p class="text-dark font3 text-sm py-2">
                                    Votre annonce a été modérée, veuillez-nous joindre via la page
                                    <a href="{{ route('contact') }}" class="text-white text-uppercase mx-1">
                                        contact
                                    </a>
                                    pour le débloquer.
                                </p>
                            </div>
                            @endif
                            <div class="col-12  mx-auto text-end">
                                <div class="flex justify-end align-content-center mt-1">
                                    <a href="{{ route('jobs.show', [$job->slug]) }}"
                                       class="bg-blue-500 text-xs py-2 px-2 my-3 mr-3 inline-block text-white hover:bg-blue-200
                                                            hover:text-blue-500 duration-200 transition btn text-primary rounded-circle">
                                        <i class="fa-solid fa-eye fa-2x"></i>
                                    </a>
                                    <form style="display: inline;" action="{{ route('jobs.destroy', ['job' => $job->slug]) }}" method="post" >
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-xs py-2 px-2 my-3 inline-block text-white hover:bg-red-200
                                                        hover:text-red-500 duration-200 transition btn text-danger rounded-circle
                                                        @if(auth()->user()->suspended === 1) disabled @endif ">
                                            <i class="fa-solid fa-trash-can fa-2x"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        
                            <div class="flex-column justify-between">
                                <h2 class="text-xl font-bold text-green-800 my-3">
                                    {{ $job->title }}
                                    <br>
                                </h2>
                                <span class="my-2">({{ $job->proposals->count() }} @choice('proposition|propositions', $job->proposals))</span>
                            </div>
                            <p class="text-md text-gray-800 my-3">
                                {{ $job->description }} :
                            </p>
                            <p class="text-sm text-gray-600 my2">
                                    Durée: <strong>{{ $job->time }}</strong> jour(s).
                            </p>

                            <ul class="list-none ml-4">

                                @foreach($job->proposals as $proposal)

                                    <div class="container-fluid my-3 border border-bottom-secondary border-top-secondary">
                                        <div class="flex-column justify-evenly align-items-center">
                                            <li class="mt-2">
                                                "{{ $proposal->coverLetter->content }}"
                                                <br>
                                                <span class="mt-1">
                                                    <strong>
                                                        par {{ $proposal->user->firstname }} {{ $proposal->user->lastname }}
                                                    </strong>
                                                </span>
                                            </li>

                                            @if ($proposal->validated)
                                                <span class="bg-white border border-green-500 text-xs p-1 my-2 inline-block text-green-500 rounded">Validé</span>
                                            @else
                                                <div class="container-fluid">
                                                    <div class="flex justify-start align-content-center mt-1">
                                                        <a href="{{ route('confirm.proposal', [$proposal->id])}}"
                                                           class="bg-green-500 text-xs py-2 px-2 my-3 mr-3 inline-block text-white hover:bg-green-200
                                                            hover:text-green-500 duration-200 transition btn text-success rounded-circle
                                                            @if(auth()->user()->suspended === 1) disabled @endif ">
                                                            <i class="fa-solid fa-circle-check fa-2x"></i>
                                                        </a>
                                                        <form style="display: inline;" action="{{ route('delete.proposal', ['proposal' => $proposal->id]) }}" method="post" >
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="bg-red-500 text-xs py-2 px-2 my-3 inline-block text-white hover:bg-red-200
                                                        hover:text-red-500 duration-200 transition btn text-danger rounded-circle
                                                        @if(auth()->user()->suspended === 1) disabled @endif ">
                                                                <i class="fa-solid fa-circle-xmark fa-2x"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                @endforeach
                            </ul>

                        </div>
                    @endforeach
                </div>
            </div>
            <!--mes annonces/-->


        </div>
    </section>


@endsection

