<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BilletterieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/enregistrer-lieux', [OurController::class, 'enregistrer_lieux']);
Route::get('/enregistrer-competitions', [OurController::class, 'enregistrer_competitions']);
Route::get('/enregistrer-sports', [OurController::class, 'enregistrer_sports']);
Route::get('/enregistrer-spectateurs', [OurController::class, 'enregistrer_spectateurs']);


////USER/////

Route::get('/user/main', function () {return view('user.main');})->name('/user/main');
Route::get('/user/register',  function () {return view('user.register');})->name('/user/register');
Route::post('/user/register', [UserController::class, 'register'])->name('/user/register');
Route::get('/user/login',  function () {return view('user.login');})->name('/user/login');
Route::post('/user/login', [UserController::class, 'login'])->name('/user/login');
Route::get('/user/logout', [UserController::class, 'logout'])->name('/user/logout');

////APPLICATION/////

Route::get('/application', function () { return view('application.application');})->name('application');
Route::get('/application/programmer', [ApplicationController::class, 'programmer'])->name('/application/programmer')->middleware();
Route::post('/application/programmer', [ApplicationController::class, 'sauvegarder'])->name('/application/sauvegarder')->middleware();
Route::get('/application/gerer', [ApplicationController::class, 'gerer'])->name('/application/gerer')->middleware();
Route::get('/application/modifier/{id}', [ApplicationController::class, 'modifier'])->name('/application/modifier')->middleware();
Route::put('/application/editer/{id}', [ApplicationController::class, 'editer'])->name('/application/editer')->middleware();
Route::delete('/application/supprimer/{id}', [ApplicationController::class, 'supprimer'])->name('/application/supprimer')->middleware();


//CALENDRIER
Route::get('/calendrier', function () { return view('calendrier.calendrier');})->name('calendrier');
Route::get('/calendrier/calendrier_mensuel', [CalendrierController::class, 'afficherCalendrierMensuel'])->name('/calendrier/calendrier_mensuel');
Route::get('/calendrier/calendrier_quotidien', [CalendrierController::class, 'afficherCalendrierQuotidien'])->name('/calendrier/calendrier_quotidien');

//BILLETTERIE
Route::get('/billetterie', [BilletterieController::class, 'billetterie'])->name('billetterie');
Route::get('/billetterie/sport', [BilletterieController::class, 'affiche_sports_sport'])->name('/billetterie/sport');
Route::post('/billetterie/recapitulatif', [BilletterieController::class, 'recapitulatif'])->name('/billetterie/recapitulatif');

Route::get('/main', function () {
    return view('main');
})->name('main');

