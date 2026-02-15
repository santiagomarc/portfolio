{{-- filepath: resources/views/resume/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Resume')

@section('styles')
{{-- <link rel="stylesheet" href="{{ asset('css/resume-style.css') }}"> --}}
<style>
    .edit-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .edit-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #3498db;
    }
    .edit-header h1 {
        color: #2c3e50;
        margin: 0;
    }
    .form-section {
        margin-bottom: 40px;
    }
    .form-section h2 {
        color: #3498db;
        font-size: 24px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ecf0f1;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
    }
    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ecf0f1;
    }
    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    .btn-primary {
        background: #3498db;
        color: white;
    }
    .btn-primary:hover {
        background: #2980b9;
    }
    .btn-secondary {
        background: #95a5a6;
        color: white;
    }
    .btn-secondary:hover {
        background: #7f8c8d;
    }
    .success-message {
        background: #2ecc71;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .error-message {
        background: #e74c3c;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .helper-text {
        font-size: 12px;
        color: #7f8c8d;
        margin-top: 5px;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .edit-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <div class="edit-header">
        <h1>📝 Edit Your Resume</h1>
        <p>Update your personal information and resume details</p>
    </div>

    @if(session('success'))
        <div class="success-message">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- Personal Information Section -->
        <div class="form-section">
            <h2>👤 Personal Information</h2>
            
            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input 
                    type="text" 
                    id="full_name" 
                    name="full_name" 
                    value="{{ old('full_name', $profile->full_name) }}" 
                    required
                    placeholder="Enter your full name"
                >
            </div>

            <div class="form-group">
                <label for="title">Professional Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $profile->title) }}"
                    placeholder="e.g., Full Stack Developer, Software Engineer"
                >
                <div class="helper-text">Your job title or professional role</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $profile->phone) }}"
                        placeholder="+63 912 345 6789"
                    >
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ old('location', $profile->location) }}"
                        placeholder="City, Country"
                    >
                </div>
            </div>
        </div>

        <!-- Online Presence Section -->
        <div class="form-section">
            <h2>🌐 Online Presence</h2>
            
            <div class="form-group">
                <label for="github">GitHub Profile</label>
                <input 
                    type="url" 
                    id="github" 
                    name="github" 
                    value="{{ old('github', $profile->github) }}"
                    placeholder="https://github.com/yourusername"
                >
            </div>
        </div>

        <!-- About Me Section -->
        <div class="form-section">
            <h2>📄 About Me / Professional Summary</h2>
            
            <div class="form-group">
                <label for="bio">Bio / Summary</label>
                <textarea 
                    id="bio" 
                    name="bio" 
                    placeholder="Write a brief summary about yourself, your skills, and what you're passionate about..."
                >{{ old('bio', $profile->bio) }}</textarea>
                <div class="helper-text">A short paragraph describing your professional background and goals (max 1000 characters)</div>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="form-section">
            <h2>💡 Technical Skills</h2>
            <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 20px;">Manage your skills across four categories</p>
            
            @php
                $categories = [
                    'Frontend Development',
                    'Backend Development',
                    'Tools & Technologies',
                    'Programming Languages'
                ];
                $groupedSkills = $skills->groupBy('category');
            @endphp

            @foreach($categories as $category)
                <div class="skill-category-section" style="margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <h3 style="color: #2c3e50; margin-bottom: 15px;">{{ $category }}</h3>
                    
                    <div class="skills-list" id="skills-{{ Str::slug($category) }}">
                        @if(isset($groupedSkills[$category]))
                            @foreach($groupedSkills[$category] as $skill)
                                <div class="skill-item" data-skill-id="{{ $skill->id }}" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background: white; margin-bottom: 10px; border-radius: 5px;">
                                    <div class="skill-display">
                                        <span class="skill-name" style="font-weight: 500;">{{ $skill->name }}</span>
                                        <span style="color: #7f8c8d; margin-left: 10px;">{{ $skill->proficiency_level }}%</span>
                                    </div>
                                    <div class="skill-actions">
                                        <button type="button" class="btn-edit-skill" onclick="editSkill({{ $skill->id }})" style="background: #3498db; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Edit</button>
                                        <button type="button" class="btn-delete-skill" onclick="deleteSkill({{ $skill->id }}, '{{ $skill->name }}')" style="background: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">×</button>
                                    </div>
                                    <div class="skill-edit-form" style="display: none;">
                                        <input type="text" class="edit-skill-name" value="{{ $skill->name }}" style="padding: 5px; margin-right: 10px; width: 200px;">
                                        <input type="number" class="edit-skill-level" value="{{ $skill->proficiency_level }}" min="0" max="100" style="padding: 5px; margin-right: 10px; width: 80px;">
                                        <button type="button" onclick="saveSkill({{ $skill->id }})" style="background: #27ae60; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Save</button>
                                        <button type="button" onclick="cancelEdit({{ $skill->id }})" style="background: #95a5a6; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Cancel</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Add New Skill Form -->
                    <div class="add-skill-section" style="margin-top: 15px;">
                        <button type="button" class="btn-add-skill" onclick="showAddForm('{{ $category }}')" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">+ Add {{ $category }} Skill</button>
                        
                        <div class="add-skill-form" id="add-form-{{ Str::slug($category) }}" style="display: none; margin-top: 10px; padding: 15px; background: white; border-radius: 5px;">
                            <input type="text" class="new-skill-name" placeholder="Skill name" style="padding: 8px; margin-right: 10px; width: 200px;">
                            <input type="number" class="new-skill-level" placeholder="Level (0-100)" min="0" max="100" value="75" style="padding: 8px; margin-right: 10px; width: 100px;">
                            <button type="button" onclick="addSkill('{{ $category }}')" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Add</button>
                            <button type="button" onclick="cancelAdd('{{ $category }}')" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Work Experience Section -->
        <div class="form-section">
            <h2>💼 Work Experience</h2>
            <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 20px;">Manage your work history</p>
            
            @foreach($experiences as $exp)
                <div class="experience-item" data-exp-id="{{ $exp->id }}" style="margin-bottom: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <!-- Display Mode -->
                    <div class="exp-display">
                        <h3 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 18px;">{{ $exp->job_title }}</h3>
                        <p style="color: #7f8c8d; margin: 0 0 10px 0; font-size: 14px;">{{ $exp->company_details }}</p>
                        <p style="color: #2c3e50; margin: 0; white-space: pre-line;">{{ $exp->description }}</p>
                        <div style="margin-top: 15px;">
                            <button type="button" onclick="editExperience({{ $exp->id }})" style="background: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Edit</button>
                            <button type="button" onclick="deleteExperience({{ $exp->id }}, '{{ $exp->job_title }}')" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Delete</button>
                        </div>
                    </div>
                    
                    <!-- Edit Mode (hidden) -->
                    <div class="exp-edit-form" style="display: none;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Job Title</label>
                            <input type="text" class="edit-exp-title" value="{{ $exp->job_title }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Company & Details</label>
                            <input type="text" class="edit-exp-company" value="{{ $exp->company_details }}" placeholder="e.g., TechCorp Solutions | Remote | Jan 2023 - Present" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Description</label>
                            <textarea class="edit-exp-description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">{{ $exp->description }}</textarea>
                        </div>
                        <button type="button" onclick="saveExperience({{ $exp->id }})" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Save</button>
                        <button type="button" onclick="cancelEditExperience({{ $exp->id }})" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                    </div>
                </div>
            @endforeach
            
            <!-- Add New Experience -->
            <div style="margin-top: 20px;">
                <button type="button" onclick="showAddExperienceForm()" style="background: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">+ Add Work Experience</button>
                
                <div id="add-experience-form" style="display: none; margin-top: 15px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <h3 style="margin-top: 0;">Add New Experience</h3>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Job Title</label>
                        <input type="text" id="new-exp-title" placeholder="e.g., Full Stack Developer" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Company & Details</label>
                        <input type="text" id="new-exp-company" placeholder="e.g., TechCorp Solutions | Remote | Jan 2023 - Present" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Description</label>
                        <textarea id="new-exp-description" rows="4" placeholder="Describe your responsibilities and achievements..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;"></textarea>
                    </div>
                    <button type="button" onclick="addExperience()" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Add</button>
                    <button type="button" onclick="cancelAddExperience()" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Education Section -->
        <div class="form-section">
            <h2>🎓 Education</h2>
            <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 20px;">Edit your education history (2 entries: College & High School)</p>
            
            @foreach($education as $edu)
            <div style="background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 15px; border-left: 4px solid #3498db;" data-edu-id="{{ $edu->id }}">
                
                <!-- Display Mode -->
                <div class="edu-display">
                    <h3 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 18px;">{{ $edu->degree }}</h3>
                    <p style="color: #7f8c8d; margin: 0 0 10px 0; font-size: 14px;">{{ $edu->school_details }}</p>
                    <p style="color: #2c3e50; margin: 0; white-space: pre-line;">{{ $edu->description }}</p>
                    <div style="margin-top: 15px;">
                        <button type="button" onclick="editEducation({{ $edu->id }})" style="background: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Edit</button>
                    </div>
                </div>
                
                <!-- Edit Mode (hidden) -->
                <div class="edu-edit-form" style="display: none;">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Degree / Level</label>
                        <input type="text" class="edit-edu-degree" value="{{ $edu->degree }}" placeholder="e.g., Bachelor of Science in Computer Science" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">School & Details</label>
                        <input type="text" class="edit-edu-details" value="{{ $edu->school_details }}" placeholder="e.g., Batangas State University | Batangas | 2023 - Present" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Description</label>
                        <textarea class="edit-edu-description" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;" placeholder="e.g., Relevant Coursework: ...">{{ $edu->description }}</textarea>
                    </div>
                    <button type="button" onclick="saveEducation({{ $edu->id }})" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Save</button>
                    <button type="button" onclick="cancelEditEducation({{ $edu->id }})" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                </div>
                
            </div>
            @endforeach
        </div>

        <!-- Projects Section -->
        <div class="form-section">
            <h2>🚀 Projects</h2>
            <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 20px;">Manage your portfolio projects</p>
            
            @foreach($projects as $project)
                <div class="project-item" data-project-id="{{ $project->id }}" style="margin-bottom: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid {{ $project->is_featured ? '#27ae60' : '#bdc3c7' }};">
                    <!-- Display Mode -->
                    <div class="project-display">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div>
                                <h3 style="color: #2c3e50; margin: 0 0 5px 0; font-size: 18px;">{{ $project->title }}</h3>
                                @if($project->is_featured)
                                    <span style="background: #27ae60; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px;">Featured</span>
                                @endif
                            </div>
                        </div>
                        <p style="color: #7f8c8d; margin: 8px 0; font-size: 14px;">{{ $project->technologies }}</p>
                        <p style="color: #2c3e50; margin: 0; font-size: 14px;">{{ Str::limit($project->description, 150) }}</p>
                        @if($project->repository_link)
                            <p style="margin: 5px 0 0; font-size: 13px;"><strong>Repo:</strong> <a href="{{ $project->repository_link }}" target="_blank">{{ $project->repository_link }}</a></p>
                        @endif
                        @if($project->live_link)
                            <p style="margin: 5px 0 0; font-size: 13px;"><strong>Live:</strong> <a href="{{ $project->live_link }}" target="_blank">{{ $project->live_link }}</a></p>
                        @endif
                        <div style="margin-top: 15px;">
                            <button type="button" onclick="editProject({{ $project->id }})" style="background: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Edit</button>
                            <button type="button" onclick="deleteProject({{ $project->id }}, '{{ addslashes($project->title) }}')" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Delete</button>
                        </div>
                    </div>

                    <!-- Edit Mode (hidden) -->
                    <div class="project-edit-form" style="display: none;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Title</label>
                            <input type="text" class="edit-project-title" value="{{ $project->title }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Description</label>
                            <textarea class="edit-project-description" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">{{ $project->description }}</textarea>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Technologies (comma-separated)</label>
                            <input type="text" class="edit-project-technologies" value="{{ $project->technologies }}" placeholder="e.g., Laravel, PHP, PostgreSQL" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Repository Link</label>
                                <input type="url" class="edit-project-repo" value="{{ $project->repository_link }}" placeholder="https://github.com/..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Live Demo Link</label>
                                <input type="url" class="edit-project-live" value="{{ $project->live_link }}" placeholder="https://..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Start Date</label>
                                <input type="date" class="edit-project-start" value="{{ $project->start_date?->format('Y-m-d') }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 5px;">End Date</label>
                                <input type="date" class="edit-project-end" value="{{ $project->end_date?->format('Y-m-d') }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                            </div>
                            <div style="display: flex; align-items: end;">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="checkbox" class="edit-project-featured" {{ $project->is_featured ? 'checked' : '' }} style="width: 18px; height: 18px;">
                                    <span style="font-weight: 600;">Featured</span>
                                </label>
                            </div>
                        </div>
                        <button type="button" onclick="saveProject({{ $project->id }})" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Save</button>
                        <button type="button" onclick="cancelEditProject({{ $project->id }})" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                    </div>
                </div>
            @endforeach

            <!-- Add New Project -->
            <div style="margin-top: 20px;">
                <button type="button" onclick="showAddProjectForm()" style="background: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">+ Add Project</button>

                <div id="add-project-form" style="display: none; margin-top: 15px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <h3 style="margin-top: 0;">Add New Project</h3>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Title *</label>
                        <input type="text" id="new-project-title" placeholder="e.g., Portfolio CMS" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Description</label>
                        <textarea id="new-project-description" rows="3" placeholder="Describe the project..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;"></textarea>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px;">Technologies (comma-separated)</label>
                        <input type="text" id="new-project-technologies" placeholder="e.g., Laravel, PHP, PostgreSQL" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Repository Link</label>
                            <input type="url" id="new-project-repo" placeholder="https://github.com/..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Live Demo Link</label>
                            <input type="url" id="new-project-live" placeholder="https://..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Start Date</label>
                            <input type="date" id="new-project-start" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px;">End Date</label>
                            <input type="date" id="new-project-end" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                        </div>
                        <div style="display: flex; align-items: end;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" id="new-project-featured" style="width: 18px; height: 18px;">
                                <span style="font-weight: 600;">Featured</span>
                            </label>
                        </div>
                    </div>
                    <button type="button" onclick="addProject()" style="background: #27ae60; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; margin-right: 5px;">Add</button>
                    <button type="button" onclick="cancelAddProject()" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer;">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                💾 Save Changes
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                ❌ Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/editor.js') }}"></script>
@endsection
