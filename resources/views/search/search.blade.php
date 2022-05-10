@extends('layouts.base')

@section('content')

    @include('includes.sessions_messages')

    <div class="container-fluid">
        <div class="row flex-column">

            @include('includes.listing')

        </div>
    </div>

@endsection
