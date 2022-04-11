<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistersUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BonosController;

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

Route::get('/profile', [SessionController::class, 'profile'])
        ->name('login.profile');

Route::post('/changePass', [SessionController::class, 'changePass'])
        ->name('login.changePass');
        
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


Route::get('/abono',   [TransactionsController::class, 'abono'])
        ->name('transactions.abono');  
Route::post('/abono',   [TransactionsController::class, 'insert'])
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

Route::get('/deleteusers/{id}', [RegistersUserController::class, 'delete'])
        ->name('registers.deleteusers');

Route::delete('/destroyusers/{id}', [RegistersUserController::class, 'destroy'])
        ->name('registers.destroy');

Route::get('/password{user}/password', [RegistersUserController::class, 'password'])
        ->name('registers.password');

Route::put('/updatePass{user}/updatePass', [RegistersUserController::class, 'updatePass'])
        ->name('registers.updatePass');

Route::get('/add/{id}', [RegistersUserController::class, 'add'])
        ->name('registers.add');

Route::post('/InsertAdd', [RegistersUserController::class, 'InsertAdd'])
        ->name('registers.InsertAdd');

Route::get('/preregister', [RegistersUserController::class, 'preregister'])
        ->name('registers.preregister');

Route::post('/InsertRegister', [RegistersUserController::class, 'InsertRegister'])
        ->name('registers.InsertRegister');

Route::get('/inversionita', [RegistersUserController::class, 'inversionita'])
        ->name('registers.inversionita');

Route::get('/deletepre/{id}', [RegistersUserController::class, 'deletepre'])
        ->name('registers.deletepre');

//Ruta Bonos//

Route::get('/bonosregister', [BonosController::class, 'index'])
        ->name('bonosregister.index');

Route::post('/bonosregister', [BonosController::class, 'store'])
        ->name('bonosregister.store');

Route::get('/bonos', [BonosController::class, 'show'])
        ->name('bonos.show');
     
Route::get('/bonos/{bono}/bonos', [BonosController::class, 'edit'])
        ->name('bonos.edit');

Route::put('/update/{bono}/update', [BonosController::class, 'update'])
       ->name('bonos.update');

Route::get('/delete/{id}', [BonosController::class, 'delete'])
       ->name('bonos.delete');

Route::delete('/destroy/{id}', [BonosController::class, 'destroy'])
       ->name('bonos.destroy');


//Ajax//

Route::get('/select/{id}', [RegistersUserController::class, 'select'])
       ->name('registers.select');

Route::get('/bloqueo/{id}', [RegistersUserController::class, 'bloqueo'])
       ->name('registers.bloqueo');

Route::get('/activar/{id}', [RegistersUserController::class, 'activar'])
       ->name('registers.activar');

Route::get('/search', [RegistersUserController::class, 'search'])
       ->name('registers.search');

Route::get('/searchT', [TransactionsController::class, 'searchT'])
        ->name('transactions.searchT');




        











