<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Shetabit\PageBuilder\Http\Controllers', 'as' => 'shetabit.page-builder.'], function() {
    Route::resource(config('pagebuilder.route_categories'), 'PageCategoriesController');
    Route::resource(config('pagebuilder.route_pages'), 'PagesController');
});
