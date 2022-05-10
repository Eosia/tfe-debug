<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Services\JobService;
use App\Models\{
    City,
    Profession,
    CoverLetter,
    Job,
    Proposal,
};

use Cache, DB;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        $sort = request()->query('sort', null);
        $query = request()->query('query', null);
        $search = $request->search;
        $profession = $request->profession;
        $city = $request->city;
        //$sort = $request->order;

        $filters = [
            'search' => $search,
            'profession' => $profession,
            'city' => $city,
            'sort' => $sort
        ];

                if(! $search && ! $profession && ! $city ){
                    $error = "Aucun critère de recherche sélectionné.";
                    return back()->withError($error);
                }

        $results = Job::where(function($query) use ($filters) {
            if ($filters['search'])
            {
                $query->where('jobs.title', 'like', '%'.$filters['search'].'%')
                    ->orWhere('jobs.description', 'like', '%'. $filters['search'].'%');
            }
            if ($filters['profession'])
            {
                $query
                    ->leftJoin('professions', 'professions.id' ,'jobs.profession_id')
                    ->orWhere('jobs.profession_id', '=', $filters['profession']);
            }
            if ($filters['city'])
            {
                $query
                    ->leftJoin('cities', 'cities.id' ,'jobs.city_id')
                    ->orWhere('jobs.city_id', '=', $filters['city']);
            }
            
            //return $query;
        });

        $currentPage = http_build_query(request()->query());

        if($filters['sort'] === 'asc')
        {
            $jobs = $results
                ->orderBy('title')
                ->paginate(10)->withQueryString();
        }

        if($filters['sort'] === 'desc')
        {
            $jobs = $results
                ->orderByDesc('title')
                ->paginate(10)->withQueryString();
        }

        if($filters['sort'] === 'oldest')
        {
            $jobs = $results
                ->oldest('updated_at')
                ->paginate(10)->withQueryString();
        }
        if($filters['sort'] === 'newest')
        {
            $jobs = $results
                ->latest('updated_at')
                ->paginate(10)->withQueryString();
        }

        if($filters['sort'] === 'popular')
        {
            $jobs = $results
            ->withCount('proposals')->orderByDesc('proposals_count')
            ->paginate(10)->withQueryString();
        }

        else {
            $jobs = $results
                ->latest('updated_at')
                ->paginate(10)->withQueryString();
        }


        $data = [
            'jobs' => $jobs,
            'search' => $search,
            'profession' => $profession,
            'city' => $city,
            'query'=>$query,
            'sort'=>$sort,
            'results'=>$results
        ];

        return view('search.search', $data);
    }
}
