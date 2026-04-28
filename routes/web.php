<?php

use App\Http\Controllers\WeeklyMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeeklyMenuController::class, 'index']);

Route::resource('weekly-menus', WeeklyMenuController::class);

Route::post('/daily-menus/update',[WeeklyMenuController::class, 'updateMenus']);