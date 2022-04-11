<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', UserController::class);
    Route::get('/users/search/{name}', [UserController::class, 'search']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// Routes List
/**
* Route::post('/users', [UserController::class, 'store']);
* Route::get('/users', [UserController::class, 'index']);
* Route::get('/users/{id}', [UserController::class, 'show']);
* Route::get('/users/search/{name}', [UserController::class, 'search']);
* Route::put('/users/{id}', [UserController::class, 'update']);
* Route::delete('/users/{id}', [UserController::class, 'destroy']);
*/
