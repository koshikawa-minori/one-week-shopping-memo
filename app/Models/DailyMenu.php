<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekly_menu_id',
        'date',
        'meal_time',
        'menu',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function weeklyMenu(): BelongsTo
    {
        return $this->belongsTo(WeeklyMenu::class);
    }
}
