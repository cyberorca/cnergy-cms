<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FrontEndSettingsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    return view('welcome');
});

Route::get("/menu/create/{id?}", [MenuController::class, 'create'])->name('menu.create');

Route::resource('/menu/settings', FrontEndSettingsController::class);
Route::resource('menu', MenuController::class)->only([
    'index', 'show', 'store', 'update', 'destroy', 'edit'
]);

Route::resource('categories', CategoriesController::class);

Route::resource('role', RoleController::class);

Route::resource('tags', TagsController::class);

Route::resource('users', UsersController::class);
Route::get('/users/cari', [UsersController::class, 'cari']);

// Route::post('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
//     ->middleware(['auth', 'signed']) // <-- don't remove "signed"
//     ->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
