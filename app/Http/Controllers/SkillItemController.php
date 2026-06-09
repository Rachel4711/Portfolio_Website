<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill_Item;
use Illuminate\Http\JsonResponse;

class SkillItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $skillItems = Skill_Item::all();
        return response()->json($skillItems);
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
            'skill_id' => 'required|integer|exists:skills,id',
            'name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255',
        ]);
        $skillItem = Skill_Item::create($data);
        return response()->json($skillItem, 201);
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
        $skillItem = Skill_Item::findOrFail($id);
        return response()->json($skillItem);
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
        $skillItem = Skill_Item::findOrFail($id);
        $data = $request->validate([
            'skill_id' => 'required|integer|exists:skills,id',
            'name' => 'required|string|max:255',
            'proficiency' => 'nullable|string|max:255',
        ]);
        $skillItem->update($data);
        return response()->json($skillItem);
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
        $skillItem = Skill_Item::findOrFail($id);
        $skillItem->delete();
        return response()->json(['message' => 'Skill item deleted']);
    }
}
