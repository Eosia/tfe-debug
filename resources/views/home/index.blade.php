@extends('layouts.base')

@section('content')

@include('includes.sessions_messages')
    <h1 class="text-3xl text-green-500 mb-7 mx-auto text-center">
        Nos dernières missions
    </h1>

    @include('includes.form-search')

    <div class="container-fluid">
        <div class="row flex-column">

            @include('includes.listing')

        </div>
    </div>

@endsection
