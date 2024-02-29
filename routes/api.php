<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AulasController;
use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login' ,[AuthController::class, 'login']);
Route::post('register' ,[AuthController::class, 'register']);
Route::post('logout' ,[AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/backup', [AuthController::class, 'backupdatabase'])->name('backupdatabase');


Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    //aqui dentro irian las apis que se quieran consumir si es que esta iniciada la sesion
});


//traer informacion general
Route::get('aulas' ,[AulasController::class, 'index']); 
 
Route::post('aulas' ,[AulasController::class, 'store']);
//obtener aulas con el id
Route::get('aulas/{id}' ,[AulasController::class, 'show']);
//eliminar
Route::delete('aulasdelete/{id}', [AulasController::class, 'destroy']);



//traer informacion general
Route::get('estudiantes' ,[EstudiantesController::class, 'index']);
//guardar info
Route::post('estudiantes' ,[EstudiantesController::class, 'store']);
//obtener aulas con el id
Route::get('estudiantes/{id}' ,[EstudiantesController::class, 'show']);
//eliminar
Route::delete('estudiantesdelete/{id}', [EstudiantesController::class, 'destroy']);




//traer informacion general
Route::get('registro' ,[RegistroController::class, 'index']);
//guardar info
Route::post('registro' ,[RegistroController::class, 'store']);
//obtener aulas con el id
Route::get('registro/{id}' ,[RegistroController::class, 'show']);
//eliminar
Route::delete('registrodelete/{id}', [RegistroController::class, 'destroy']);





















    







