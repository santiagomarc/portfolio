{{-- filepath: resources/views/resume/partials/_experience.blade.php --}}
<div class="w-full">
    <!-- Section Title -->
    <div class="mb-12 reveal-on-scroll section-title-group">
        <h2 class="section-heading font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/30 tracking-tighter pb-4">Experience</h2>
    </div>

    <!-- Content -->
    <div class="glass-panel p-8 md:p-12 rounded-[2.5rem] relative overflow-hidden">
        
        <!-- Ambient Light -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-sky-500/10 rounded-full blur-[100px] pointer-events-none -mr-32 -mt-32"></div>

    <!-- Timeline -->
    <div class="space-y-12 relative">
        <!-- Connecting Line -->
        <div class="absolute left-[27px] top-4 bottom-0 w-0.5 bg-gradient-to-b from-sky-500/50 via-white/10 to-transparent"></div>

        @forelse($experiences as $job)
        <div class="relative pl-20 lg:pl-24 group reveal-on-scroll transition-all duration-700 hover:translate-x-2">
            <!-- Timeline Dot -->
            <div class="absolute left-[19px] top-2.5 w-4 h-4 rounded-full bg-slate-950 border-2 border-sky-500/50 group-hover:border-sky-400 group-hover:scale-125 transition-all duration-300 shadow-[0_0_15px_rgba(14,165,233,0.3)] z-10">
                <div class="absolute inset-0 bg-sky-400 rounded-full opacity-0 group-hover:opacity-100 animate-ping"></div>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4 gap-2">
                <div>
                    <h3 class="text-xl lg:text-2xl font-bold text-white group-hover:text-sky-400 transition-colors">{{ $job->job_title }}</h3>
                    <div class="text-sky-200/80 font-medium">{{ $job->company_details }}</div>
                </div>
                <!-- Optional date if it was available in separate fields, assuming mixed in company_details or desc for now -->
            </div>
            
            @if($job->description)
            <div class="text-slate-400 leading-relaxed text-sm lg:text-base bg-white/5 p-6 rounded-2xl border border-white/5 hover:bg-white/10 transition-colors shadow-lg">
                 {!! nl2br(e($job->description)) !!}
            </div>
            @endif
        </div>
        @empty
        <div class="pl-24 text-slate-500 italic py-4">No work experience added yet.</div>
        @endforelse
    </div>
    </div>
</div>
