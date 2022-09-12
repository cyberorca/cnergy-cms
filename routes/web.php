<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
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
    return view('auth');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::get('/users', [UsersController::class, 'index']);

Route::get('/createUser', function () {
    return view('createUser');
});

// START roles feature
Route::resource('roles', RolesController::class);
// END roles feature
