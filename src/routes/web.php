<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');


Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    Route::post('/mypage/profile', [MypageController::class, 'update'])->name('mypage.update');
});

Route::middleware(['auth', 'verified.custom'])->group(function () {
    Route::get('/mypage/profile', [MypageController::class, 'edit'])->name('mypage.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'showSellForm'])->name('item.sell');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress'])->name('address.edit');
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('address.update');
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/products/{id}/like', [LikeController::class, 'toggle'])
    ->name('products.like');
});

Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/comments', [CommentController::class, 'store'])
    ->name('products.comment');
});


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('mypage.edit');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/email/verify/guide', function () {
    return view('auth.verify-guide');
})->middleware('auth')->name('verification.notice.custom');

