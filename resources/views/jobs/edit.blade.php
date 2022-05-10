@extends('layouts.base')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css"/>
    <section class="container-fluid my-5">


        <h1 class="text-3xl text-green-500 mb-3">
            Modifier votre
            {{--role student--}}
            @if(auth()->user()->role_id === 2)
                demande
                {{--role recruiter--}}
            @else
                offre
            @endif
            de stage.
        </h1>

        {{-- formulaire d'ajout d'unne anoonce de stage --}}
        <div class="row">

            <form action="{{ route('jobs.update', ['job'=>$job->slug]) }}" method="post">

            @method('PUT')

            @csrf

                <!--titre de l'annonce-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="title">Titre de l'annonce</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}" class="form-control rounded"
                           placeholder="Un super titre"
                           min="4" required>
                </div>
                <!--titre de l'annonce/-->

                <!--durée du stage-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="time">Durée du stage ( Nombre de jours )</label>
                    <input type="number" name="time" value="{{ old('time', $job->time) }}" class="form-control rounded"
                           placeholder="30"
                           min="1" required>
                </div>
                <!--durée du stage/-->

                <!--contenu de l'annonce-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="description">Description du stage</label>

                    <textarea class="form-control rounded text-left p-3 font-thin w-100" name="description" value="{{ old('description') }}" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt imperdiet magna, at venenatis lorem euismod ac. Donec blandit sem vitae consequat tincidunt. In orci mauris, tincidunt ornare facilisis rhoncus, maximus eu dolor. Nunc nec risus aliquam lectus volutpat laoreet in nec ligula. Curabitur tincidunt velit varius convallis posuere." required>{{ old('description', $job->description) }}</textarea>
                </div>
                <!--contenu de l'annonce/-->

                <!--visibilité de l'annonce-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="status">Statut de l'annonce</label>
                    <select class="form-control" value="{{ old('status', $job->status) }}" name="status" id="status">
                        <option value="1" @if(old('status', $job->status) === 1) selected @endif >Publier</option>
                        <option value="0" @if(old('status', $job->status) === 0) selected @endif >Ne pas publier
                        </option>
                    </select>
                </div>
                <!--visibilité de l'annonce/-->

                <!--catégorie-->
            {{--
            <div class="form-group mt-3">
                <label class="mb-2" for="cateory_id">Secteur</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="{{ 'category_id' }}" selected>Choisissez un secteur.</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>--}}




            <!--profession-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="profession_id">Profession</label>
                    <select class="form-control" name="profession_id" id="profession_id">
                        <option value="">Choisissez une catégorie</option>
                        @foreach($professions as $profession)
                            <option value="{{ $profession->id }}"
                                    @if(old('profession_id', $job->profession->id) == $profession->id ) selected @endif >
                                {{ $profession->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--profession/-->

                <!--province-->
            {{--
            <div class="form-group mt-3">
                <label class="mb-2" for="province_id">Province</label>
                <select class="form-control" name="province_id" id="province_id" required>
                    <option value="{{ ('province_id') }}" selected>Choisissez une province.</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            --}}
            <!--province/-->

                <!--ville-->
                <div class="form-group mt-3">
                    <label class="mb-2" for="city_id">Ville</label>
                    <select class="form-control" name="city_id" id="city_id">
                        <option value="">Choisissez une ville.</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}"
                                    @if(old('city_id', $job->city->id) == $city->id) selected @endif >
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--ville/-->

                <button type="submit" class="block bg-green-700 text-white px-3 py-2 my-5 rounded
                    @if(auth()->user()->suspended === 1) disabled @endif
                ">
                    Modifier mon annonce
                </button>

            </form>

        </div>

    </section>
    <!-- boutons de retour-->


@endsection
