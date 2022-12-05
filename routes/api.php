<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\SavedBookController;

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
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[UserController::class,'registro']);
Route::middleware(['auth:sanctum'])->group(function () {
    //categorias
    Route::get('/categories', [CategoriesController::class,'get']);
    Route::post('/categories',[CategoriesController::class,'save']);
    Route::put('/categories/{id}',[CategoriesController::class,'update']);
    Route::delete('/categories/{id}',[CategoriesController::class,'delete']);
    Route::get('/categories/{id}/books',[CategoriesController::class,'books']);//libros por categoria
    //libro
    Route::get('/book',[BookController::class,'get']);
    Route::post('/book',[BookController::class,'save']);
    Route::put('/book/{id}',[BookController::class,'update']);
    Route::delete('/book/{id}',[BookController::class,'delete']);
    Route::post('/book/save',[SavedBookController::class,'save']);//guardar libro en perfil
    Route::delete('book/delete/{id}',[SavedBookController::class,'delete']);//borrar libro de perfil
    Route::get('/book/list',[SavedBookController::class,'get']);//obtener libros de perfil
    Route::get('/book/search/{name}',[BookController::class,'name']);//buscar libro por nombre, editor, o editorial
    Route::get('/book/{id}',[BookController::class,'show']);//Lista el libro dependiendo del id

    //cita
    Route::post('/cita',[CitaController::class,'save']);
    Route::get('/cita',[CitaController::class,'get']);
    Route::put('/cita/{id}',[CitaController::class,'update']);
    Route::delete('/cita/{id}',[CitaController::class,'delete']);

    //user
    Route::get('/user',[UserController::class,'showByToken']);
    Route::put('/user',[UserController::class,'update']);
});
Route::post('/upload',[FileController::class,'formSubmit']);
Route::get('/image/{name}',[FileController::class,'downloadImage']);
Route::get('/file/{name}',[FileController::class,'downloadFile']);
