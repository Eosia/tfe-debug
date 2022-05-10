@extends('layouts.base')

@section('content')

    <!--header-->
    <header class="container-fluid mb-5">
        <div class="flex-column">
            <h1 class="text-center text-uppercase mx-auto display-2 font1 color1">
                Internship Me
            </h1>
            <h2 class="text-center mx-auto mt-2 h4 font-thin font2">
                Apprendre - Echanger - Evoluer
            </h2>
        </div>
    </header>


    <section class="container mt-5 mx-auto border border-blue-200 px-0">

        <!--section 1-->
        <div class="py-16 bg-white">
            <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                    <div class="md:5/12 lg:w-5/12">
                        <img src="{{ asset('assets/img/p1.png') }}" alt="image" loading="lazy" width="" height="">
                    </div>
                    <div class="md:7/12 lg:w-6/12">
                        <h2 class="text-2xl text-gray-900 font-bold md:text-4xl">Marre des refus pour tes demandes de stage ?</h2>
                        <p class="mt-6 text-gray-600">Tu dois faire un stage pour valider ton année, mais tu ne sais pas ou chercher ?</p>
                        <p class="mt-4 text-gray-600">Envie d'un coup de main dans ta recherche ?</p>
                        <a href="{{ route('home.index') }}" class="mt-6 bg1 text-xl btn btn-md color2 rounded-md font1 px-2 py-2 w-full">
                            Découvrir les propositions de stage >
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--section 2-->
        <div class="py-16 bg-white">
            <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                    <div class="md:7/12 lg:w-6/12">
                        <h2 class="text-2xl text-gray-900 font-bold md:text-4xl">Vous avez du mal à trouver un stagiare ?</h2>
                        <p class="mt-6 text-gray-600">Vous cherchez celui à qui transmettre votre savoir ?</p>
                        <p class="mt-4 text-gray-600">Envie d'un coup de main dans ta recherche ?</p>
                        <a href="{{ route('home.index') }}" class="mt-6 bg1 text-xl btn btn-md color2 rounded-md font1 px-2 py-2 w-full">
                            Découvrir les demandes de stage >
                        </a>
                    </div>
                    <div class="md:5/12 lg:w-5/12">
                        <img src="{{ asset('assets/img/p2.png') }}" alt="image" loading="lazy" width="" height="" class="rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-3 mx-auto border border-blue-200 px-0">
        <!-- section3 -->
        <div class="flex justify-center">
            <div class="rounded-lg shadow-lg bg-white w-full">
                <img class="rounded-t-lg w-50 mx-auto" src="{{ asset('assets/img/p3.jpg') }}" alt=""/>
                <div class="p-6 my-2">
                    <h5 class="text-gray-900 mx-auto text-center text-xl font-medium mb-2">Parce que les étudiants d'aujourd'hui sont vos collègues et votre relève de demain.</h5>
                </div>
            </div>
        </div>

    </section>

@endsection
