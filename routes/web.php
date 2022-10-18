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
use App\Http\Controllers\News\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
        // $data = Menu::whereNull('parent_id')->with("childMenus")->get();
        // return Storage::path('/public/news/2022/10/04/03494-11419049-2.png');
        return view('welcome');
    });
    
    // Route::get("/front-end-menu/create/{id?}", [FrontEndMenuController::class, 'create'])->name('front-end-menu.create');
    // Route::resource('front-end-menu', FrontEndMenuController::class)->except(['create']);

    // Route::post("/generate/token", [FrontEndSettingsController::class, 'generateToken'])->name('generate.token');
    // Route::resource('/front-end-setting', FrontEndSettingsController::class);
    // Route::get("/menu/create/{id?}", [MenuController::class, 'create'])->name('menu.create');

    // Route::resource('menu', MenuController::class)->only([
    //     'index', 'show', 'store', 'update', 'destroy', 'edit'
    // ]);

    // Route::get("/category/create/{id?}", [CategoriesController::class, 'create'])->name('category.create');
    // Route::resource('category', CategoriesController::class)->only([
    //     'index', 'show', 'store', 'update', 'destroy', 'edit'
    // ]);

    // Route::resource('role', RoleController::class);

    // Route::resource('tag-management', TagsController::class);

    // Route::resource('user-setting', UsersController::class);

    // Route::resource('image-bank', ImageBankController::class);
    
    // Route::resource('news', NewsController::class);
    // Dashboard
    Route::prefix('dashboard')->group(function () {
    });
    
    // Master
    Route::prefix('master')->group(function () {
        
        Route::prefix('user')->group(function () {
            Route::resource('role', RoleController::class);
            Route::resource('user-setting', UsersController::class);
        });
        
        Route::get("/front-end-menu/create/{id?}", [FrontEndMenuController::class, 'create'])->name('front-end-menu.create');
        Route::resource('front-end-menu', FrontEndMenuController::class)->except(['create']);
        
        Route::post("/generate/token", [FrontEndSettingsController::class, 'generateToken'])->name('generate.token');
        Route::resource('/front-end-setting', FrontEndSettingsController::class);
        
        Route::get("/menu/create/{id?}", [MenuController::class, 'create'])->name('menu.create');
        Route::resource('menu', MenuController::class)->except(['create']);
        
        Route::get("/category/create/{id?}", [CategoriesController::class, 'create'])->name('category.create');
        Route::resource('category', CategoriesController::class)->except(['create']);
    });
    
    // Tools
    Route::prefix('tools')->group(function () {
        Route::resource('image-bank', ImageBankController::class);
    });
    
    // Documentation
    Route::prefix('documentation')->group(function () {
    });
    
    // Update
    Route::prefix('update')->group(function () {
        Route::prefix('news')->group(function () {
            Route::post('/pagination/api/delete/', [NewsController::class, 'deleteNewsPagination'])->name('news.api.news_pagination');
            Route::resource('news', NewsController::class);
            Route::resource('video', VideoController::class);
        });
        Route::prefix('tags')->group(function () {
            Route::resource('tag-management', TagsController::class);
        });
    });
    
    
    Route::get('image/{filename}', [ImageBankController::class, 'displayImage'])->name('image.displayImage');
    Route::get('/image-bank/api/list/', [ImageBankController::class, 'apiList'])->name('image_bank.api');
});
// Route::post('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
//     ->middleware(['auth', 'signed']) // <-- don't remove "signed"
//     ->name('verification.verify');

Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/email/verify/{token}', [LoginController::class, 'verify'])->name('email.verify');
Route::post('/front-end-menu/order/update', [FrontEndMenuController::class, 'changeOrderMenu'])->name('front-end-menu.order');

