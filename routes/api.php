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

});
Route::post('/upload',[FileController::class,'formSubmit']);
Route::get('/image/{name}',[FileController::class,'downloadImage']);
Route::get('/file/{name}',[FileController::class,'downloadFile']);
