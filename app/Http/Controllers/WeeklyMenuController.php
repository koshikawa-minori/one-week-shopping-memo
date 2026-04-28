<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyMenu;
use App\Models\DailyMenu;
use Carbon\Carbon;

class WeeklyMenuController extends Controller
{
    public function index()
    {
        $weeklyMenu = WeeklyMenu::orderBy('created_at', 'desc')->first();

        if (!$weeklyMenu) {
            return view('weekly-menus.index', [
                'dailyMenus' => collect(),
            ]);
        }

        $dailyMenus = DailyMenu::where('weekly_menu_id', $weeklyMenu->id)
            ->orderBy('date')
            ->get();

        return view('weekly-menus.index', compact('dailyMenus'));
    }

    public function create()
    {
        return view('weekly-menus.create');
    }

    public function store(Request $request)
    {
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

    public function edit($id)
    {

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
}
