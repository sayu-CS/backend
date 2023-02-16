<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\detailsController;
use App\Http\Controllers\AuthController;
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






//protected routes
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/get', [detailsController::class, 'index']);
    Route::delete('/delete/{id}', [detailsController::class, 'destroy']);  
    Route::post('/add_items', [detailsController::class, 'store']); 
    Route::put('/edit_items/{id}/{em}', [detailsController::class, 'update']); 
});

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/show', [AuthController::class, 'showtokens']);
Route::get('/showuser', [AuthController::class, 'showuser']);
Route::get('/?', function(){
    return "Well this is running but the connection is not setup";
});

