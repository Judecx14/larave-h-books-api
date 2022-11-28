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
    Route::get('/categories/{id}/books',[CategoriesController::class,'books']);
    //libro
    Route::get('/book',[BookController::class,'get']);
    Route::post('/book',[BookController::class,'save']);
    Route::put('/book/{id}',[BookController::class,'update']);
    Route::delete('/book/{id}',[BookController::class,'delete']);
    Route::post('/book/save',[SavedBookController::class,'save']);
    Route::delete('book/delete/{id}',[SavedBookController::class,'delete']);
    Route::get('/book/list',[SavedBookController::class,'get']);
    Route::get('/book/search/{name}',[BookController::class,'name']);
    //cita
    Route::post('/cita',[CitaController::class,'save']);
    Route::get('/cita',[CitaController::class,'get']);
    Route::put('/cita/{id}',[CitaController::class,'update']);
    Route::delete('/cita/{id}',[CitaController::class,'delete']);
});
Route::post('/upload',[FileController::class,'formSubmit']);
Route::get('/image/{name}',[FileController::class,'downloadImage']);
Route::get('/file/{name}',[FileController::class,'downloadFile']);
