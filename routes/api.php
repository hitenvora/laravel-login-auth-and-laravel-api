<?php

use App\Http\Controllers\API\RegisterController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::get('/show', [RegisterController::class, 'show']);
Route::get('/delete/{id}', [RegisterController::class, 'destroy']);
Route::get('/edit/{id}', [RegisterController::class, 'edit']);
Route::post('/update/{id}', [RegisterController::class, 'update']);
//user login
Route::post('/login', [RegisterController::class, 'login']);
