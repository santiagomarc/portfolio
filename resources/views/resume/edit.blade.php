{{-- filepath: resources/views/resume/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Resume')

@section('styles')
<style>
    /* ═══ Editor Input System ═══ */
    .editor-input {
        width: 100%;
        background: rgba(2, 6, 23, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 0.875rem;
        padding: 0.875rem 1.125rem;
        color: #f1f5f9;
        font-size: 0.875rem;
        font-family: inherit;
        letter-spacing: 0.01em;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .editor-input:hover {
        border-color: rgba(255, 255, 255, 0.15);
        background: rgba(2, 6, 23, 0.75);
    }
    .editor-input:focus {
        outline: none;
        border-color: rgba(56, 189, 248, 0.5);
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12), 0 0 20px rgba(14, 165, 233, 0.08);
        background: rgba(2, 6, 23, 0.85);
        color: #ffffff;
    }
    .editor-input::placeholder {
        color: #64748b;
        font-weight: 400;
    }
    textarea.editor-input {
        min-height: 130px;
        resize: vertical;
        line-height: 1.7;
    }
    input[type="date"].editor-input {
        color-scheme: dark;
    }
    input[type="checkbox"].editor-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #0ea5e9;
        cursor: pointer;
    }

    /* ═══ Section Styling ═══ */
    .edit-section {
        position: relative;
        padding: 2rem 0;
    }
    .edit-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 5%;
        right: 5%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.15), rgba(99, 102, 241, 0.15), transparent);
    }
    .edit-section:last-child::after {
        display: none;
    }

    /* ═══ Section Header ═══ */
    .section-icon-ring {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 0.875rem;
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(99, 102, 241, 0.12));
        border: 1px solid rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .section-icon-ring::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 1rem;
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), transparent 60%);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s;
    }
    .edit-section:hover .section-icon-ring::before {
        opacity: 1;
    }

    /* ═══ Sub-card items ═══ */
    .item-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.3));
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .item-card:hover {
        border-color: rgba(56, 189, 248, 0.2);
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.4));
        box-shadow: 0 4px 24px -4px rgba(14, 165, 233, 0.06);
    }

    /* ═══ Add-new dashed button ═══ */
    .btn-add-new {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        border: 1.5px dashed rgba(52, 211, 153, 0.3);
        border-radius: 0.875rem;
        background: transparent;
        color: #6ee7b7;
        font-size: 0.8125rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-add-new:hover {
        border-color: rgba(52, 211, 153, 0.5);
        background: rgba(52, 211, 153, 0.06);
        color: #a7f3d0;
        box-shadow: 0 0 16px rgba(52, 211, 153, 0.08);
    }

    /* ═══ Action Buttons ═══ */
    .btn-action-edit {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.85rem;
        background: rgba(14, 165, 233, 0.08);
        border: 1px solid rgba(14, 165, 233, 0.2);
        border-radius: 0.625rem;
        color: #7dd3fc;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-action-edit:hover {
        background: rgba(14, 165, 233, 0.15);
        border-color: rgba(56, 189, 248, 0.4);
        color: #bae6fd;
        box-shadow: 0 0 12px rgba(14, 165, 233, 0.1);
    }
    .btn-action-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.85rem;
        background: rgba(244, 63, 94, 0.06);
        border: 1px solid rgba(244, 63, 94, 0.15);
        border-radius: 0.625rem;
        color: #fda4af;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-action-delete:hover {
        background: rgba(244, 63, 94, 0.12);
        border-color: rgba(251, 113, 133, 0.4);
        color: #fecdd3;
        box-shadow: 0 0 12px rgba(244, 63, 94, 0.08);
    }
    .btn-inline-save {
        padding: 0.5rem 1rem;
        background: rgba(52, 211, 153, 0.1);
        border: 1px solid rgba(52, 211, 153, 0.25);
        border-radius: 0.625rem;
        color: #6ee7b7;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-inline-save:hover {
        background: rgba(52, 211, 153, 0.18);
        border-color: rgba(52, 211, 153, 0.45);
        box-shadow: 0 0 14px rgba(52, 211, 153, 0.1);
    }
    .btn-inline-cancel {
        padding: 0.5rem 1rem;
        background: rgba(100, 116, 139, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 0.625rem;
        color: #94a3b8;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-inline-cancel:hover {
        background: rgba(100, 116, 139, 0.18);
        border-color: rgba(255, 255, 255, 0.15);
        color: #cbd5e1;
    }

    /* ═══ Accent bar on items ═══ */
    .accent-bar-sky {
        border-left: 3px solid rgba(56, 189, 248, 0.4);
    }
    .accent-bar-emerald {
        border-left: 3px solid rgba(52, 211, 153, 0.5);
    }
    .accent-bar-muted {
        border-left: 3px solid rgba(100, 116, 139, 0.3);
    }

    /* ═══ Skill pill ═══ */
    .skill-pill {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.625rem 0.875rem;
        background: rgba(2, 6, 23, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 0.75rem;
        transition: all 0.3s;
    }
    .skill-pill:hover {
        border-color: rgba(56, 189, 248, 0.25);
        background: rgba(2, 6, 23, 0.7);
    }

    /* ═══ Featured badge ═══ */
    .badge-featured {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.65rem;
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.15), rgba(52, 211, 153, 0.08));
        border: 1px solid rgba(52, 211, 153, 0.2);
        border-radius: 999px;
        color: #6ee7b7;
    }

    /* ═══ Responsive grid ═══ */
    @media (max-width: 768px) {
        .editor-grid-2 { grid-template-columns: 1fr !important; }
        .editor-grid-3 { grid-template-columns: 1fr !important; }
    }

    /* ═══ Page hero decoration ═══ */
    .hero-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
        opacity: 0.4;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-x-hidden text-slate-200 font-sans selection:bg-sky-500/30">

    <!-- Floating Navigation Dock -->
    @include('resume.partials._nav')

    <!-- Main Content Area -->
    <main class="w-full h-full relative z-10 py-16 sm:py-24 px-4 sm:px-6 lg:px-24 pb-32">

        <!-- Page Header -->
        <div class="max-w-5xl mx-auto mb-14 text-center relative">
            {{-- Decorative glow orbs --}}
            <div class="hero-glow w-64 h-64 bg-sky-500/20 -top-20 -left-32" style="position:absolute;"></div>
            <div class="hero-glow w-48 h-48 bg-indigo-500/15 -top-10 -right-24" style="position:absolute;"></div>

            <div class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full glass-panel text-sky-300 text-[0.7rem] font-bold uppercase tracking-[0.2em] mb-8 border border-sky-500/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-400"></span>
                </span>
                <span>Editor Mode</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/50">Edit Your</span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-400 to-indigo-400"> Resume</span>
            </h1>
            <p class="text-slate-400 text-base sm:text-lg max-w-xl mx-auto leading-relaxed">Shape your professional identity with precision</p>
        </div>

        <!-- Main Form Container -->
        <div class="glass-panel rounded-3xl max-w-5xl mx-auto overflow-hidden">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="p-6 sm:p-10 lg:p-12">

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- PERSONAL INFORMATION                            --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-user"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Personal Information</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Your basic identity details</p>
                            </div>
                        </div>

                        <div class="space-y-6 mt-8">
                            <div>
                                <label for="full_name" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Full Name <span class="text-rose-400">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required placeholder="Enter your full name" class="editor-input">
                            </div>

                            <div>
                                <label for="title" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Professional Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $profile->title) }}" placeholder="e.g., Full Stack Developer, Software Engineer" class="editor-input">
                                <p class="text-xs text-slate-500 mt-2.5 pl-1">Your job title or professional role</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 editor-grid-2" style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                <div>
                                    <label for="phone" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" placeholder="+63 912 345 6789" class="editor-input">
                                </div>
                                <div>
                                    <label for="location" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Location</label>
                                    <input type="text" id="location" name="location" value="{{ old('location', $profile->location) }}" placeholder="City, Country" class="editor-input">
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- ONLINE PRESENCE                                 --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-globe"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Online Presence</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Links to your online profiles</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <label for="github" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">GitHub Profile</label>
                            <input type="url" id="github" name="github" value="{{ old('github', $profile->github) }}" placeholder="https://github.com/yourusername" class="editor-input">
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- ABOUT ME / BIO                                  --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-file-lines"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Professional Summary</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Tell the world about yourself</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <label for="bio" class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Bio / Summary</label>
                            <textarea id="bio" name="bio" placeholder="Write a brief summary about yourself, your skills, and what you're passionate about..." class="editor-input">{{ old('bio', $profile->bio) }}</textarea>
                            <p class="text-xs text-slate-500 mt-2.5 pl-1">A short paragraph describing your professional background and goals (max 1000 characters)</p>
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- TECHNICAL SKILLS                                --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-bolt"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Technical Skills</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Manage your skills across four categories</p>
                            </div>
                        </div>

                        @php
                            $categories = [
                                'Frontend Development',
                                'Backend Development',
                                'Tools & Technologies',
                                'Programming Languages'
                            ];
                            $groupedSkills = $skills->groupBy('category');
                        @endphp

                        <div class="space-y-5 mt-8">
                        @foreach($categories as $category)
                            <div class="skill-category-section item-card">
                                <h3 class="text-base font-semibold text-white/90 mb-4 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>
                                    {{ $category }}
                                </h3>

                                <div class="skills-list space-y-2" id="skills-{{ Str::slug($category) }}">
                                    @if(isset($groupedSkills[$category]))
                                        @foreach($groupedSkills[$category] as $skill)
                                            <div class="skill-pill" data-skill-id="{{ $skill->id }}">
                                                <div class="skill-display flex items-center gap-3">
                                                    <span class="skill-name font-medium text-slate-100 text-sm">{{ $skill->name }}</span>
                                                    <span class="text-[0.65rem] text-sky-300/70 bg-sky-500/10 px-2 py-0.5 rounded-full font-medium border border-sky-500/10">{{ $skill->proficiency_level }}%</span>
                                                </div>
                                                <div class="skill-actions flex items-center gap-1.5">
                                                    <button type="button" class="btn-edit-skill text-sky-300/60 hover:text-sky-300 hover:bg-sky-500/10 p-1.5 rounded-lg transition-all text-sm" onclick="editSkill({{ $skill->id }})"><i class="fas fa-pen-to-square"></i></button>
                                                    <button type="button" class="btn-delete-skill text-rose-400/50 hover:text-rose-300 hover:bg-rose-500/10 p-1.5 rounded-lg transition-all text-sm" onclick="deleteSkill({{ $skill->id }}, '{{ $skill->name }}')"><i class="fas fa-trash"></i></button>
                                                </div>
                                                <div class="skill-edit-form flex items-center gap-3 w-full" style="display: none;">
                                                    <input type="text" class="edit-skill-name editor-input" value="{{ $skill->name }}" style="max-width: 200px;">
                                                    <input type="number" class="edit-skill-level editor-input" value="{{ $skill->proficiency_level }}" min="0" max="100" style="max-width: 90px;">
                                                    <button type="button" onclick="saveSkill({{ $skill->id }})" class="btn-inline-save whitespace-nowrap">Save</button>
                                                    <button type="button" onclick="cancelEdit({{ $skill->id }})" class="btn-inline-cancel whitespace-nowrap">Cancel</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Add New Skill Form -->
                                <div class="add-skill-section mt-4">
                                    <button type="button" class="btn-add-new" onclick="showAddForm('{{ $category }}')">
                                        <i class="fas fa-plus text-xs"></i> Add {{ $category }} Skill
                                    </button>

                                    <div class="add-skill-form mt-4 p-4 bg-slate-950/40 rounded-xl border border-white/[0.06] flex flex-wrap items-center gap-3" id="add-form-{{ Str::slug($category) }}" style="display: none;">
                                        <input type="text" class="new-skill-name editor-input" placeholder="Skill name" style="max-width: 200px;">
                                        <input type="number" class="new-skill-level editor-input" placeholder="Level (0-100)" min="0" max="100" value="75" style="max-width: 110px;">
                                        <button type="button" onclick="addSkill('{{ $category }}')" class="btn-inline-save">Add</button>
                                        <button type="button" onclick="cancelAdd('{{ $category }}')" class="btn-inline-cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- WORK EXPERIENCE                                 --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-briefcase"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Work Experience</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Manage your work history</p>
                            </div>
                        </div>

                        <div class="space-y-4 mt-8">
                        @foreach($experiences as $exp)
                            <div class="experience-item item-card accent-bar-sky" data-exp-id="{{ $exp->id }}">
                                <!-- Display Mode -->
                                <div class="exp-display">
                                    <h3 class="text-base font-semibold text-white/95 mb-1">{{ $exp->job_title }}</h3>
                                    <p class="text-sm text-slate-400 mb-3 font-medium">{{ $exp->company_details }}</p>
                                    <p class="text-slate-300/80 text-sm whitespace-pre-line leading-relaxed">{{ $exp->description }}</p>
                                    <div class="flex items-center gap-2 mt-5">
                                        <button type="button" onclick="editExperience({{ $exp->id }})" class="btn-action-edit">
                                            <i class="fas fa-pen-to-square text-xs"></i> Edit
                                        </button>
                                        <button type="button" onclick="deleteExperience({{ $exp->id }}, '{{ $exp->job_title }}')" class="btn-action-delete">
                                            <i class="fas fa-trash text-xs"></i> Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Edit Mode (hidden) -->
                                <div class="exp-edit-form space-y-5" style="display: none;">
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Job Title</label>
                                        <input type="text" class="edit-exp-title editor-input" value="{{ $exp->job_title }}">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Company & Details</label>
                                        <input type="text" class="edit-exp-company editor-input" value="{{ $exp->company_details }}" placeholder="e.g., TechCorp Solutions | Remote | Jan 2023 - Present">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Description</label>
                                        <textarea class="edit-exp-description editor-input" rows="4">{{ $exp->description }}</textarea>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="saveExperience({{ $exp->id }})" class="btn-inline-save">Save</button>
                                        <button type="button" onclick="cancelEditExperience({{ $exp->id }})" class="btn-inline-cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <!-- Add New Experience -->
                        <div class="mt-6">
                            <button type="button" onclick="showAddExperienceForm()" class="btn-add-new">
                                <i class="fas fa-plus text-xs"></i> Add Work Experience
                            </button>

                            <div id="add-experience-form" class="mt-4 p-5 sm:p-6 item-card space-y-5" style="display: none;">
                                <h3 class="text-base font-semibold text-white/90">Add New Experience</h3>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Job Title</label>
                                    <input type="text" id="new-exp-title" placeholder="e.g., Full Stack Developer" class="editor-input">
                                </div>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Company & Details</label>
                                    <input type="text" id="new-exp-company" placeholder="e.g., TechCorp Solutions | Remote | Jan 2023 - Present" class="editor-input">
                                </div>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Description</label>
                                    <textarea id="new-exp-description" rows="4" placeholder="Describe your responsibilities and achievements..." class="editor-input"></textarea>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="addExperience()" class="btn-inline-save">Add</button>
                                    <button type="button" onclick="cancelAddExperience()" class="btn-inline-cancel">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- EDUCATION                                       --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section pb-10 mb-10">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-graduation-cap"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Education</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Edit your education history</p>
                            </div>
                        </div>

                        <div class="space-y-4 mt-8">
                        @foreach($education as $edu)
                            <div class="item-card accent-bar-sky" data-edu-id="{{ $edu->id }}">
                                <!-- Display Mode -->
                                <div class="edu-display">
                                    <h3 class="text-base font-semibold text-white/95 mb-1">{{ $edu->degree }}</h3>
                                    <p class="text-sm text-slate-400 mb-3 font-medium">{{ $edu->school_details }}</p>
                                    <p class="text-slate-300/80 text-sm whitespace-pre-line leading-relaxed">{{ $edu->description }}</p>
                                    <div class="mt-5">
                                        <button type="button" onclick="editEducation({{ $edu->id }})" class="btn-action-edit">
                                            <i class="fas fa-pen-to-square text-xs"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <!-- Edit Mode (hidden) -->
                                <div class="edu-edit-form space-y-5" style="display: none;">
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Degree / Level</label>
                                        <input type="text" class="edit-edu-degree editor-input" value="{{ $edu->degree }}" placeholder="e.g., Bachelor of Science in Computer Science">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">School & Details</label>
                                        <input type="text" class="edit-edu-details editor-input" value="{{ $edu->school_details }}" placeholder="e.g., Batangas State University | Batangas | 2023 - Present">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Description</label>
                                        <textarea class="edit-edu-description editor-input" rows="3" placeholder="e.g., Relevant Coursework: ...">{{ $edu->description }}</textarea>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="saveEducation({{ $edu->id }})" class="btn-inline-save">Save</button>
                                        <button type="button" onclick="cancelEditEducation({{ $edu->id }})" class="btn-inline-cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </section>

                    {{-- ──────────────────────────────────────────────── --}}
                    {{-- PROJECTS                                        --}}
                    {{-- ──────────────────────────────────────────────── --}}
                    <section class="edit-section last:pb-0">
                        <div class="flex items-center gap-3.5 mb-2">
                            <span class="section-icon-ring"><i class="fas fa-rocket"></i></span>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Projects</h2>
                                <p class="text-slate-400 text-sm mt-0.5">Manage your portfolio projects</p>
                            </div>
                        </div>

                        <div class="space-y-4 mt-8">
                        @foreach($projects as $project)
                            <div class="project-item item-card {{ $project->is_featured ? 'accent-bar-emerald' : 'accent-bar-muted' }}" data-project-id="{{ $project->id }}">
                                <!-- Display Mode -->
                                <div class="project-display">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h3 class="text-base font-semibold text-white/95">{{ $project->title }}</h3>
                                            @if($project->is_featured)
                                                <span class="badge-featured mt-1.5">
                                                    <i class="fas fa-star text-[9px]"></i> Featured
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-sky-300/60 text-sm mb-2 font-mono tracking-wide">{{ $project->technologies }}</p>
                                    <p class="text-slate-300/80 text-sm leading-relaxed">{{ Str::limit($project->description, 150) }}</p>
                                    @if($project->repository_link)
                                        <p class="mt-2.5 text-xs text-slate-400"><span class="text-slate-500 font-semibold mr-1">Repo:</span> <a href="{{ $project->repository_link }}" target="_blank" class="text-sky-400/70 hover:text-sky-300 underline underline-offset-2 transition-colors">{{ $project->repository_link }}</a></p>
                                    @endif
                                    @if($project->live_link)
                                        <p class="mt-1 text-xs text-slate-400"><span class="text-slate-500 font-semibold mr-1">Live:</span> <a href="{{ $project->live_link }}" target="_blank" class="text-sky-400/70 hover:text-sky-300 underline underline-offset-2 transition-colors">{{ $project->live_link }}</a></p>
                                    @endif
                                    <div class="flex items-center gap-2 mt-5">
                                        <button type="button" onclick="editProject({{ $project->id }})" class="btn-action-edit">
                                            <i class="fas fa-pen-to-square text-xs"></i> Edit
                                        </button>
                                        <button type="button" onclick="deleteProject({{ $project->id }}, '{{ addslashes($project->title) }}')" class="btn-action-delete">
                                            <i class="fas fa-trash text-xs"></i> Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Edit Mode (hidden) -->
                                <div class="project-edit-form space-y-5" style="display: none;">
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Title</label>
                                        <input type="text" class="edit-project-title editor-input" value="{{ $project->title }}">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Description</label>
                                        <textarea class="edit-project-description editor-input" rows="3">{{ $project->description }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Technologies (comma-separated)</label>
                                        <input type="text" class="edit-project-technologies editor-input" value="{{ $project->technologies }}" placeholder="e.g., Laravel, PHP, PostgreSQL">
                                    </div>
                                    <div class="editor-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Repository Link</label>
                                            <input type="url" class="edit-project-repo editor-input" value="{{ $project->repository_link }}" placeholder="https://github.com/...">
                                        </div>
                                        <div>
                                            <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Live Demo Link</label>
                                            <input type="url" class="edit-project-live editor-input" value="{{ $project->live_link }}" placeholder="https://...">
                                        </div>
                                    </div>
                                    <div class="editor-grid-3" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Start Date</label>
                                            <input type="date" class="edit-project-start editor-input" value="{{ $project->start_date?->format('Y-m-d') }}">
                                        </div>
                                        <div>
                                            <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">End Date</label>
                                            <input type="date" class="edit-project-end editor-input" value="{{ $project->end_date?->format('Y-m-d') }}">
                                        </div>
                                        <div class="flex items-end">
                                            <label class="flex items-center gap-3 cursor-pointer bg-slate-950/40 p-3 rounded-xl border border-white/[0.06] w-full hover:border-white/10 transition-colors">
                                                <input type="checkbox" class="edit-project-featured editor-checkbox" {{ $project->is_featured ? 'checked' : '' }}>
                                                <span class="text-sm font-medium text-slate-200">Featured</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="saveProject({{ $project->id }})" class="btn-inline-save">Save</button>
                                        <button type="button" onclick="cancelEditProject({{ $project->id }})" class="btn-inline-cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <!-- Add New Project -->
                        <div class="mt-6">
                            <button type="button" onclick="showAddProjectForm()" class="btn-add-new">
                                <i class="fas fa-plus text-xs"></i> Add Project
                            </button>

                            <div id="add-project-form" class="mt-4 p-5 sm:p-6 item-card space-y-5" style="display: none;">
                                <h3 class="text-base font-semibold text-white/90">Add New Project</h3>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Title <span class="text-rose-400">*</span></label>
                                    <input type="text" id="new-project-title" placeholder="e.g., Portfolio CMS" class="editor-input">
                                </div>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Description</label>
                                    <textarea id="new-project-description" rows="3" placeholder="Describe the project..." class="editor-input"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Technologies (comma-separated)</label>
                                    <input type="text" id="new-project-technologies" placeholder="e.g., Laravel, PHP, PostgreSQL" class="editor-input">
                                </div>
                                <div class="editor-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Repository Link</label>
                                        <input type="url" id="new-project-repo" placeholder="https://github.com/..." class="editor-input">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Live Demo Link</label>
                                        <input type="url" id="new-project-live" placeholder="https://..." class="editor-input">
                                    </div>
                                </div>
                                <div class="editor-grid-3" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">Start Date</label>
                                        <input type="date" id="new-project-start" class="editor-input">
                                    </div>
                                    <div>
                                        <label class="block text-sky-300 text-[0.7rem] font-semibold uppercase tracking-[0.15em] mb-2.5">End Date</label>
                                        <input type="date" id="new-project-end" class="editor-input">
                                    </div>
                                    <div class="flex items-end">
                                        <label class="flex items-center gap-3 cursor-pointer bg-slate-950/40 p-3 rounded-xl border border-white/[0.06] w-full hover:border-white/10 transition-colors">
                                            <input type="checkbox" id="new-project-featured" class="editor-checkbox">
                                            <span class="text-sm font-medium text-slate-200">Featured</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="addProject()" class="btn-inline-save">Add</button>
                                    <button type="button" onclick="cancelAddProject()" class="btn-inline-cancel">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                {{-- ──────────────────────────────────────────────── --}}
                {{-- FORM ACTIONS (sticky footer inside glass panel) --}}
                {{-- ──────────────────────────────────────────────── --}}
                <div class="border-t border-white/[0.06] bg-slate-950/60 backdrop-blur-2xl px-6 sm:px-10 lg:px-12 py-6 flex flex-col sm:flex-row items-center gap-4 rounded-b-3xl">
                    <button type="submit" class="group w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-400 hover:to-indigo-500 text-white font-bold py-3.5 px-10 rounded-xl shadow-lg shadow-sky-500/25 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-sky-500/35 hover:shadow-xl">
                        <i class="fas fa-floppy-disk transition-transform group-hover:scale-110"></i> Save Changes
                    </button>
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white/[0.03] hover:bg-white/[0.06] text-slate-300 font-semibold py-3.5 px-10 rounded-xl border border-white/[0.08] hover:border-white/15 transition-all duration-300">
                        <i class="fas fa-xmark"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/editor.js') }}"></script>
@endsection
