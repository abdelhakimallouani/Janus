<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Habit::where('user_id', Auth::id())->get();

        return response()->json(['success' => true, 'data' => $habits]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'required|string',
            'target_days' => 'required|integer',
            'color' => 'nullable|string|max:7',
        ]);

        $habit = Habit::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'frequency' => $request->frequency,
            'target_days' => $request->target_days,
            'color' => $request->color,
        ]);

        return response()->json(['success' => true, 'data' => $habit, 'message' => 'Habit created '], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $habit = Habit::where('user_id', Auth::id())->find($id);
        if (!$habit) {
            return response()->json(['success' => false, 'message' => 'Habit not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $habit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $habit = Habit::where('user_id', Auth::id())->find($id);
        if (!$habit) {
            return response()->json(['success' => false, 'message' => 'Habit not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'sometimes|required|string',
            'target_days' => 'sometimes|required|integer',
            'color' => 'nullable|string|max:7',
            'is_active' => 'sometimes|required|boolean',
        ]);
        $habit->update($request->all());

        return response()->json(['success' => true, 'data' => $habit]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $habit = Habit::where('user_id', Auth::id())->find($id);
        if (!$habit) {
            return response()->json(['success' => false, 'message' => 'Habit not found'], 404);
        }
        $habit->delete();

        return response()->json(['success' => true, 'message' => 'Habit deleted']);
    }
}
