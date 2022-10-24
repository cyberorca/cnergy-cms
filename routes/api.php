<?php

use App\Http\Controllers\Api\FrontEndMenuController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FrontEndSettingsController;
use App\Http\Controllers\Api\StaticPageController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\NewsController;
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
Route::middleware(['verifyTokenApi'])->group(function(){

    Route::resource('menu', MenuController::class)->only([
        'index', 'show', 'store', 'update', 'destroy', 'edit'
    ]);
    Route::resource('category', CategoriesController::class);

    Route::resource('tag', TagsController::class);

    Route::resource('fe-setting', FrontEndSettingsController::class);

    Route::resource('setting-fe-menu', FrontEndMenuController::class);

    Route::resource('video', VideoController::class);

    Route::resource('static-page', StaticPageController::class);

    Route::resource('news', NewsController::class);
});


