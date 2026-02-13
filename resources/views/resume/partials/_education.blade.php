{{-- filepath: resources/views/resume/partials/_education.blade.php --}}
<div class="w-full">
    <!-- Section Title -->
    <div class="mb-12 reveal-on-scroll section-title-group">
        <h2 class="section-heading font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/30 tracking-tighter pb-4">Education</h2>
    </div>

    <!-- Content -->
    <div class="glass-panel p-8 md:p-12 rounded-[2.5rem] relative overflow-hidden border-0">

    <div class="grid grid-cols-1 gap-6">
        @forelse($education as $edu)
        <div class="group relative p-8 rounded-3xl bg-white/5 border border-white/5 hover:bg-white/10 transition-all duration-500 hover:-translate-y-1 reveal-on-scroll">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/0 via-emerald-500/0 to-emerald-500/0 group-hover:via-emerald-500/5 transition-all duration-700 rounded-3xl"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row md:items-start justify-between mb-4 gap-2">
                    <h3 class="text-xl lg:text-2xl font-bold text-white group-hover:text-emerald-400 transition-colors">{{ $edu->degree }}</h3>
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-black/40 border border-white/10 text-emerald-200/80 text-xs font-mono tracking-wide">
                        {{ $edu->school_details }}
                    </div>
                </div>
                
                @if($edu->description)
                <p class="text-slate-400 text-sm leading-relaxed border-t border-white/5 pt-4 mt-4 font-light">
                    {{ $edu->description }}
                </p>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-slate-500 italic">No education records added yet.</div>
        @endforelse
    </div>
    </div>
</div>
