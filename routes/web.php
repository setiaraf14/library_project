<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;

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


Route::get('/new-register', [UserController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::prefix('profile')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'detail');
            Route::post('/store', 'store');
            Route::post('/change-password', 'changePassword');
            Route::post('/edit/{id}', 'edit');
            Route::get('/list', 'listMember')->middleware('accessMember');
            Route::get('/delete/{id}', 'delete')->middleware('accessMember');
        });
    });

    Route::prefix('book')->group(function () {
        Route::controller(BukuController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store-book/{id?}', 'storeBook')->middleware('accessMember');
            Route::get('/delete/{id}', 'deleteBook')->middleware('accessMember');
            Route::get('/detail/{id}', 'detailBook');
        });
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
