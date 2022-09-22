<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\TagsController;
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

Route::resource('menu', MenuController::class)->only([
    'index', 'show', 'store', 'update', 'destroy', 'edit'
]);

Route::resource('category', CategoriesController::class);

Route::resource('tag', TagsController::class);
