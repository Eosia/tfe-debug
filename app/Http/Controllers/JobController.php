<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{City, Job, Category, Profession, Proposal, CoverLetter, Province, Role, User};
use phpDocumentor\Reflection\Types\Nullable;
use Str, Auth ;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    //pagination
    //protected $perPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobs = Job::online()->latest()->get();
        $users = User::all();
        $professions = Profession::all();
        $proposals = Proposal::all();
        $coverLetters = CoverLetter::all();


        return view('home.index', [
            'jobs' => $jobs,
            'proposals'=>$proposals,
            'users'=>$users,
            'coverLetters'=>$coverLetters,
            'professions' => $professions,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job)
    {
        //

        $user = auth()->user();
        abort_if($user->suspended === 1, 403 );

        $cities = City::orderBy('name', 'ASC')->get();
        $professions = Profession::orderBy('name', 'ASC')->get();
        $role = auth()->user()->role_id;
        $user = auth()->user()->id;


        $data = [
            'cities' => $cities,
            'professions' => $professions,
            'user' => $user,
        ];

        //formulaire de création d'un article
        return view('jobs.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        abort_if($user->suspended === 1, 403 );
        //dd($request->all());
        //
        $job = new Job;
            $job->user_id = auth()->user()->id;
            $job->profession_id = request('profession_id');
            $job->city_id = request('city_id');
            $job->title = request('title');
            $job->time = request('time');
            $job->status = request('status');
            $job->description = request('description');
            $job->save();

        $success = 'Votre annonce a été ajoutée';

        return redirect()->route('panel.index')->withSuccess($success);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //

        $user =  auth()->user();
        abort_if($user->id != $job->user->id || $user->suspended === 1, 403 );

        $professions = Profession::orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $user = auth()->id();

        abort_if(auth()->id() != $job->user_id, 403 );

        $data = [
            'cities' => $cities,
            'professions' => $professions,
            'user' => $user,
            'job' => $job
        ];


        //dd($job);
        return view('jobs.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
        $user = auth()->user();
        abort_if($user->id != $job->user->id || $user->suspended === 1, 403 );

        $job->user_id = auth()->user()->id;
        $job->profession_id = request('profession_id');
        $job->city_id = request('city_id');
        $job->title = request('title');
        $job->time = request('time');
        $job->status = request('status');
        $job->description = request('description');
        $job->update();

        $success = "Votre annonce a été modifiée";
        return redirect()->route('panel.index')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
        abort_if(auth()->id() != $job->user_id, 403 );

        $job->delete();

        $success = "Votre annonce a été supprimée";

        return redirect()->route('panel.index')->withSuccess($success);

    }
}
