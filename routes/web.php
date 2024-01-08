<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/departamento',         [DepartamentoController::class, 'index']);
Route::post('/departamento',        [DepartamentoController::class, 'store']);
Route::get('/buscar',        [DepartamentoController::class, 'mostrarEmpleados']);

//Rutas para Empleados

Route::get('/empleado',         [EmpleadoController::class, 'index']);
Route::post('/empleado',        [EmpleadoController::class, 'store']);
Route::delete('/empleado/{id}', [EmpleadoController::class, 'delete']);
Route::get('/bono/{id}',   [EmpleadoController::class, 'showEmpleado']);
Route::post('/bono/{id}',  [EmpleadoController::class, 'bonos']);
