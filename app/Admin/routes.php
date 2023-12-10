<?php

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
    $router->resource('users', \App\Admin\Controllers\UserController::class);
    $router->resource('quotes', \App\Admin\Controllers\QuotesController::class);
    $router->resource('site-pages', \App\Admin\Controllers\SitePagesController::class);
    $router->resource('title-events', \App\Admin\Controllers\TitleEventsController::class);
    $router->resource('kk-notes', \App\Admin\Controllers\KkNotesController::class);
    $router->resource('kk-notes-redirects', \App\Admin\Controllers\KkNotesRedirectsController::class);
    $router->resource('books', \App\Admin\Controllers\BooksController::class);
    $router->resource('articles', \App\Admin\Controllers\ArticlesController::class);

});
