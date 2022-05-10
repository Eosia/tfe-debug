<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobService;
use  Auth;
use Illuminate\Support\Facades\DB;

use App\Models\{
    Province,
    City,
    Category,
    Profession,
    CoverLetter,
    Job,
    Proposal,
};


class HomeController extends Controller
{
/*
    public function __invoke(Request $request)
    {
        //$jobs = Job::online()->latest()->get();

        $sort = request()->query('sort', null);
        $query = Job::query()->all();

        $currentPage = http_build_query(request()->query());

        $jobs = Cache::rememberForever('jobs_'.$currentPage, fn() => (new JobService())->getAll($query, $sort));

        $data = [
            'jobs'=> $jobs,
        ];

        return view('home.index', $data);
    }
*/

    // Liste des jobs sur la page d'accueil
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $provinces = Province::orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $professions = Profession::orderBy('name', 'ASC')->get();

        $currentPage = request()->query('page', 1);
        $sort = request()->query('sort', null);
        $query = Job::query()->with('jobs');

        $search = $request->search;
        $profession = $request->profession;
        $city = $request->city;

        $jobs = (new JobService())->getAll($query, $sort);

        $data = [
            'search' => $search,
            'profession' => $profession,
            'city' => $city,
            'jobs' => $jobs,
            'provinces' => $provinces,
            'cities' => $cities,
            'categories' => $categories,
            'professions' => $professions,
        ];


        return view('home.index', $data);
    }

    public function about()
    {
        return view('home.about');

    }

}
