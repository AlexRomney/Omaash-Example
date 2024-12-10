<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('faq', function () {
    return Inertia::render('Faq');
})->name('faq');

Route::get('contact', 'UserController@contact')->name('contact');
Route::post('contact', 'UserController@contactOmaash');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {

    Route::middleware('profileChecker')->group(function () {
        Route::get('profile', 'UserController@profile')->name('profile');
        Route::get('avatar-selection', 'UserController@avatarSelection')->name('avatar-selection');
        Route::post('avatar-selection', 'UserController@updateAvatar');
    });

    Route::get('edit-profile', 'UserController@editProfile')->name('user/show-profile');
    Route::post('update-profile', 'UserController@update')->name('user/update-profile');
    Route::get('search-pokemon-avatars', 'UserController@searchAvatars');
});

Route::prefix('middleman')->group(function () {

    Route::get('/', 'MiddlemanController@home')->name('middleman/home');
    Route::post('estimator', 'MiddlemanController@estimator');
    Route::get('submission/{subId}', 'MiddlemanController@submission');
    Route::get('submission-printout/{subId}', 'MiddlemanController@submissionPrintout')->name('submission/details');

    Route::middleware('auth','profileChecker')->group(function () {
        Route::get('form', 'MiddlemanController@submissionForm')->name('middleman/new-submission');

        Route::get('submissions', 'MiddlemanController@submissions')->name('middleman/submissions');
        Route::post('submission/submit', 'MiddlemanController@submit')->name('middleman/submission-submit');

        Route::get('submission/edit/{id}', 'MiddlemanController@editSub');
        Route::post('submission/edit/{id}', 'MiddlemanController@updateSub');

        Route::get('submission/{id}/cancel', 'MiddlemanController@cancelSub')->name('middleman/cancel-submission');
    });
});

Route::prefix('omaash')->group(function () {
    Route::get('videos', 'YoutubeController@videos')->name('omaash/videos');
});

Route::prefix('cards')->group(function () {
    Route::get('/', 'CardController@cards')->name('cards');
    Route::get('sets', 'CardController@sets')->name('cards/sets');
    Route::get('set/{id}', 'CardController@set');
});

Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::prefix('admin')->group(function () {

        Route::prefix('middleman')->group(function () {
            Route::get('submissions', 'Admin\MiddlemanController@submissions')->name('admin/middleman/submissions');
            Route::get('submission/edit/{id}', 'Admin\MiddlemanController@editSub');
            Route::post('submission/{id}', 'Admin\MiddlemanController@updateSubmission');
        });

        Route::prefix('users')->group(function () {
            Route::get('get-user/{id}', 'Admin\UserController@getUser');

            Route::get('/', 'Admin\UserController@users')->name('admin/users');;
            Route::post('edit/{id}', 'Admin\UserController@update');
            Route::delete('delete/{id}', 'Admin\UserController@destroy');
        });
    });
});

require __DIR__.'/auth.php';
