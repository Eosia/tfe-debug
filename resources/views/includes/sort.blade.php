@if(Route::is('home.index'))
<div class="dropdown float-right mr-5">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Trier par
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{ url()->current() }}?sort=newest">Récents</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?sort=oldest">Anciens</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?sort=asc">Nom ascendant</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?sort=desc">Nom Descendant</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?sort=popular">Le plus de candidatures</a></li>
    </ul>

</div>
@endif



@if(Route::is('search'))
<div class="dropdown float-right mr-5">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
        Trier par
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
        <li><a class="dropdown-item" href="{{ url()->current() }}?search={{ $search }}&profession={{ $profession }}&city={{ $city }}&sort=newest">Récents</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?search={{ $search }}&profession={{ $profession }}&city={{ $city }}&sort=oldest">Anciens</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?search={{ $search }}&profession={{ $profession }}&city={{ $city }}&sort=asc">Nom ascendant</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?search={{ $search }}&profession={{ $profession }}&city={{ $city }}&sort=desc">Nom Descendant</a></li>
        <li><a class="dropdown-item" href="{{ url()->current() }}?search={{ $search }}&profession={{ $profession }}&city={{ $city }}&sort=popular">Le plus de candidatures</a></li>
    </ul>
</div>
@endif

