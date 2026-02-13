{{-- filepath: resources/views/resume/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Marc Santiago - Dashboard')

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

@section('content')
<div class="relative min-h-screen overflow-x-hidden text-slate-200 font-sans selection:bg-sky-500/30">
    
    <!-- Floating Navigation Dock -->
    @include('resume.partials._nav')

    <!-- Main Content Area -->
    <main class="w-full h-full relative z-10 pb-20">
        
        <!-- Profile / Hero -->
        <section id="profile" class="min-h-screen flex items-center justify-center p-6 lg:p-24 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-20 pointer-events-none">
                <div class="w-96 h-96 bg-sky-500/30 rounded-full blur-3xl animate-pulse"></div>
            </div>
            <div class="w-full max-w-7xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                @include('resume.partials._header')
            </div>
        </section>

        <!-- Main Content Stack -->
        <div class="flex flex-col gap-24 lg:gap-32 px-6 lg:px-24 w-full max-w-[90rem] mx-auto">

            <!-- Summary -->
            <section id="summary" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out delay-100">
                    @include('resume.partials._summary')
                </div>
            </section>

            <!-- Experience -->
            <section id="experience" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                    @include('resume.partials._experience')
                </div>
            </section>
            
            <!-- Projects -->
            <section id="projects" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-6xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                     @include('resume.partials._projects')
                </div>
            </section>
            
            <!-- Education -->
            <section id="education" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-5xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                    @include('resume.partials._education')
                </div>
            </section>
                
            <!-- Skills -->
            <section id="skills" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-6xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                    @include('resume.partials._skills')
                </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="flex justify-center scroll-mt-32">
                <div class="w-full max-w-4xl reveal-on-scroll opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                     @include('resume.partials._contact')
                </div>
            </section>

        </div>

        <footer class="py-12 text-center text-slate-500 text-sm glass-panel mt-32 mx-6 lg:mx-24 rounded-3xl">
            <p>&copy; {{ date('Y') }} {{ $profile->full_name ?? 'Marc Santiago' }}. Designed with Vision.</p>
        </footer>
    </main>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/resume.js') }}"></script>
@endsection
