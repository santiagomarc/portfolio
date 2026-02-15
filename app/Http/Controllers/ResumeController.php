<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ContactMessage;
use App\Models\User;
use App\Models\Profile;
use App\Models\Education;

class ResumeController extends Controller
{
    /**
     * Public portfolio landing page (no login required).
     * Shows the first user's resume — this is YOUR portfolio.
     */
    public function index()
    {
        $user = User::first();

        if (!$user) {
            abort(404, 'No portfolio has been set up yet.');
        }

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
     * Public view of a specific user's resume.
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

    /**
     * Handle contact form submission via SMTP Mail.
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
     * Generate and download resume as PDF (public).
     */
    public function downloadPdf()
    {
        $user = User::first();

        if (!$user) {
            abort(404);
        }

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

    // ─── Protected Admin Methods (require login) ─────────────────

    /**
     * Admin dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

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
     * Show edit form for resume.
     */
    public function edit()
    {
        $user = Auth::user();

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
     * Update profile data.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

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
     * Update education entry.
     */
    public function updateEducation(Request $request, $id)
    {
        $user = Auth::user();
        $education = Education::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'school_details' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully',
            'education' => $education
        ]);
    }
}