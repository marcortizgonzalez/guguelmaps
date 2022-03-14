<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\GincanaController;

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

/*------------- Mapa ----------------*/
Route::get('',[LugarController::class,'index2']);


Route::get('secciones',[UsuarioController::class,'secciones']);

/*------------- Usuarios ----------------*/
//Vista
Route::get('usuarios',[UsuarioController::class,'index']);
Route::post('leer',[UsuarioController::class,'leerController']);
//Crear
Route::get('/crearUser',[UsuarioController::class, 'crearUsuario']);
Route::post('/crearUser',[UsuarioController::class, 'crearUsuarioPost']);
//Actualizar
Route::get('/modificarUsuario/{id}', [UsuarioController::class, 'modificarUsuario']);
Route::put('/modificarUsuario',[UsuarioController::class, 'modificarUsuarioPut']);
//Eliminar
Route::delete('eliminar/{id}',[UsuarioController::class,'eliminarController']);



/*------------- Lugares ----------------*/
//Vista
Route::get('lugares',[LugarController::class,'index']);
Route::post('leerlugar',[LugarController::class,'leerController']);
//Crear
Route::get('/crearLugar',[LugarController::class, 'crearLugar']);
Route::post('/crearLugar',[LugarController::class, 'crearLugarPost']);
//Actualizar
Route::get('/modificarLugar/{id}', [LugarController::class, 'modificarLugar']);
Route::put('/modificarLugar',[LugarController::class, 'modificarLugarPut']);
//Eliminar
Route::delete('eliminarLugar/{id}',[LugarController::class,'eliminarController']);



/*------------- Gincanas ----------------*/
//Vista
Route::get('gincanas',[GincanaController::class,'index']);
Route::post('leergincana',[GincanaController::class,'leerController']);
//Crear
Route::get('/crearGincana',[GincanaController::class, 'crearGincana']);
Route::post('/crearGincana',[GincanaController::class, 'crearGincanaPost']);
//Actualizar
Route::get('/modificarGincana/{id}', [GincanaController::class, 'modificarGincana']);
Route::put('/modificarGincana',[GincanaController::class, 'modificarGincanaPut']);
//Eliminar
Route::delete('eliminarGincana/{id}',[GincanaController::class,'eliminarController']);