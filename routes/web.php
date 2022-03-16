<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistersUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;

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

Route::get('/inversion',   [TransactionsController::class, 'inversion'])
        ->name('transactions.inversion');
Route::post('/inversion', [TransactionsController::class, 'insert'])
        ->name('inversion.insert');  

Route::get('/reinversion',   [TransactionsController::class, 'reinversion'])
        ->name('transactions.reinversion');

Route::get('/retiro',   [TransactionsController::class, 'retiro'])
        ->name('transactions.retiro');  

Route::post('/retiro',   [TransactionsController::class, 'insert'])
        ->name('transactions.insert');  
              
Route::get('/solicitudes',   [TransactionsController::class, 'solicitudes'])
        ->name('transactions.solicitudes');     

Route::post('/solicitudes', [TransactionsController::class, 'operacion'])
        ->name('transactions.operacion');

Route::get('/estado',   [TransactionsController::class, 'estado'])
        ->name('transactions.estado');

//primero hace referencia a la url del navegador, el segundo hace referencia al controller RegistersUserController
//y el create del metodo de ese controller.
//metodo get para llamar el formulario
Route::get('/registers', [RegistersUserController::class, 'create'])
        ->name('registers.create');

//metodo post para guardar data en el metodo store de RegistersUserController//
Route::post('/registers', [RegistersUserController::class, 'store'])
        ->name('registers.store');

//metodo show para listar los usuarios//
Route::get('/show', [RegistersUserController::class, 'show'])
        ->name('registers.show');

//ruta que hace referencia a la url /{user es la variable id del usuario}
Route::get('/edit/{user}/edit', [RegistersUserController::class, 'edit'])
        ->name('registers.edit');

Route::put('/update/{user}', [RegistersUserController::class, 'update'])
        ->name('registers.update');

Route::get('/delete/{id}', [RegistersUserController::class, 'delete'])
        ->name('registers.delete');

Route::delete('/destroy/{id}', [RegistersUserController::class, 'destroy'])
        ->name('registers.destroy');

Route::get('/password{user}/password', [RegistersUserController::class, 'password'])
        ->name('registers.password');

Route::put('/updatePass{user}/updatePass', [RegistersUserController::class, 'updatePass'])
        ->name('registers.updatePass');


        











