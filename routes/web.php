<?php

use App\Http\Controllers\Body_PartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [PagesController::class, 'index']);
Route::get('/myTrainings', [PagesController::class, 'myTrainings']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('bodyParts', Body_PartController::class);
Route::resource('workouts', WorkoutController::class);
Route::resource('trainings', TrainingController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
