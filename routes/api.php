<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [\App\Http\Controllers\UserController::class, 'authenticate']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::post('/events/public', [\App\Http\Controllers\EventController::class, 'publicEvent']);
Route::post('/events/user', [\App\Http\Controllers\EventController::class, 'userEvent']);
Route::get('/events/get-unseen-important', [\App\Http\Controllers\EventController::class, 'getUnseenImportantEvents']);
