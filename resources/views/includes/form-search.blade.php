<div class="container-fluid mb-5">
    <div class="row">
        <form class="d-flex flex-column justify-content-evenly align-items-start form-control"
              action="{{ route('search') }}" method="get">
            <!--fonctions de recherche-->
            <div class="form px-5 px-xl-3 py-4 py-xl-2 col-md-8 col-lg-6 mx-md-auto col-xl-4">
                <div>
                    <!--barre de recherche-->
                    <div>
                        <h5 class="form__subtitle my-2">
                            Rechercher une terme
                        </h5>

                        <!--champ rechercher-->
                        <input type="search" name="search" class="form-control w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none" value="{{ $search }}"
                               placeholder="&#x1F50D; Rechercher..." x-model="search">
                        <!--champ rechercher-->

                    </div>

                    <!--barre de recherche/-->

                    <!--Choix de la sous-catégorie-->
                    <div class="form-group mt-3 ">
                        <label class="mb-2" for="profession_id">Profession</label>
                        <select class="form-control rounded-full" id="profession_id" name="profession">
                            <option value="" selected>Choisissez une profession</option>
                            @foreach($professions as $profession)
                                <option value="{{ $profession->id }}" >
                                    {{ $profession->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--Choix de la sous-catégorie/-->

                    <!--Choix de la ville-->
                    <div class="form-group mt-3">
                        <label class="mb-2" for="city_name">Ville</label>
                        <select class="form-control rounded-full" id="city_id" name="city">
                            <option value="" selected>Choisissez une ville.</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" >
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--Choix de la ville/-->

                    <button type="submit" class=" mt-3 py-2 px-4 shadow-md no-underline rounded-full bg-blue text-white font-sans font-semibold text-sm border-blue btn-primary hover:text-white hover:bg-blue-light focus:outline-none active:shadow-none mr-2">
                        Rechercher
                    </button>

                </div>
            </div>
            <!--fonctions de recherche/-->
        </form>
    </div>
</div>

