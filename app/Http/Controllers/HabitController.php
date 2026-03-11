<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;


class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
