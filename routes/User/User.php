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
        
        // User managment

        Route::get('users', 'App\Http\Controllers\User\UserController@view')->name('admin-users');
        Route::post('server/users/delete', 'App\Http\Controllers\User\UserController@delete')->name('admin-deleteUser');
        Route::post('server/users/create', 'App\Http\Controllers\User\UserController@create')->name('admin-createUser');

        // User Profile

        Route::get('user-profile', 'App\Http\Controllers\User\UserProfileController@view')->name('admin-userProfile');
        Route::post('server/password/change', 'App\Http\Controllers\User\UserProfileController@changePassword')->name('admin-changeUserPassword');
    });
});