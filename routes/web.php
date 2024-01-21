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

Route::get('/',             function () { return view('index'); });
Route::get('/about',        function () { return view('about'); })->name('about');
Route::get('/about/terms',  function () { return view('terms'); })->name('terms');
Route::get('/dreammap',     function () { return view('dreammap'); })->name('dreammap');
Route::get('/challenges',   function () { return view('challenges'); })->name('challenges');
Route::get('/competitions', function () { return view('competitions'); })->name('competitions');
Route::get('/pmcalcs',      function () { return view('pmcalcs'); })->name('pmcalcs');

Route::get('/profile',          function () { return view('profile', ['requested_user' => null]); })->name('profile');
Route::get('/profile/{user}',   function (string $user) { return view('profile', ['requested_user' => $user]); });

Route::get('/dream/new',        function () { return view('dreams.new'); });
Route::get('/dream/{id}',       function (int $id) { return view('dreams.view', ['dream_id' => $id]); });
Route::get('/dream/{id}/edit',  function (int $id) { return view('dreams.edit', ['dream_id' => $id]); });
Route::get('/dreams',           function () { return view('dreams.index'); })->name('dreams');

Route::get('/articles',         function () { return view('articles', ['slug' => null]); })->name('articles');
Route::get('/article/{slug}',   function (string $slug) { return view('articles', ['slug' => $slug]); });

Route::get('/library',          function () { return view('library', ['slug' => null]); })->name('library');
Route::get('/library/{slug}',   function (string $slug) { return view('library', ['slug' => $slug]); });

Route::get('/saves',        function () { return view('saves'); })->name('saves');
Route::get('/save/{save}',  function (string $save) { return view('saves.'.$save); });

Route::get('/practicals',           function () { return view('practicals'); })->name('practicals');
Route::get('/practical/{practical}',function (string $practical) { return view('practicals.'.$practical); });

Route::get('/kk_notes', function () { return view('kk_notes', ['slug' => null]); })->name('kk_notes');
Route::get('/kk_notes/{slug}', function (string $slug) {
    if (!is_null($redirect = \App\Models\KkNotesRedirects::whereOldLink($slug)->first())) {
        return redirect('/kk_notes/'.$redirect->new_link);
    }
    if (!\App\Models\KkNotes::whereSlug($slug)->exists()) {
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'].'/not_found.txt',
            file_get_contents($_SERVER['DOCUMENT_ROOT'].'/not_found.txt').PHP_EOL.$slug
        );
        return abort(404);
    }
    return view('kk_notes', ['slug' => $slug]);
});

Route::get('/login',    function () { return redirect('/'); })->name('login');
Route::get('/profile',  function () { return view('profile'); })->middleware('auth')->name('profile');

Route::get('/tools/randomizer', function () { return view('tools.randomizer'); });
Route::get('/tools/minipaint',  function () { return view('tools.minipaint'); });
