{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

@extends('layouts.base')

@section('content')
    <div class="mx-auto text-center">
        <h1>Bonjour {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} !</h1>
    </div>

    <section class="container-fluid mt-20">

        <div class="row">

            <!--liste des favoris-->
            <div class="flex-column justify-evenly align-items-center">
                <h3 class="mb-5">
                    Vos favoris
                </h3>
                <div>

                    @foreach(auth()->user()->likes as $like)

                        <div class="px-3 py-5 mb-3 shadow-sm hover:shadow-md rounded border-2 border-gray-300">

                            <div class="flex justify-between">
                                <h2 class="text-xl font-bold text-green-800">
                                    {{ $like->title }}
                                </h2>



                            </div>

                            <p class="text-md text-gray-800">
                                {{ $like->description }}
                            </p>

                            <div class="flex items-center align-baseline">
                                <span class="h-2 w-2 bg-green-300 rounded-full mr-2">
                                </span>


                            </div>

                            <span class="text-sm text-gray-600">
                                Durée: {{ $like->time }} jours.
                            </span>

                        </div>

                    @endforeach
                </div>
            </div>
            <!--liste des favoris/-->


        </div>

    </section>

@endsection

