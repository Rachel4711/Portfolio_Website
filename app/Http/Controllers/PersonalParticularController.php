<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalParticular;
use Illuminate\Http\JsonResponse;

class PersonalParticularController extends Controller
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
        $personalParticulars = $user ? $user->personalParticulars()->get() : PersonalParticular::all();
        return response()->json($personalParticulars);
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        $user = $request->user();
        $personalParticular = $user->personalParticulars()->create($data);
        return response()->json($personalParticular, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personalParticular = PersonalParticular::findOrFail($id);
        if (auth()->check() && $personalParticular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($personalParticular);
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
        $personalParticular = PersonalParticular::findOrFail($id);
        if (auth()->check() && $personalParticular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        $personalParticular->update($data);
        return response()->json($personalParticular);
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
        $personalParticular = PersonalParticular::findOrFail($id);
        if (auth()->check() && $personalParticular->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $personalParticular->delete();
        return response()->json(['message' => 'Personal particular entry deleted']);
    }
}
