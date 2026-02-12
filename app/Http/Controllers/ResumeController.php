<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ContactMessage;
use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;

class ResumeController extends Controller
{
    /**
     * Display the main resume page (now fully database-driven)
     */
    public function index()
    {
        $user = User::first();

        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);

        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->where('is_featured', true)->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();

        return view('resume.public', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('resume.contact', [
            'username' => Session::get('username')
        ]);
    }

    /**
     * Handle contact form submission via SMTP Mail
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000|min:10',
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 2 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
        ]);

        try {
            Mail::to(config('mail.from.address'))->send(new ContactMessage(
                $request->name,
                $request->email,
                $request->message
            ));
        } catch (\Exception $e) {
            // Fallback: log to file if SMTP fails
            $logEntry = json_encode([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'timestamp' => now(),
                'mail_error' => $e->getMessage(),
            ]) . "\n";
            file_put_contents(storage_path('app/contact_messages.log'), $logEntry, FILE_APPEND | LOCK_EX);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, ' . $request->name . '! Your message has been sent successfully.'
        ]);
    }

    /**
     * Generate and download resume as PDF
     * Route: GET /resume/download/pdf
     */
    public function downloadPdf()
    {
        $user = User::first();

        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);

        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();

        $pdf = Pdf::loadView('resume.pdf', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
        $pdf->setPaper('A4', 'portrait');

        $filename = str_replace(' ', '_', $profile->full_name) . '_Resume.pdf';

        return $pdf->download($filename);
    }

    public function dashboard()
    {
        $user = User::first(); 
        
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.dashboard', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    /**
     * Show edit form for resume
     * Route: /profile/edit (protected)
     */
    public function edit()
    {
        $user = User::first();
        
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.edit', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    /**
     * Update resume data in database
     * Route: POST /profile/update (protected)
     */
    public function update(Request $request)
    {
        $user = User::first();
        
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('dashboard')
            ->with('success', 'Resume updated successfully!');
    }

    /**
     * Display public resume view (no login required)
     * Route: GET /resume/{id}
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.public', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    // ===== SKILL CRUD METHODS =====

    /**
     * Store a new skill
     * Route: POST /skills
     */
    public function storeSkill(Request $request)
    {
        $user = User::first(); 
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'category' => $validated['category'],
            'proficiency_level' => $validated['proficiency_level'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully',
            'skill' => $skill
        ]);
    }

    /**
     * Update an existing skill
     * Route: PUT /skills/{id}
     */
    public function updateSkill($id, Request $request)
    {
        $skill = Skill::findOrFail($id);
        
        $user = User::first();
        if ($skill->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully',
            'skill' => $skill
        ]);
    }

    /**
     * Delete a skill
     * Route: DELETE /skills/{id}
     */
    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        
        $user = User::first();
        if ($skill->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully'
        ]);
    }

    
    // ===== EXPERIENCE CRUD METHODS =====

    /**
     * Store a new work experience
     * Route: POST /experiences
     */
    public function storeExperience(Request $request)
    {
        $user = User::first(); 
        
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience = Experience::create([
            'user_id' => $user->id,
            'job_title' => $validated['job_title'],
            'company_details' => $validated['company_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experience added successfully',
            'experience' => $experience
        ]);
    }

    /**
     * Update an existing work experience
     * Route: PUT /experiences/{id}
     */
    public function updateExperience($id, Request $request)
    {
        $experience = Experience::findOrFail($id);
        
        $user = User::first();
        if ($experience->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience->update([
            'job_title' => $validated['job_title'],
            'company_details' => $validated['company_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully',
            'experience' => $experience
        ]);
    }

        /**
     * Delete a work experience
     * Route: DELETE /experiences/{id}
     */
    public function deleteExperience($id)
    {
        $experience = Experience::findOrFail($id);
        
        $user = User::first();
        if ($experience->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully'
        ]);
    }

    // ===== EDUCATION CRUD METHODS =====

    /**
     * Update education entry
     * Route: PUT /education/{id}
     */
    public function updateEducation(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        
        $user = User::first();
        if ($education->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'school_details' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        $education->update([
            'degree' => $validated['degree'],
            'school_details' => $validated['school_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully',
            'education' => $education
        ]);
    }

    // ===== PROJECT CRUD METHODS =====

    /**
     * Store a new project
     * Route: POST /projects
     */
    public function storeProject(Request $request)
    {
        $user = User::first();

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

        $project = Project::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'technologies' => $validated['technologies'] ?? '',
            'live_link' => $validated['live_link'] ?? null,
            'repository_link' => $validated['repository_link'] ?? null,
            'thumbnail_path' => $validated['thumbnail_path'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Project added successfully',
            'project' => $project
        ]);
    }

    /**
     * Update an existing project
     * Route: PUT /projects/{id}
     */
    public function updateProject($id, Request $request)
    {
        $project = Project::findOrFail($id);

        $user = User::first();
        if ($project->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

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

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'technologies' => $validated['technologies'] ?? '',
            'live_link' => $validated['live_link'] ?? null,
            'repository_link' => $validated['repository_link'] ?? null,
            'thumbnail_path' => $validated['thumbnail_path'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    /**
     * Delete a project
     * Route: DELETE /projects/{id}
     */
    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);

        $user = User::first();
        if ($project->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully'
        ]);
    }
}