<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Http\JsonResponse;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $achievements = $user ? $user->achievements()->get() : Achievement::all();

        return response()->json($achievements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'month' => 'required|string|in:Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'description' => 'nullable|array', // if you want JSON array
        ]);

        $user = $request->user();
        $achievement = $user->achievements()->create($data);

        return response()->json($achievement, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achievement = Achievement::findOrFail($id);

        if (auth()->check() && $achievement->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($achievement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        if (! auth()->check() || $achievement->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'month' => 'nullable|string|max:50',
            'year' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $achievement->update($data);

        return response()->json($achievement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);

        if (! auth()->check() || $achievement->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $achievement->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
