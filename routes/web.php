<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\{
    HomeController,
    JobController,
    PanelController,
    ProposalController,
    ConversationController,
    SearchController,
    UserController,
    ContactController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'about'])->name('home.about');
Route::get('/stages', [HomeController::class, 'index'])->name('home.index');


// route de la liste des jobs
Route::resource('/jobs', JobController::class)->except('show');

// route d'une annonce
Route::get('/stage/{job}', [JobController::class, 'show'])->name('jobs.show');

// route pour le formulaire de recherche
Route::get('/query', [SearchController::class, 'search'])->name('search');

// route du profil d'un user
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

// route de la page contact
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
// route d'envoi du mail
Route::post('/send-message', [ContactController::class, 'send'])->name('contact.send');

// routes d'authentification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    //route du dashboard utilisateur
    Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');

    //route d'acceptation d'une candidature
    Route::get('confirmProposal/{proposal}', [ProposalController::class, 'confirm'])->name('confirm.proposal');
    //route de suppresion d'une candidature
    Route::delete('deleteProposal/{proposal}', [ProposalController::class, 'destroy'])->name('delete.proposal');

    //route qui retourne la liste des conversatins d'un user
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    //route de la vue d'une conversation
    Route::get('/conversation/{conversation}', [ConversationController::class, 'show'])->name('conversation.show');

});

// routes proposal pour ne pas permettre plus d'une candidature à une annonce
Route::group(['middleware' => ['auth:sanctum', 'proposal']], function () {
    Route::post('/submit/{job}', [ProposalController::class, 'store'])->name('proposals.store');
});


// redirections

//index des jobs vers page home
//Route::permanentRedirect('/jobs','/');

//dashboard vers panel
Route::permanentRedirect('/dashboard', '/panel');


