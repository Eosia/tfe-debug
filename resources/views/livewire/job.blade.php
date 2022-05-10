
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 col-xxl-10
    px-3 py-2 mb-3 shadow-sm hover:border-blue-300 rounded border-2 border-gray-300 w-100">

    <div class="flex justify-between mt-1">
        <h2 class="text-xl font-bold color1 font1 text-uppercase">
            {{ $job->title }}
        </h2>
        <p>
            {{ $job->user->role->name }}
        </p>

        <!-- bouton ajout favoris -->
        <button wire:click="addLike">
            <!--si pas encore liké-->
            @if($job->isLiked() === false )
                <i class="fa-solid fa-heart-circle-plus fa-2x text-green-400"></i>
                <!--si déjà liké-->
            @else
                <i class="fa-solid fa-heart-circle-minus fa-2x text-red-400"></i>
            @endif
        </button>
    </div>

    <!--description de l'annonde-->
    <p class="text-md text-gray-800 my-3">
        {{ Str::words($job->description, 15, ' ...') }}
    </p>

    <p class="text-sm text-gray-600 my-3 font-bold">
        Durée du stage: {{ $job->time }} jours.
    </p>
    <div class="flex items-center align-baseline my-4">
        <a href="{{ route('jobs.show', [$job->slug]) }}" class="bg-blue-600 text-yellow-300 hover:text-blue-600 hover:bg-yellow-300 btn border font3 border-primary">
            Consulter l'annonce
        </a>
    </div>

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

