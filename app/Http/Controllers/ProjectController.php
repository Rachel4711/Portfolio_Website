<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
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
        $projects = $user ? $user->projects()->get() : Project::all();
        return response()->json($projects);
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
        ]);
        $user = $request->user();
        $project = $user->projects()->create($data);
        return response()->json($project, 201);
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
        $project = Project::findOrFail($id);
        if (auth()->check() && $project->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($project);
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
        $project = Project::findOrFail($id);
        if (auth()->check() && $project->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
        ]);
        $project->update($data);
        return response()->json($project);
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
        $project = Project::findOrFail($id);
        if (auth()->check() && $project->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
