<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objective;
use Illuminate\Http\JsonResponse;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        $objectives = $user ? $user->objectives()->get() : Objective::all();
        return response()->json($objectives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  
        $data = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $user = $request->user();
        $objective = $user->objectives()->create($data);
        return response()->json($objective, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $objective = Objective::findOrFail($id);
        if (auth()->check() && $objective->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($objective);
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
        //
        $objective = Objective::findOrFail($id);
        if (auth()->check() && $objective->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $objective->update($data);
        return response()->json($objective);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $objective = Objective::findOrFail($id);
        if (auth()->check() && $objective->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $objective->delete();
        return response()->json(['message' => 'Objective deleted']);    
    }
}
