<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriasController;


Route::get('/', function () {
    return view('welcome');
});

##CRUD DE MARCAS
Route::get('/adminMarcas', [MarcaController::class, 'index']);
Route::get('/agregarMarca', [MarcaController::class, 'create']);
Route::post('/agregarMarca', [MarcaController::class, 'store']);
Route::get('/modificarMarca/{id}',[MarcaController::class,'edit']);
Route::put('/modificarMarca',[MarcaController::class,'update']);
Route::get('/eliminarMarca/{id}',[MarcaController::class,'confirmarBaja']);

##CRUD DE CATEGORIAS
Route::get('/adminCategorias', [CategoriasController::class, 'index']);
Route::get('/agregarCategoria', [CategoriasController::class, 'create']);
Route::post('/agregarCategoria',[CategoriasController::class,'store']);
Route::get('/modificarCategoria/{id}',[CategoriasController::class,'edit']);
Route::put('/modificarCategoria',[CategoriasController::class,'update']);
