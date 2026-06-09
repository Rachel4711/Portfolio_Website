<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $educations = $user ? $user->educations()->get() : Education::all();

        return response()->json($educations);
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
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $user = $request->user();
        $education = $user->educations()->create($data);

        return response()->json($education, 201);
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
        $education = Education::findOrFail($id);
        if (auth()->check() && $education->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($education);
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
        $education = Education::findOrFail($id);
        if (auth()->check() && $education->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $education->update($data);
        return response()->json($education);
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
        $education = Education::findOrFail($id);
        if (auth()->check() && $education->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $education->delete();
        return response()->json(['message' => 'Education entry deleted']);
    }
}
