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
        Route::get('/', function () {
            return view('homepage');
        })->name("homepage");
        Route::get('server/darkMode', 'App\Http\Controllers\DarkModeController@switch')->name('switch-darkMode');
        Route::get('server/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('admin-logout');
    
        // Switch domain
    
        Route::get('server/switch/domain/{id}', 'App\Http\Controllers\Domain\DomainController@switchDomain')->name('admin-switchDomain');
        Route::get('server/domain/reset', 'App\Http\Controllers\Domain\DomainController@resetDomain')->name('admin-resetDomain');
    
        // Company
    
        Route::get('/company-setting', 'App\Http\Controllers\Company\CompanyController@view')->name('admin-company');
        Route::post('server/company-setting/update', 'App\Http\Controllers\Company\CompanyController@edit')->name('admin-editCompany'); 
    });
});


Route::get('/login', function () {
    return view('pages.Auth.login');
})->name("login");

Route::get('/forgot-password', function () {
    return view('pages.Auth.forgot-password');
})->name("forgor-password");
Route::get('forgot-password/verify/{id}', 'App\Http\Controllers\Auth\LoginController@verifyTokenPage');

// Route::get('test/migrate', 'App\Http\Controllers\Migration\MigrationController@generateSlug');

Route::post('server/login', 'App\Http\Controllers\Auth\LoginController@login')->name('admin-login');
Route::post('server/forgot-password', 'App\Http\Controllers\Auth\LoginController@forgotPassword')->name('admin-forgotPassword');
Route::post('server/verify-token', 'App\Http\Controllers\Auth\LoginController@verifyPassword')->name('admin-verifyPassword');