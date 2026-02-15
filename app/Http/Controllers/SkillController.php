<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Store a new skill.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill = Auth::user()->skills()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully',
            'skill' => $skill,
        ]);
    }

    /**
     * Update an existing skill.
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully',
            'skill' => $skill,
        ]);
    }

    /**
     * Delete a skill.
     */
    public function destroy($id)
    {
        $skill = Skill::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully',
        ]);
    }
}
