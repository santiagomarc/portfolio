{{-- filepath: resources/views/resume/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard — ' . ($profile->full_name ?? 'Admin'))

@section('styles')
<style>
    /* ═══ Dashboard Metric Cards ═══ */
    .metric-card {
        position: relative;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.55), rgba(15, 23, 42, 0.3));
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 1.25rem;
        padding: 1.5rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .metric-card:hover {
        border-color: rgba(56, 189, 248, 0.2);
        box-shadow: 0 8px 32px -8px rgba(14, 165, 233, 0.08);
        transform: translateY(-2px);
    }
    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent, rgba(56, 189, 248, 0.4)), transparent);
        opacity: 0;
        transition: opacity 0.4s;
    }
    .metric-card:hover::before {
        opacity: 1;
    }
    .metric-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #f1f5f9, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ═══ Action cards ═══ */
    .action-card {
        position: relative;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.25));
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 1.5rem;
        padding: 2rem 1.75rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }
    .action-card:hover {
        border-color: rgba(56, 189, 248, 0.15);
        box-shadow: 0 12px 40px -12px rgba(14, 165, 233, 0.06);
        transform: translateY(-3px);
    }
    .action-icon-wrap {
        width: 3.25rem;
        height: 3.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 1rem;
        font-size: 1.25rem;
        flex-shrink: 0;
        transition: all 0.35s;
    }
    .action-card:hover .action-icon-wrap {
        transform: scale(1.08);
    }

    /* ═══ Quick-link button ═══ */
    .dash-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 0.65rem 1.4rem;
        border-radius: 0.75rem;
        font-size: 0.8125rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        transition: all 0.3s;
        cursor: pointer;
        white-space: nowrap;
    }
    .dash-btn-primary {
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
        color: #ffffff;
        border: none;
        box-shadow: 0 4px 20px -6px rgba(14, 165, 233, 0.4);
    }
    .dash-btn-primary:hover {
        box-shadow: 0 6px 28px -6px rgba(14, 165, 233, 0.55);
        transform: translateY(-1px);
    }
    .dash-btn-ghost {
        background: rgba(255, 255, 255, 0.04);
        color: #cbd5e1;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .dash-btn-ghost:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.15);
        color: #f1f5f9;
    }
    .dash-btn-danger {
        background: rgba(244, 63, 94, 0.08);
        color: #fda4af;
        border: 1px solid rgba(244, 63, 94, 0.15);
    }
    .dash-btn-danger:hover {
        background: rgba(244, 63, 94, 0.14);
        border-color: rgba(251, 113, 133, 0.3);
        color: #fecdd3;
    }

    /* ═══ Status indicator ═══ */
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 8px rgba(52, 211, 153, 0.6);
        animation: pulse-dot 2s infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 8px rgba(52, 211, 153, 0.6); }
        50% { box-shadow: 0 0 16px rgba(52, 211, 153, 0.9); }
    }

    /* ═══ Decorative glow ═══ */
    .hero-glow-dash {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        opacity: 0.3;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-x-hidden text-slate-200 font-sans selection:bg-sky-500/30">

    <!-- Main Content Area -->
    <main class="w-full relative z-10 min-h-screen flex flex-col">

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- TOP BAR                                                 --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <header class="sticky top-0 z-50 backdrop-blur-2xl bg-slate-950/60 border-b border-white/[0.04]">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-4 flex items-center justify-between">
                {{-- Left: Brand / Greeting --}}
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-sky-500/20">
                        {{ strtoupper(substr($profile->full_name ?? 'M', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm leading-tight">{{ $profile->full_name ?? 'Admin' }}</p>
                        <p class="text-slate-500 text-[0.65rem] tracking-wide">Dashboard</p>
                    </div>
                </div>

                {{-- Right: Quick Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="dash-btn dash-btn-ghost text-xs">
                        <i class="fas fa-external-link-alt"></i>
                        <span class="hidden sm:inline">View Site</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="dash-btn dash-btn-danger text-xs">
                            <i class="fas fa-right-from-bracket"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- DASHBOARD BODY                                          --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="flex-1 w-full max-w-7xl mx-auto px-6 lg:px-10 py-10 lg:py-14 relative">

            {{-- Decorative glow --}}
            <div class="hero-glow-dash w-72 h-72 bg-sky-500/15 -top-20 -left-36" style="position:absolute;"></div>
            <div class="hero-glow-dash w-56 h-56 bg-indigo-500/10 top-24 -right-20" style="position:absolute;"></div>

            {{-- ─── Welcome Section ─── --}}
            <div class="mb-12">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-2">
                    <span class="bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/50">Welcome back,</span>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-400 to-indigo-400"> {{ explode(' ', $profile->full_name ?? 'Admin')[0] }}</span>
                </h1>
                <p class="text-slate-400 text-sm sm:text-base">Manage your portfolio from here. Your public site is live and accessible to visitors.</p>
            </div>

            {{-- ─── Status & Metrics ─── --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
                <div class="metric-card" style="--accent: rgba(56, 189, 248, 0.4);">
                    <p class="text-slate-500 text-[0.65rem] font-semibold uppercase tracking-[0.15em] mb-2">Projects</p>
                    <p class="metric-value">{{ $projects->count() }}</p>
                </div>
                <div class="metric-card" style="--accent: rgba(99, 102, 241, 0.4);">
                    <p class="text-slate-500 text-[0.65rem] font-semibold uppercase tracking-[0.15em] mb-2">Experience</p>
                    <p class="metric-value">{{ $experiences->count() }}</p>
                </div>
                <div class="metric-card" style="--accent: rgba(52, 211, 153, 0.4);">
                    <p class="text-slate-500 text-[0.65rem] font-semibold uppercase tracking-[0.15em] mb-2">Skills</p>
                    <p class="metric-value">{{ $skills->count() }}</p>
                </div>
                <div class="metric-card" style="--accent: rgba(251, 191, 36, 0.4);">
                    <p class="text-slate-500 text-[0.65rem] font-semibold uppercase tracking-[0.15em] mb-2">Education</p>
                    <p class="metric-value">{{ $education->count() }}</p>
                </div>
            </div>

            {{-- ─── Primary Action Cards ─── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">

                {{-- Edit Resume --}}
                <a href="{{ route('profile.edit') }}" class="action-card group">
                    <div class="flex items-center gap-4">
                        <div class="action-icon-wrap bg-sky-500/10 text-sky-400 border border-sky-500/15">
                            <i class="fas fa-pen-to-square"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-base group-hover:text-sky-300 transition-colors">Edit Resume</h3>
                            <p class="text-slate-500 text-xs mt-0.5">Update your profile, skills, projects & experience</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sky-400/60 text-xs font-medium mt-auto">
                        <span>Open Editor</span>
                        <i class="fas fa-arrow-right text-[0.6rem] transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                {{-- View Public Site --}}
                <a href="{{ route('home') }}" target="_blank" class="action-card group">
                    <div class="flex items-center gap-4">
                        <div class="action-icon-wrap bg-emerald-500/10 text-emerald-400 border border-emerald-500/15">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-base group-hover:text-emerald-300 transition-colors">View Public Site</h3>
                            <p class="text-slate-500 text-xs mt-0.5">See how visitors experience your portfolio</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-auto">
                        <div class="status-dot"></div>
                        <span class="text-emerald-400/70 text-xs font-medium">Live</span>
                        <i class="fas fa-external-link-alt text-slate-600 text-[0.55rem] ml-auto transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                {{-- Download PDF --}}
                <a href="{{ route('resume.pdf') }}" class="action-card group">
                    <div class="flex items-center gap-4">
                        <div class="action-icon-wrap bg-violet-500/10 text-violet-400 border border-violet-500/15">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-base group-hover:text-violet-300 transition-colors">Download PDF</h3>
                            <p class="text-slate-500 text-xs mt-0.5">Export your resume as a formatted PDF</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-violet-400/60 text-xs font-medium mt-auto">
                        <span>Generate & Download</span>
                        <i class="fas fa-download text-[0.6rem] transition-transform group-hover:translate-y-0.5"></i>
                    </div>
                </a>

            </div>

            {{-- ═══════════════════════════════════════════════════════ --}}
            {{-- DATA MANAGEMENT TABLES                                  --}}
            {{-- ═══════════════════════════════════════════════════════ --}}

            {{-- ─── Projects Table ─── --}}
            <div id="manage-projects" class="glass-panel rounded-2xl p-6 sm:p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-sky-500/10 flex items-center justify-center text-sky-400 border border-sky-500/15">
                            <i class="fas fa-cube text-sm"></i>
                        </div>
                        <h2 class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Projects</h2>
                    </div>
                    <a href="{{ route('profile.edit') }}#projects" class="dash-btn dash-btn-ghost text-xs">
                        <i class="fas fa-plus text-[0.6rem]"></i> Add New
                    </a>
                </div>
                @if($projects->count() > 0)
                <div class="space-y-3">
                    @foreach($projects as $project)
                    <div class="p-4 rounded-xl bg-slate-950/30 border border-white/[0.04] hover:border-sky-500/15 transition-all duration-300">
                        <div class="flex items-center gap-2.5">
                            <p class="text-white font-medium text-sm truncate">{{ $project->title }}</p>
                            @if($project->is_featured)
                            <span class="text-[0.6rem] font-bold uppercase tracking-wider text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-full">Featured</span>
                            @endif
                        </div>
                        <p class="text-slate-500 text-xs mt-1 truncate">{{ $project->technologies ?? 'No technologies listed' }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-slate-500 text-sm text-center py-8">No projects yet. <a href="{{ route('profile.edit') }}#projects" class="text-sky-400 hover:text-sky-300 underline">Add your first project</a>.</p>
                @endif
            </div>

            {{-- ─── Experience Table ─── --}}
            <div id="manage-experience" class="glass-panel rounded-2xl p-6 sm:p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 border border-indigo-500/15">
                            <i class="fas fa-briefcase text-sm"></i>
                        </div>
                        <h2 class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Experience</h2>
                    </div>
                    <a href="{{ route('profile.edit') }}#experience" class="dash-btn dash-btn-ghost text-xs">
                        <i class="fas fa-plus text-[0.6rem]"></i> Add New
                    </a>
                </div>
                @if($experiences->count() > 0)
                <div class="space-y-3">
                    @foreach($experiences as $exp)
                    <div class="p-4 rounded-xl bg-slate-950/30 border border-white/[0.04] hover:border-indigo-500/15 transition-all duration-300">
                        <p class="text-white font-medium text-sm truncate">{{ $exp->job_title }}</p>
                        <p class="text-slate-500 text-xs mt-1">{{ $exp->company }} &middot; {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} — {{ $exp->is_current ? 'Present' : \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-slate-500 text-sm text-center py-8">No experience entries yet. <a href="{{ route('profile.edit') }}#experience" class="text-sky-400 hover:text-sky-300 underline">Add your first role</a>.</p>
                @endif
            </div>

            {{-- ─── Skills Table ─── --}}
            <div id="manage-skills" class="glass-panel rounded-2xl p-6 sm:p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/15">
                            <i class="fas fa-bolt text-sm"></i>
                        </div>
                        <h2 class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Skills</h2>
                    </div>
                    <a href="{{ route('profile.edit') }}#skills" class="dash-btn dash-btn-ghost text-xs">
                        <i class="fas fa-plus text-[0.6rem]"></i> Add New
                    </a>
                </div>
                @if($skills->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($skills->groupBy('category') as $category => $categorySkills)
                    <div class="p-4 rounded-xl bg-slate-950/30 border border-white/[0.04]">
                        <p class="text-slate-400 text-[0.65rem] font-semibold uppercase tracking-[0.15em] mb-3">{{ $category }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($categorySkills as $skill)
                            <span class="text-[0.7rem] font-medium text-slate-300 bg-slate-800/60 px-2.5 py-1 rounded-lg border border-white/[0.04]">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('profile.edit') }}#skills" class="text-sky-400 hover:text-sky-300 text-xs font-medium transition-colors">
                        <i class="fas fa-pen text-[0.55rem] mr-1"></i> Manage All Skills
                    </a>
                </div>
                @else
                <p class="text-slate-500 text-sm text-center py-8">No skills added yet. <a href="{{ route('profile.edit') }}#skills" class="text-sky-400 hover:text-sky-300 underline">Add your skills</a>.</p>
                @endif
            </div>

            {{-- ─── Education Table ─── --}}
            <div id="manage-education" class="glass-panel rounded-2xl p-6 sm:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 border border-amber-500/15">
                            <i class="fas fa-graduation-cap text-sm"></i>
                        </div>
                        <h2 class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">Education</h2>
                    </div>
                    <a href="{{ route('profile.edit') }}#education" class="dash-btn dash-btn-ghost text-xs">
                        <i class="fas fa-pen-to-square text-[0.6rem]"></i> Edit
                    </a>
                </div>
                @if($education->count() > 0)
                <div class="space-y-3">
                    @foreach($education as $edu)
                    <div class="p-4 rounded-xl bg-slate-950/30 border border-white/[0.04] hover:border-amber-500/15 transition-all duration-300">
                        <p class="text-white font-medium text-sm truncate">{{ $edu->degree }}</p>
                        <p class="text-slate-500 text-xs mt-1">{{ $edu->institution }} &middot; {{ $edu->year_graduated ?? 'In Progress' }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-slate-500 text-sm text-center py-8">No education entries yet. <a href="{{ route('profile.edit') }}#education" class="text-sky-400 hover:text-sky-300 underline">Add your education</a>.</p>
                @endif
            </div>

        </div>

        {{-- ═══ Footer ═══ --}}
        <footer class="py-8 text-center text-slate-600 text-xs border-t border-white/[0.04] mt-auto">
            <p>&copy; {{ date('Y') }} {{ $profile->full_name ?? 'Marc Santiago' }}. Dashboard.</p>
        </footer>

    </main>
</div>
@endsection
