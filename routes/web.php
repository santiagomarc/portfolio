<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;

// ─── Public Routes (No Login Required) ───────────────────────────
Route::get('/', [ResumeController::class, 'index'])->name('home');
Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.public');
Route::get('/resume/download/pdf', [ResumeController::class, 'downloadPdf'])->name('resume.pdf');
Route::post('/contact', [ResumeController::class, 'sendMessage'])->name('contact.send');

// ─── Auth Routes ─────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Protected Admin Routes (Login Required) ────────────────────
Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [ResumeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ResumeController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ResumeController::class, 'update'])->name('profile.update');

    // Skill CRUD
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.delete');

    // Experience CRUD
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::put('/experiences/{id}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/experiences/{id}', [ExperienceController::class, 'destroy'])->name('experiences.delete');

    // Education CRUD
    Route::put('/education/{id}', [ResumeController::class, 'updateEducation'])->name('education.update');

    // Project CRUD
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
});
