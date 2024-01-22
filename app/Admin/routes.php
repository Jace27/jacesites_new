<?php

use App\Admin\Controllers\ArticlesController;
use App\Admin\Controllers\BooksController;
use App\Admin\Controllers\DreamDiaryTagGroupsController;
use App\Admin\Controllers\DreamDiaryTagsController;
use App\Admin\Controllers\DreamsLocationsController;
use App\Admin\Controllers\DreamsLocationsTypesController;
use App\Admin\Controllers\KkNotesController;
use App\Admin\Controllers\KkNotesRedirectsController;
use App\Admin\Controllers\MapLocationsController;
use App\Admin\Controllers\OptionPagesController;
use App\Admin\Controllers\OptionsController;
use App\Admin\Controllers\QuotesController;
use App\Admin\Controllers\SitePagesController;
use App\Admin\Controllers\TitleEventsController;
use App\Admin\Controllers\UserController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('quotes', QuotesController::class);
    $router->resource('site-pages', SitePagesController::class);
    $router->resource('title-events', TitleEventsController::class);
    $router->resource('kk-notes', KkNotesController::class);
    $router->resource('kk-notes-redirects', KkNotesRedirectsController::class);
    $router->resource('books', BooksController::class);
    $router->resource('articles', ArticlesController::class);
    $router->resource('option-pages', OptionPagesController::class);
    $router->resource('options', OptionsController::class);

    $router->resource('dreams-locations-types', DreamsLocationsTypesController::class);
    $router->resource('dreams-locations', DreamsLocationsController::class);
    $router->resource('dream-diary-tag-groups', DreamDiaryTagGroupsController::class);
    $router->resource('dream-diary-tags', DreamDiaryTagsController::class);
    $router->resource('map-locations', MapLocationsController::class);

});
