{{-- filepath: resources/views/resume/public.blade.php --}}
@extends('layouts.app')

@section('title', 'Marc Santiago - Portfolio')

@section('styles')
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
@endsection

@extends('layouts.app')

@section('title', 'Marc Santiago - Portfolio')

@section('styles')
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-hidden text-slate-200 font-sans selection:bg-sky-500/30">
    
    <!-- Floating Navigation Dock -->
    @include('resume.partials._nav')

    <!-- Main Content Area -->
    <main class="w-full h-full relative z-10">
        
        <!-- Profile / Hero -->
        <section id="profile" class="min-h-screen flex items-center justify-center p-6 lg:p-24 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-20 pointer-events-none">
                <div class="w-96 h-96 bg-sky-500/30 rounded-full blur-3xl animate-pulse"></div>
            </div>
            <div class="w-full max-w-7xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                @include('resume.partials._header')
            </div>
        </section>

        <!-- Summary -->
        <section id="summary" class="min-h-screen flex items-center justify-center p-6 lg:p-24 relative">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-900/10 to-transparent pointer-events-none"></div>
            <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out delay-100">
                @include('resume.partials._summary')
            </div>
        </section>

        <!-- Experience -->
        <section id="experience" class="min-h-screen flex items-center justify-center p-6 lg:p-24">
            <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                @include('resume.partials._experience')
            </div>
        </section>
        
        <!-- Projects -->
        <section id="projects" class="min-h-screen flex items-center justify-center p-6 lg:p-24 relative">
             <div class="absolute left-0 bottom-0 w-full h-1/2 bg-gradient-to-t from-slate-900/20 to-transparent pointer-events-none"></div>
            <div class="w-full max-w-6xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                 @include('resume.partials._projects')
            </div>
        </section>
        
        <!-- Education & Skills (Grouped for better flow) -->
        <section id="skills" class="min-h-screen flex flex-col justify-center items-center p-6 lg:p-24 gap-20">
            <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                @include('resume.partials._education')
            </div>
            
            <div class="w-full max-w-6xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                @include('resume.partials._skills')
            </div>
        </section>

        <footer class="py-12 text-center text-slate-500 text-sm glass-panel border-t border-white/5 mt-20">
            <p>© {{ date('Y') }} {{ $profile->full_name ?? 'Marc Santiago' }}. Designed with Vision.</p>
        </footer>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // Optional scripts
</script>
@endsection
