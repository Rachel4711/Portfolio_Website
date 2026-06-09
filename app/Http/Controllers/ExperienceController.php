<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
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
        $experiences = $user ? $user->experiences()->get() : Experience::all();
        return response()->json($experiences);
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
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $user = $request->user();
        $experience = $user->experiences()->create($data);

        return response()->json($experience, 201);
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
        $experience = Experience::findOrFail($id);
        if (auth()->check() && $experience->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($experience);
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
        $experience = Experience::findOrFail($id);
        if (auth()->check() && $experience->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $experience->update($data);
        return response()->json($experience);
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
        $experience = Experience::findOrFail($id);
        if (auth()->check() && $experience->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);   
        }     
        $experience->delete();
        return response()->json(['message' => 'Experience entry deleted']);
    }
}
