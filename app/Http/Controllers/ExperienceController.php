<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Experience;

class ExperienceController extends Controller
{
    /**
     * Store a new experience.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience = Auth::user()->experiences()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience added successfully',
            'experience' => $experience,
        ]);
    }

    /**
     * Update an existing experience.
     */
    public function update(Request $request, $id)
    {
        $experience = Experience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully',
            'experience' => $experience,
        ]);
    }

    /**
     * Delete an experience.
     */
    public function destroy($id)
    {
        $experience = Experience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully',
        ]);
    }
}
