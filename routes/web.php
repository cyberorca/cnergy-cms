<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FrontEndMenuController;
use App\Http\Controllers\Admin\FrontEndSettingsController;
use App\Http\Controllers\Admin\ImageBankController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Models\ImageBank;
use App\Models\News;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        Lfm::routes();
    });
    Route::get('/', function () {
        $modal = true;
        $image_bank = ImageBank::all();
        return view('welcome', compact('modal', 'image_bank'));
    });

    Route::get("/front-end-menu/create/{id?}", [FrontEndMenuController::class, 'create'])->name('front-end-menu.create');
    Route::resource('front-end-menu', FrontEndMenuController::class)->except(['create']);

    Route::post("/generate/token", [FrontEndSettingsController::class, 'generateToken'])->name('generate.token');
    Route::resource('/front-end-setting', FrontEndSettingsController::class);
    Route::get("/menu/create/{id?}", [MenuController::class, 'create'])->name('menu.create');

    Route::resource('menu', MenuController::class)->only([
        'index', 'show', 'store', 'update', 'destroy', 'edit'
    ]);

    Route::get("/category/create/{id?}", [CategoriesController::class, 'create'])->name('category.create');
    Route::resource('category', CategoriesController::class)->only([
        'index', 'show', 'store', 'update', 'destroy', 'edit'
    ]);

    Route::resource('role', RoleController::class);

    Route::resource('tags', TagsController::class);

    Route::resource('user-setting', UsersController::class);
    
    Route::get('/image-bank/api/list/', [ImageBankController::class, 'apiList'])->name('image_bank.api');
    Route::resource('image-bank', ImageBankController::class);

    Route::resource('news', NewsController::class);
});
// Route::post('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
//     ->middleware(['auth', 'signed']) // <-- don't remove "signed"
//     ->name('verification.verify');

Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/email/verify/{token}', [LoginController::class, 'verify'])->name('email.verify');
Route::post('/front-end-menu/order/update',[FrontEndMenuController::class,'changeOrderMenu'])->name('front-end-menu.order');

// Route::post('/news', [NewsController::class, 'index']);
