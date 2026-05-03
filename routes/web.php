<?php

use App\Http\Controllers\WeeklyMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeeklyMenuController::class, 'index']);

Route::resource('weekly-menus', WeeklyMenuController::class);

// 献立
Route::post('/daily-menus/update',[WeeklyMenuController::class, 'updateMenus'])->name('daily-menus.update');

// 買い物メモ
Route::post('/shopping-items/store',[WeeklyMenuController::class, 'storeItem'])->name('shopping-items.store');

// チェックボックス
Route::post('/shopping-items/{shoppingItem}/toggle', [WeeklyMenuController::class, 'toggleItem'])->name('shopping-items.toggle');

// 対象の買い物メモ削除
Route::delete('/shopping-items/{shoppingItem}', [WeeklyMenuController::class, 'destroyItem'])->name('shopping-items.destroy');