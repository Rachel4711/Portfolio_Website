<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $skills = Skill::all();
        return response()->json($skills);
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
            'name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255',
        ]);
        $skill = Skill::create($data);
        return response()->json($skill, 201);
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
        $skill = Skill::findOrFail($id);
        return response()->json($skill);
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
        $skill = Skill::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255',
        ]);
        $skill->update($data);
        return response()->json($skill);
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
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return response()->json(['message' => 'Skill deleted']);
    }
}
