<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::post('/registration', [App\Http\Controllers\ApiController::class, 'register']);
Route::post('/login', [App\Http\Controllers\ApiController::class, 'login']);

//category
Route::get('/category/index', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/category/status/{id}', [App\Http\Controllers\CategoryController::class, 's']);
Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
