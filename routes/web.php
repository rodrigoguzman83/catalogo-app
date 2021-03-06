<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductoController;


Route::get('/', [ProductoController::class, 'getAllProducts']);

##CRUD DE MARCAS
Route::get('/adminMarcas', [MarcaController::class, 'index']);
Route::get('/agregarMarca', [MarcaController::class, 'create']);
Route::post('/agregarMarca', [MarcaController::class, 'store']);
Route::get('/modificarMarca/{id}', [MarcaController::class, 'edit']);
Route::put('/modificarMarca', [MarcaController::class, 'update']);
Route::get('/eliminarMarca/{id}', [MarcaController::class, 'confirmarBaja']);
Route::delete('eliminarMarca', [MarcaController::class, 'destroy']);

##CRUD DE CATEGORIAS
Route::get('/adminCategorias', [CategoriasController::class, 'index']);
Route::get('/agregarCategoria', [CategoriasController::class, 'create']);
Route::post('/agregarCategoria', [CategoriasController::class, 'store']);
Route::get('/modificarCategoria/{id}', [CategoriasController::class, 'edit']);
Route::put('/modificarCategoria', [CategoriasController::class, 'update']);
Route::get('/eliminarCategoria/{id}', [CategoriasController::class, 'confirmarBaja']);
Route::delete('eliminarCategoria', [CategoriasController::class, 'destroy']);

##CRUD DE PRODUCTOS
//Route::get('/portada', [ProductoController::class, 'getAllProducts']);
Route::get('/adminProductos', [ProductoController::class, 'index']);
Route::get('/agregarProducto', [ProductoController::class, 'create']);
Route::post('/agregarProducto', [ProductoController::class, 'store']);
Route::get('/modificarProducto/{id}', [ProductoController::class, 'edit']);
Route::put('/modificarProducto', [ProductoController::class, 'update']);
Route::get('/eliminarProducto/{id}', [ProductoController::class, 'confirmarBaja']);
Route::delete('/eliminarProducto', [ProductoController::class, 'destroy']);
