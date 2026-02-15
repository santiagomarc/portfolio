<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Store a new project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'technologies' => 'nullable|string|max:500',
            'live_link' => 'nullable|url|max:255',
            'repository_link' => 'nullable|url|max:255',
            'thumbnail_path' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $project = Auth::user()->projects()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project added successfully',
            'project' => $project,
        ]);
    }

    /**
     * Update an existing project.
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'technologies' => 'nullable|string|max:500',
            'live_link' => 'nullable|url|max:255',
            'repository_link' => 'nullable|url|max:255',
            'thumbnail_path' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'project' => $project,
        ]);
    }

    /**
     * Delete a project.
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully',
        ]);
    }
}
