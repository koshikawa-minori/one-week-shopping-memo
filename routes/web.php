<?php

use App\Http\Controllers\WeeklyMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeeklyMenuController::class, 'index']);

Route::resource('weekly-menus', WeeklyMenuController::class);

// 献立
Route::post('/daily-menus/update',[WeeklyMenuController::class, 'updateMenus']);

// 買い物メモ
Route::post('/shopping-items/store',[WeeklyMenuController::class, 'storeItem']);

// チェックボックス
Route::post('/shopping-items/{shoppingItem}/toggle', [WeeklyMenuController::class, 'toggleItem']);