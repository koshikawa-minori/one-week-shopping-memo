<?php

use App\Http\Controllers\WeeklyMenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SimpleAuth;


// ログイン画面
Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $inputPassword = $request->input('password');
    $password = env('SIMPLE_AUTH_PASSWORD');

    if ($inputPassword === $password) {
        $request->session()->put('is_logged_in', true);
        return redirect('/');
    }

    return redirect()->route('login');
});

Route::post('/logout', function (Request $request) {
    $request->session()->forget('is_logged_in');
    return redirect()->route('login');
});

Route::middleware(SimpleAuth::class)->group(function () {

    Route::get('/', [WeeklyMenuController::class, 'index']);

    Route::resource('weekly-menus', WeeklyMenuController::class);

    // 献立
    Route::post('/daily-menus/update',[WeeklyMenuController::class, 'updateMenus'])->name('daily-menus.update');

    // 買い物メモ
    Route::post('/shopping-items/store',[WeeklyMenuController::class, 'storeItem'])->name('shopping-items.store');

    // チェックボックス
    Route::post('/shopping-items/{shoppingItem}/toggle', [WeeklyMenuController::class, 'toggleItem'])->name('shopping-items.toggle');

    // 買い物メモ全削除
    Route::delete('/shopping-items', [WeeklyMenuController::class, 'destroyAllItems'])->name('shopping-items.destroy-all');

    // 対象の買い物メモ削除
    Route::delete('/shopping-items/{shoppingItem}', [WeeklyMenuController::class, 'destroyItem'])->name('shopping-items.destroy');

});
