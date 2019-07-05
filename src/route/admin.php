<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/user', function () {
        return Auth::user();
    });

    Route::get('/users', function() {
        return User::paginate(3);
    });
});

Route::group(['middleware' => 'guest:api', 'prefix' => 'admin'], function () {
    Route::post('/login', 'App\Http\Controllers\Admin\LoginController@login');
});

Route::get('/admin/{path?}', function () {
    return view('admin.index');
})->where('path', '.*');
