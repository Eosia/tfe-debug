<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\{
    City,
    Job,
    Category,
    Profession,
    Proposal,
    CoverLetter,
    Province,
    Role,
    User
};

class UserController extends Controller
{

    public function show(Request $request, User $user)
    {

        $user = $request->user;
        $jobs = $user->load('jobs')->latest('updated_at')->first();

        $data = [
            'user' => $user,
            'jobs' => $jobs,
        ];


        return view('user.show', $data);
    }
}
