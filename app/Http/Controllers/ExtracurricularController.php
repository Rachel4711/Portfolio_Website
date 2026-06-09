<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Http\JsonResponse;

class ExtracurricularController extends Controller
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
        $extracurriculars = $user ? $user->extracurriculars()->get() : Extracurricular::all();
        return response()->json($extracurriculars);
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
            'activity' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $user = $request->user();
        $extracurricular = $user->extracurriculars()->create($data);
        return response()->json($extracurricular, 201);
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
        $extracurricular = Extracurricular::findOrFail($id);
        if (auth()->check() && $extracurricular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($extracurricular);
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
        $extracurricular = Extracurricular::findOrFail($id);
        if (auth()->check() && $extracurricular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'activity' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $extracurricular->update($data);
        return response()->json($extracurricular);
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
        $extracurricular = Extracurricular::findOrFail($id);
        if (auth()->check() && $extracurricular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $extracurricular->delete();
        return response()->json(['message' => 'Extracurricular entry deleted']);
    }
}
