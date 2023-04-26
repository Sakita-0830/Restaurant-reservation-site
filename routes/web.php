<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// ShopController処理
// 店舗一覧表示
Route::get('/', [ShopController::class, 'index']);
// 店舗詳細表示
Route::get('/detail', [ShopController::class, 'detail']);

// RegisteredUserController処理
// 会員登録ページ表示
Route::get('/thanks', [RegisteredUserController::class, 'thanks']);

// UserController処理
// マイページ表示
Route::get('/mypage', [UserController::class, 'index']);

// ReservationController処理
// 予約完了画面表示
Route::get('/done', [ReservationController::class, 'thanks']);
// 予約項目選択処理
Route::get('/select', [ReservationController::class, 'select']);
// 予約処理
Route::post('/reserve/add', [ReservationController::class, 'store']);
// 予約削除
Route::post('/reserve/delete', [ReservationController::class, 'destroy']);

// FavoriteController処理
// お気に入り登録
Route::post('/favorite/add', [FavoriteController::class, 'store']);
// お気に入り削除
Route::post('/favorite/delete', [FavoriteController::class, 'destroy']);
