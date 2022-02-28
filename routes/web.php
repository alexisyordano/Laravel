<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistersUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('home');
});

        
Route::get('/login',  [SessionController::class, 'create'])
        ->name('login.index');
        
Route::post('/login', [SessionController::class, 'store'])
        ->name('login.store');

Route::get('/logout', [SessionController::class, 'destroy'])
        ->name('login.destroy');
        
Route::get('/home',   [HomeController::class, 'index'])
        ->name('home.index');

Route::get('/registers', [RegistersUserController::class, 'create'])
        ->name('registers.index');

Route::post('/registers', [RegistersUserController::class, 'store'])
        ->name('registers.store');

Route::get('/registers', [RegistersUserController::class, 'show'])
        ->name('registers.show');










