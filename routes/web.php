<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


route::get('/', function(){
    return view('welcome');
});
//login 
//Route::get ('/login', [LoginController::class, 'showLoginForm'])->name(('login'));


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.secion');

Route::post('/login', [LoginController::class, 'login']);//->name('login.secion');

// Página protegida que muestra "Hola mundo"
Route::get('/holamundo', function () {
    return view('holamundo');
})->middleware('auth'); // Solo usuarios autenticados pueden entrar

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




// Ruta para mostrar el formulario
Route::get('/', [UserController::class, 'index'])->name('registro.form');

// Ruta para procesar el registro de usuario
Route::post('/store', [UserController::class, 'store'])->name('registro.store');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index'); // Para ver todos los usuarios
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show'); // Para ver un usuario específico
Route::put('/usuarios/actualizar/{id}', [UserController::class, 'update'])->name('usuarios.update'); 
//Route::delete('/usuarios/delete/{id}', [UserController::class, 'destroy'])->name('usuarios.delete'); 
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/create/us', [UserController::class, 'create']);//->name('usuarios.create');
