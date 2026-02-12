<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;

// Login routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected resume routes (requires login)
Route::middleware('auth.custom')->group(function () {
    // OLD routes (keep for now)
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::get('/contact', [ResumeController::class, 'contact'])->name('contact');
    Route::post('/contact', [ResumeController::class, 'sendMessage'])->name('contact.send');
    
    Route::get('/dashboard', [ResumeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ResumeController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ResumeController::class, 'update'])->name('profile.update');
    
    // Skill CRUD routes
    Route::post('/skills', [ResumeController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{id}', [ResumeController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{id}', [ResumeController::class, 'deleteSkill'])->name('skills.delete');
    
    // Experience CRUD routes
    Route::post('/experiences', [ResumeController::class, 'storeExperience'])->name('experiences.store');
    Route::put('/experiences/{id}', [ResumeController::class, 'updateExperience'])->name('experiences.update');
    Route::delete('/experiences/{id}', [ResumeController::class, 'deleteExperience'])->name('experiences.delete');
    
    // Education CRUD routes (only update - no add/delete)
    Route::put('/education/{id}', [ResumeController::class, 'updateEducation'])->name('education.update');
    
    // PDF download
    Route::get('/resume/download/pdf', [ResumeController::class, 'downloadPdf'])->name('resume.pdf');
    
    // Project CRUD routes
    Route::post('/projects', [ResumeController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{id}', [ResumeController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [ResumeController::class, 'deleteProject'])->name('projects.delete');
});

Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.public');
