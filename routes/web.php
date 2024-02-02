<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TournamentParticipantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\UserTournamentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/welcome', function () {
    return view('welcome');})->name('welcome');

Route::get('more/startList/{tournamentId}', [TournamentController::class, 'startList'])->name('startList');


Route::get('/login', function () {
        return view('auth.login');})->name('login');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);       

Route::get('/more/{id}', [TournamentController::class, 'moretournament'])->name('tournaments.more');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tournament', [TournamentController::class, 'tournament'])->name('tournaments.tournament');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tournaments
    Route::get('/addtournament', [TournamentController::class, 'create'])->name('tournaments.addtournament');
    Route::patch('/storetournament', [TournamentController::class, 'store'])->name('tournaments.store');

    // User tournaments
    Route::get('/tournaments/user-tournaments', [UserTournamentsController::class, 'usertournaments'])->name('tournaments.user-tournaments.usertournaments');

    //Admin tournament, profiles
    Route::get('/tournaments/user-tournaments/admin/alltournaments', [TournamentController::class, 'alltournament'])->name('tournaments.user-tournaments.admin.alltournaments');
    Route::get('/tournaments/user-tournaments/admin/allprofiles', [ProfileController::class, 'show'])->name('tournaments.user-tournaments.admin.allprofiles');


    // Edycja turnieju
    Route::get('/tournaments/{tournament}/edit', [UserTournamentsController::class, 'edit'])->name('tournaments.user-tournaments.edit-tournament');
    Route::patch('/tournaments/{tournament}/update', [UserTournamentsController::class, 'update'])->name('tournaments.user-tournaments.update');
    Route::get('/tournaments/{tournament}', [UserTournamentsController::class, 'show'])->name('tournaments.user-tournaments.edit-tournament');


    // Usuwanie turnieju
    Route::delete('/tournaments/{tournament}', [UserTournamentsController::class, 'destroy'])->name('tournaments.user-tournaments.destroy');


   // Trasa dla wyświetlenia formularza dla tancerzy
   Route::get('/tournaments/more/joinEventDancer/{id}', [TournamentController::class, 'dancerJoinForm'])->name('tournaments.dancerJoinForm');

   // Trasa dla obsługi zapisu danych dla tancerzy
   Route::post('/tournaments/more/joinEventDancer/{id}', [TournamentController::class, 'joinEventDancer'])->name('tournaments.joinEventDancer');

   // Trasa dla wyświetlenia formularza dla szkoły tańca
   Route::get('/tournaments/more/joinEventSchool/{id}', [TournamentController::class, 'schoolJoinForm'])->name('tournaments.joinEventSchool');

    // Trasa dla obsługi zapisu danych dla tancerzy
   Route::post('/tournaments/more/joinEventSchool/{id}', [TournamentController::class, 'joinEventSchool'])->name('tournaments.joinEventSchool');

   Route::get('/api/tournaments/{tournamentId}/status', [TournamentController::class, 'getStatus']);

   Route::delete('/tournaments/remove-participant/{id}', [TournamentController::class, 'removeParticipant'])
            ->name('removeParticipant');
   
});

require __DIR__.'/auth.php';

