<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('index'); });
Route::get('/about', function () { return view('about'); });
Route::get('/about/terms', function () { return view('terms'); });
Route::get('/pmcalcs', function () { return view('pmcalcs'); });

Route::get('/saves', function () { return view('saves'); })->name('saves');
Route::get('/save/{save}', function (string $save) { return view('saves.'.$save); });

Route::get('/practicals', function () { return view('practicals'); })->name('practicals');
Route::get('/practical/{practical}', function (string $practical) { return view('practicals.'.$practical); });

Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/profile', function () { return view('profile'); })->middleware('auth')->name('profile');

Route::get('/tools/randomizer', function () { return view('tools.randomizer'); });
Route::get('/tools/minipaint', function () { return view('tools.minipaint'); });
