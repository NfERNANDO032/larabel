<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

// Autenticación
//route::post("/loginR",[UserController::class, "store"]);

//route::post("/login", [AuthController::class, "register"]);




Route::middleware('auth:api')->get('/profile', [AuthController::class, 'profile']);
//Route::post('/register', [UserController::class, 'register']);

Route::post('/register', [AuthController::class, 'register']);////7
Route::post('/login', [AuthController::class, 'login']);


// 🔐 Rutas protegidas con JWT (auth:api)
Route::middleware('auth:api')->group(function () {

    // Autenticación
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/blogs', [BlogController::class, 'store']);//crear blog
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Editar blog   
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']); // Eliminar blog
    Route::get('/blogs/{id}', [BlogController::class, 'show']);    // Ver un blog por ID
    Route::get('/usuarios/{user}/blogs', [BlogController::class, 'userBlogs']); // Blogs de un usuario
    Route::get('/blogs', [BlogController::class, 'index']); // Ver todos los blogs


    // Usuarios
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);


});
// Blogs (tabla: productos)
/* Route::post('/blogs', [BlogController::class, 'store']);      // Crear blog
Route::put('/blogs/{id}', [BlogController::class, 'update']); // Editar blog
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']); // Eliminar blog
Route::get('/blogs/{id}', [BlogController::class, 'show']);    // Ver un blog por ID
Route::get('/usuarios/{user}/blogs', [BlogController::class, 'userBlogs']); // Blogs de un usuario */
