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
        
        // Stories

        Route::get('story', 'App\Http\Controllers\Story\StoryController@view')->name('admin-story');
        Route::get('story/add', 'App\Http\Controllers\Story\StoryCreateController@view')->name('admin-storyAddView');
        Route::get('story/edit/{id}', 'App\Http\Controllers\Story\StoryUpdateController@view')->name('admin-storyEditView');
        Route::post('server/story/add', 'App\Http\Controllers\Story\StoryCreateController@create')->name('admin-storyAddCMD');
        Route::post('server/story/update', 'App\Http\Controllers\Story\StoryUpdateController@update')->name('admin-storyUpdateCMD');
        Route::post('server/story/delete', 'App\Http\Controllers\Story\StoryDeleteController@delete')->name('admin-storyDeleteCMD');
        Route::post('server/story/public', 'App\Http\Controllers\Story\StoryController@changePublic')->name('admin-storyPublicCMD');

        // Story Gallery

        Route::post('server/story/create/image', 'App\Http\Controllers\Story\StoryUpdateController@createImage')->name('admin-storyCreateImage');
        Route::post('server/story/delete/image', 'App\Http\Controllers\Story\StoryUpdateController@deleteImage')->name('admin-storyDeleteImage');
        Route::post('server/story/update/image', 'App\Http\Controllers\Story\StoryUpdateController@updateImage')->name('admin-storyUpdateImage');

        // Story Terms

        Route::get('story/terms/{name}', 'App\Http\Controllers\StoryTerms\StoryTermsController@view')->name('admin-storyTerms');
        Route::post('server/story/terms/delete', 'App\Http\Controllers\StoryTerms\TermDeleteController@delete')->name('admin-storyDeleteTerms');
        Route::post('server/story/terms/update', 'App\Http\Controllers\StoryTerms\TermUpdateController@update')->name('admin-storyUpdateTerms');
        Route::post('server/story/terms/create', 'App\Http\Controllers\StoryTerms\TermCreateController@create')->name('admin-storyCreateTerms');
    });
});