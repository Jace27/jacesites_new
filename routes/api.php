<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Route::post('/login', [Controllers\UserController::class, 'authenticate']);
Route::get('/logout', [Controllers\UserController::class, 'logout'])->name('logout');

Route::post('/user/avatar/upload', [Controllers\UserController::class, 'avatarUpload']);
Route::post('/user/options/change', [Controllers\UserController::class, 'optionsChange']);
Route::get('/user/{id}/password-flush', [Controllers\UserController::class, 'passwordFlush']);

Route::post('/events/public', [Controllers\EventController::class, 'publicEvent']);
Route::post('/events/user', [Controllers\EventController::class, 'userEvent']);
Route::get('/events/get-unseen-important', [Controllers\EventController::class, 'getUnseenImportantEvents']);

Route::post('/media/upload', [Controllers\MediaController::class, 'imageUpload']);
Route::post('/media/temp/delete', [Controllers\MediaController::class, 'deleteTemp']);
Route::post('/file/upload', [Controllers\MediaController::class, 'fileUpload']);

Route::post('/dream/add', [App\Http\Controllers\DreamDiaryController::class, 'add']);
Route::post('/dream/{id}/edit', [App\Http\Controllers\DreamDiaryController::class, 'edit']);
Route::post('/dream/tags/search', [App\Http\Controllers\DreamDiaryController::class, 'searchTags']);
