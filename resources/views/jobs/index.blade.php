@extends('layouts.base')

@section('content')

    <h1 class="text-3xl text-green-500 mb-7 mx-auto text-center">
        Nos dernières missions
    </h1>


    <div class="container-fluid">
        <div class="row flex-column">
            @foreach($jobs as $job)

                <livewire:job :job="$job"/>

            @endforeach
        </div>
    </div>

@endsection
