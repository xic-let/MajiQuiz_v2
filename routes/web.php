<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');

// regista todas as rotas relacionadas com operacoes de autenticacao i.e., registo, login, reset de password, etc.
Auth::routes();

Route::post('/start-quiz', 'QuizController@startQuiz')->name('start-quiz');
Route::post('/submit-quiz', 'QuizController@submitQuiz')->name('submit-quiz');

// ->middleware('auth') vai proteger esta route e apenas deixa que seja acedida por utilizadores autenticados.
// se um utilizador nao autenticado tentar aceder a esta route, será redirecionado para a view de login
Route::get('/my-scores', 'ScoreController@getUserScores')->name('my-scores')->middleware('auth');
Route::get('/leaderboard', 'ScoreController@getLeaderboard')->name('leaderboard');
