<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyMenu;
use App\Models\DailyMenu;
use App\Models\ShoppingItem;
use Carbon\Carbon;

class WeeklyMenuController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ja');
        $weeklyMenu = WeeklyMenu::orderBy('created_at', 'desc')->first();

        if (!$weeklyMenu) {
            return view('weekly-menus.index', [
                'dailyMenus' => collect(),
                'shoppingItems' => collect(),
                'foodItems' => collect(),
                'dailyItems' => collect(),
                'otherItems' => collect(),
            ]);
        }

        $dailyMenus = DailyMenu::where('weekly_menu_id', $weeklyMenu->id)
            ->orderBy('date')
            ->get();

        $shoppingItems = ShoppingItem::orderBy('item_name')->get();

        $foodItems = $shoppingItems->where('category', '食料品');
        $dailyItems  = $shoppingItems->where('category', '日用品');
        $otherItems  = $shoppingItems->where('category', 'その他');

        return view('weekly-menus.index', compact('dailyMenus', 'shoppingItems', 'foodItems', 'dailyItems', 'otherItems'));
    }

    public function create()
    {
        return view('weekly-menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required'
        ],
        [
            'start_date.required' => '日付を選択してください',
        ]);

        $weeklyDate = $request->start_date;
        $weeklyMenu = WeeklyMenu::create([
            'start_date' => $weeklyDate
        ]);

        for ($dayNumber = 0; $dayNumber < 7; $dayNumber++) {

            DailyMenu::create([
                'weekly_menu_id' => $weeklyMenu->id,
                'date' => $weeklyMenu->start_date
                ->copy()
                ->addDays($dayNumber),
                'meal_time' => 'dinner',
                'menu'=> null,
            ]);
        }

        return redirect()->route('weekly-menus.index');
    }

    public function storeItem(Request $request)
    {

        $weeklyMenu = WeeklyMenu::orderBy('created_at', 'desc')->first();

        $request->validate([
            'item_name' => 'required',
            'category' => 'required',
        ],
        [
            'item_name.required' => '商品名を入力してください',
            'category.required' => 'カテゴリを選択してください',
        ]);

        ShoppingItem::create([
            'item_name' => $request->item_name,
            'category' => $request->category,
        ]);

        return redirect()->route('weekly-menus.index');
    }

    public function updateMenus(Request $request)
    {
        $menus = $request->menus;

        foreach ($menus as $dailyMenuId => $menu)
        {
            $dailyMenu = DailyMenu::find($dailyMenuId);
            $dailyMenu->menu = $menu;
            $dailyMenu->save();
        }

        return redirect()->route('weekly-menus.index');
    }

    public function toggleItem(ShoppingItem $shoppingItem)
    {
        $shoppingItem->is_checked = !$shoppingItem->is_checked;
        $shoppingItem->save();

        return redirect()->route('weekly-menus.index');
    }

    public function destroyItem(ShoppingItem $shoppingItem)
    {
        $shoppingItem->delete();

        return redirect()->route('weekly-menus.index');
    }
}
