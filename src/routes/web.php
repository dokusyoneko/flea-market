<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [AuthController::class, 'index']);


Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');


Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/profile', [MypageController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/profile', [MypageController::class, 'update'])->name('mypage.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'showSellForm'])->name('item.sell');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/purchase/address', [PurchaseController::class, 'editAddress'])->name('address.edit');
    Route::post('/purchase/address', [PurchaseController::class, 'updateAddress'])->name('address.update');
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
});

Route::middleware('auth')->group(function () {
    Route::post('/products/{id}/like', [LikeController::class, 'toggle'])
    ->name('products.like');
});

Route::middleware('auth')->group(function () {
    Route::post('/products/{id}/comments', [CommentController::class, 'store'])
    ->name('products.comment');
});
