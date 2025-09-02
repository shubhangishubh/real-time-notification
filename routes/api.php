<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersRegisteredController;
use App\Http\Controllers\RealTaskController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logoutUsers', [usersRegisteredController::class, 'logoutUsers']);
    Route::apiResource('create-real-tasks', RealTaskController::class)->only(['store']);
});

Route::post('/usersRegister', [usersRegisteredController::class, 'usersRegister']);
Route::post('/loginUsers', [usersRegisteredController::class, 'loginUsers']);
