<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use Illuminate\Http\JsonResponse;

class ReferenceController extends Controller
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
        $references = $user ? $user->references()->get() : Reference::all();
        return response()->json($references);

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
            'contact_info' => 'required|string|max:255',
            'relationship' => 'nullable|string|max:255',
        ]);
        $user = $request->user();
        $reference = $user->references()->create($data);
        return response()->json($reference, 201);
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
        $reference = Reference::findOrFail($id);
        if (auth()->check() && $reference->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($reference);
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
        $reference = Reference::findOrFail($id);
        if (auth()->check() && $reference->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'relationship' => 'nullable|string|max:255',
        ]);
        $reference->update($data);
        return response()->json($reference);
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
        $reference = Reference::findOrFail($id);
        if (auth()->check() && $reference->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $reference->delete();
        return response()->json(['message' => 'Reference deleted']);
    }
}
