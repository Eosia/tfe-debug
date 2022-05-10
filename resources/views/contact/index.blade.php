@extends('layouts.base')

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>


    <!-- formulaire de contact -->
    <div class="w-full">
        <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
        <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
            <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
                <p class="text-3xl font-bold leading-7 text-center">NOUS CONTACTER</p>
                <form  method="post"  action="{{ route('contact.send') }}" enctype="multipart/form-data" >
                    @csrf

                    <!--nom-->
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                            <label class="font-semibold leading-none">Votre nom</label>
                            <input type="text" name="name" id="name" placeholder="John Doe"
                                   value="{{ old('name' ?? '') }}" min="2" required
                                   class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                    @error('name')
                    <div class="error text-danger mt-2">{{ $error='Vous devez entrer votre nom' }}</div>
                    @enderror
                    <!--email-->
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                            <label class="font-semibold leading-none">Email</label>
                            <input type="email" name="email" id="email" placeholder="supermail@localhost.com" value="{{ old('email' ?? '') }}" min="2" required
                                   class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                        <br>
                    </div>
                    @error('email')
                    <div class="error text-danger mt-2">{{ $error='Vous devez entrer votre adresse email' }}</div>
                    @enderror
                    <!--sujet-->
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                            <label class="font-semibold leading-none">Sujet du message</label>
                            <input type="text"  name="subject"  placeholder="Sujet de votre message ?" value="{{ old('subject' ?? '') }}" id="subject" min="4" required
                                   class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                    @error('subject')
                    <div class="error text-danger mt-2">{{ $error='Vous devez entrer un sujet de message' }}</div>
                    @enderror
                    <!--message-->
                    <div>
                        <div class="w-full flex flex-col mt-8">
                            <label class="font-semibold leading-none">Votre message</label>
                            <textarea type="text" name="message" id="message" rows="4" min="10" placeholder="Votre super message" required class="h-40 text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">{{ old('message' ?? '') }}</textarea>
                        </div>
                    </div>
                    @error('message')
                    <div class="error text-danger mt-2">{{ $error='Vous devez entrer un message' }}</div>
                    @enderror

                    <div class="flex items-center justify-center w-full">
                        <button type="submit" name="send"
                            class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                            ENVOYER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
