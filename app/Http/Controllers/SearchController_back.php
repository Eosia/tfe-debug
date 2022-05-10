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
        //$query = Job::query()->with('jobs');
        $query = request()->query('search', null);
        $search = $request->search;
        $profession = $request->profession;
        $city = $request->city;
        $order = $request->order;

        $filters = [
            'search' => $search,
            'profession' => $profession,
            'city' => $city,
            'order' => $order,
        ];
/*
        if(! $search && ! $profession && ! $city ){
            $error = "Aucun critère de recherche sélectionné.";
            return back()->withError($error);
        }
*/
        $query = Job::where(function($query) use ($filters) {
            if ($filters['search'])
            {
                $query->where('title', 'like', $filters['search'])
                    ->orWhere('description', 'like', $filters['search']);
            }
            if ($filters['profession'])
            {
                $query
                    ->leftJoin('professions', 'professions.id' ,'jobs.profession_id')
                    ->where('jobs.profession_id', '=', $filters['profession']);
            }
            if ($filters['city'])
            {
                $query
                    ->leftJoin('cities', 'cities.id' ,'jobs.city_id')
                    ->where('jobs.city_id', '=', $filters['city']);
            }
        })
            ->orderBy(function ($query) use ($filters) {

                switch ($filters['order']) {
                    case 'asc':
                        $query->select('title')->orderBy('title');
                        break;
                    case 'desc':
                        $query->select('title')->orderByDesc('title');
                        break;
                    case 'newest':
                        $query->select('updated_at')->latest('updated_at');
                    case 'oldest':
                        $query->select('updated_at')->orderBy('updated_at');
                        break;
                    case 'popular':
                        $query->select('proposals')->withCount('proposals_count')->orderBy('proposals', 'desc');
                        break;
                    default:
                        $query->select('title')->orderByDesc('title');
                        break;
                }

            });

        $currentPage = http_build_query(request()->query());

        $results = $query->paginate(10)->withQueryString();
        $jobs = fn() => (new JobService())->getAll($results, $sort);

        $data = [
          'jobs' => $jobs,
          'search' => $search,
          'profession' => $profession,
          'city' => $city,
          'query'=>$query,
          'order'=>$order,
        ];

        return view('search.search', $data);
    }
}
