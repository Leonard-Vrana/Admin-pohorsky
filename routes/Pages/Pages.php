<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('pages', 'App\Http\Controllers\Pages\PageController@view')->name('admin-pages');
        Route::get('page/add', 'App\Http\Controllers\Pages\PageController@add')->name('admin-addPage');
        Route::get('page/edit/{id}', 'App\Http\Controllers\Pages\PageController@edit')->name('admin-editPage');
    
        Route::post('server/page/add', 'App\Http\Controllers\Pages\PageController@createPage')->name('admin-createPage');
        Route::post('server/page/edit', 'App\Http\Controllers\Pages\PageController@editPage')->name('admin-updatePage');
        Route::post('server/page/delete', 'App\Http\Controllers\Pages\PageController@deletePage')->name('admin-deletePage');
    
    
        // Menu
    
        Route::get('menu', 'App\Http\Controllers\Menu\MenuController@view')->name('admin-menu');
    
        Route::post('server/menu/add', 'App\Http\Controllers\Menu\MenuController@create')->name('admin-createMenu');
        Route::post('server/menu/edit', 'App\Http\Controllers\Menu\MenuController@edit')->name('admin-editMenu');
        Route::post('server/menu/delete', 'App\Http\Controllers\Menu\MenuController@delete')->name('admin-deleteMenu');
    });
});