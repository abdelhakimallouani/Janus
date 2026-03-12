<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitLogController extends Controller
{
    public function store(Request $request, $id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $log = HabitLog::create([
            'habit_id' => $habit->id,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return response()->json([
            "message" => 'Hbait copmleted',
            "date" => $log,
        ], 201);

    }

    public function index($id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);

        $logs = $habit->logs()->orderBy('date', 'desc')->get();

        return response()->json($logs);
    }

    public function destroy($id,$logId) {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        $log = HabitLog::where('habit_id',$habit->id)->findOrFail($logId);

        $log->delete();

        return response()->json([
            "message"=>"Log deleted"
        ]);
    }
}
