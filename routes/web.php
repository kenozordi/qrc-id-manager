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

Route::get('/', function () {
    return redirect(route('admin.login'));
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', 'AdminController@login')->name('login');
    Route::post('/auth', 'AdminController@auth')->name('auth');
    Route::get('/logout', 'AdminController@logout')->name('logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::prefix('member')->name('member.')->group(function() {
            Route::get('/{qr_id}', 'MemberController@info')->name('info');
        });
    });
});

