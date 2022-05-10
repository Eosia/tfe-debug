@extends('layouts.base')

@section('content')
    <section class="container-fluid mx-auto text-center">
        <div class="row">
                <div class='flex space-x-2 bg3 w-full shadow-md rounded-lg overflow-hidden mx-auto'>
                    <div class="mx-auto min-w-sm bg3 min-w-max">
                        <!---->
                        <div class="w-full card__media"><div  class="h-12 w-96"></div>
                        <div class="  card__media--aside "></div>
                        <div class="flex items-center p-4">
                            <div class="relative flex flex-col items-center w-full">
                                <div
                                    class="h-24 w-24 md rounded-full relative avatar flex items-end justify-end text-purple-600 min-w-max absolute -top-16 flex bg-purple-200 text-purple-100 row-start-1 row-end-3 text-purple-650 ring-1 ring-white">

                                        <img src="{{ asset('/assets/img/avatar.png') }}" alt="avatar"
                                             class="h-24 w-24 md rounded-full relative" >
            
                                    <div class="absolute"></div>
                                </div>
                                <div class="texte-center mx-auto align-items-center flex-col space-y-1 justify-center items-center -mt-15 w-full">
                                    <div
                                    class="py-4 flex justify-center items-center w-full divide-x divide-gray-400 divide-solid">
                                    <span class="text-center px-2">
                                        Profil de {{ $user->firstname }} {{ $user->lastname }}
                                    </span>    
                                </div>

                                    <div class="py-2 mt-5 flex space-x-2">
                                        <div class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring
                                        focus:border-blue-300 rounded max-w-max text-gray-100 bg-green-500 hover:bg-green-600 px-4 py-1
                                        flex items-center hover:shadow-lg">
                                            <span class="mr-2">
                                            </span>
                                            @if($user->role_id === 2)
                                               Etudiant(e)
                                            @else
                                                Rectuteu(r/se)
                                            @endif<span class="ml-2"></span>
                                        </div>
                                        <div class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring
                                        focus:border-blue-300 rounded max-w-max text-gray-100 bg-green-500 hover:bg-green-600 px-4 py-1
                                        flex items-center hover:shadow-lg">
                                            <span class="mr-2">
                                            </span>
                                                Ville: {{ $user->city->name }}
                                            <span class="ml-2"></span>
                                        </div>
                                    </div>
                                    <div
                                        class="py-4 flex justify-center items-center w-full divide-x divide-gray-400 divide-solid">
                                        <span class="text-center px-2">
                                            <span class="text-gray-600">Il/elle a publié(e) </span>
                                            <span class="font-bold text-gray-700">{{ $user->jobs->count() }}</span>
                                            <span class="text-gray-600"> Annonce(s) au total</span></span><span class="text-center px-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <section class="mx-2">

        <h3 class="text-3xl my-5 mx-auto text-center font3 color1">
            -  Ses annonces  -
        </h3>
        <div class="container-fluid mt-5">
            <div class="row flex-column">

                @foreach($user->jobs as $job)

                    <livewire:job :job="$job"/>

                @endforeach
            </div>
        </div>

    </section>
@endsection
