<?php

use App\Http\Controllers\BlogController;
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


// cuando inicia el localhost salga el welcome.blade.php
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//login 
//Route::get ('/login', [LoginController::class, 'showLoginForm'])->name(('login'));


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.secion');

Route::post('/login', [LoginController::class, 'login']);//->name('login.secion');

// Página protegida que muestra "Hola mundo"
Route::get('/usuarios', function () {
    return view('usuarios');
})->middleware(['auth', 'verified']); // 👈 solo accede si verificó el correo

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//correo 
Route::middleware(['auth', 'account'])->group(function(){
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);


//

});
Route::get('/users/active/account/{token}', [LoginController::class, 'validateAccount']);



//productos 
Route::resource('posts', BlogController::class);

// Para mostrar los posts de un usuario específico
// Ruta para ver los posts de un usuario específico
Route::get('/usuarios/{id}/posts', [BlogController::class, 'userPosts'])
     ->name('user.posts')
     ->middleware('auth');






// Ruta para mostrar el formulario
//Route::get('/', [UserController::class, 'index'])->name('registro.form');

// Ruta para procesar el registro de usuario
Route::post('/store', [UserController::class, 'store'])->name('registro.store');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index'); // Para ver todos los usuarios
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show'); // Para ver un usuario específico
Route::put('/usuarios/actualizar/{id}', [UserController::class, 'update'])->name('usuarios.update'); 
//Route::delete('/usuarios/delete/{id}', [UserController::class, 'destroy'])->name('usuarios.delete'); 
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/create/us', [UserController::class, 'create']);//->name('usuarios.create');
//cuando inicie secion me salga la lista de usuarios registrados 


// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
});

//
// Mostrar posts de un usuario específico
//Route::get('/usuarios/{user}/posts', [BlogController::class, 'userPosts'])->name('user.posts');
Route::get('/usuarios/{user}/blogs', [BlogController::class, 'userBlogs'])->name('user.blogs');