<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin Routes
Route::prefix('admin')->group(function() {
    Route::post('/', 'AdminApi@store');
    Route::post('/auth', 'AdminApi@authenticate');
    Route::post('/logout', 'AdminApi@logout');
    Route::get('/{id}', 'AdminApi@info');
});

// Member Routes
Route::prefix('member')->group(function() {
    Route::post('/', 'MemberApi@store');
    Route::get('/members', 'MemberApi@all');
    Route::get('/{qr_id}', 'MemberApi@info');
    Route::put('/{qr_id}', 'MemberApi@update');
});
