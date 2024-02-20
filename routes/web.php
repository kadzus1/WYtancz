<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PostController;
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

//Main
Route::get('/', function () {return view('main');});

//Zakładka "o projekcie"
Route::get('/subpage/creators', function () {return view('subpage.creators');})->name('creators');

//Zakładka "blog"
Route::get('/subpage/blog',[PostController::class, 'post'])->name('blog');

//Strona główna z interaktywnym kalendarzem
Route::get('/welcome',[TournamentController::class, 'getTournamentDates'])->name('welcome');

//Listy startowe
Route::get('more/startList/{tournamentId}', [TournamentController::class, 'startList'])->name('startList');
//Zakładka more ze szczegółowymi informacjami o turnieju
Route::get('/more/{id}', [TournamentController::class, 'moretournament'])->name('tournaments.more');

//Logowanie
Route::get('/login', function () {return view('auth.login');})->name('login');

//Rejestracja
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);       

//Przejście do listy turniejów solowych
Route::get('/tournament', [TournamentController::class, 'tournament'])->name('tournaments.tournament');
//Przejście do turiejów grupowych
Route::get('/tournamentGroup', [TournamentController::class, 'tournamentGroup'])->name('tournaments.tournamentGroup');


Route::middleware('auth')->group(function () {

    //Tablica dla zalogowanego
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

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

   //Wiadomość o statusie turnieju, czy zapisy otwart czy zamknięte
   Route::get('/api/tournaments/{tournamentId}/status', [TournamentController::class, 'getStatus']);

   //Trasa dla usunięcia uczestnika turnieju
   Route::delete('/tournaments/remove-participant/{id}', [TournamentController::class, 'removeParticipant'])
            ->name('removeParticipant');

    //Trasa dla edycji uprawnień
    Route::put('/users/{id}/updateRole', [ProfileController::class, 'updateUserRole'])->name('updateUserRole');

    Route::get('/api/tournaments/{tournamentId}/checkRole', [TournamentController::class, 'checkRole'])
    ->name('checkRole');

    //Blog
    Route::get('/subpage/blog/create', [PostController::class, 'create'])->name('create-post');
    Route::post('/subpage/blog', [PostController::class, 'store'])->name('store-post');

});

require __DIR__.'/auth.php';

