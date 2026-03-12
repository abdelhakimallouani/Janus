<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function habitStats($id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);

        $totalLogs = $habit->logs()->count();

        return response()->json([
            "habit" => $habit->title,
            "total completions" => $totalLogs,
        ]);
    }

    public function overview() {
        $habits = Habit::where('user_id', Auth::id())->withCount('logs')->get();

        $totalHabits = $habits->count();
        $totalLogs = $habits->sum('logs_count');

        return response()->json([
            "total_habits"=>$totalHabits,
            "total comlemtions"=>$totalLogs,
            "habits"=>$habits
        ]);

    }
}
