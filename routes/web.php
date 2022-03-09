<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LugarController;

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
    return view('map');
});

/*------------- Usuarios ----------------*/
//Vista
Route::get('secciones',[UsuarioController::class,'secciones']);
Route::get('usuarios',[UsuarioController::class,'index']);
Route::post('filtro',[UsuarioController::class,'show']);
Route::get('/crearUser',[UsuarioController::class, 'crearUsuario']);
Route::post('/crearUser',[UsuarioController::class, 'crearUsuarioPost']);
//Actualizar
Route::get('/modificarUsuario/{id}', [UsuarioController::class, 'modificarUsuario']);
Route::put('/modificarUsuario',[UsuarioController::class, 'modificarUsuarioPut']);
Route::delete('eliminar/{usuario}',[UsuarioController::class,'destroy']);


/*------------- Lugares ----------------*/
//Vista
Route::get('lugares',[LugarController::class,'index']);
Route::post('filtro',[LugarController::class,'show']);
Route::get('/crearLugar',[LugarController::class, 'crearLugar']);
Route::post('/crearLugar',[LugarController::class, 'crearLugarPost']);
//Actualizar
Route::get('/modificarLugar/{id}', [LugarController::class, 'modificarLugar']);
Route::put('/modificarLugar',[LugarController::class, 'modificarLugarPut']);
Route::delete('eliminar/{lugar}',[LugarController::class,'destroy']);