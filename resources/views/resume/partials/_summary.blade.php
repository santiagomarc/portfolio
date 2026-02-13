{{-- filepath: resources/views/resume/partials/_summary.blade.php --}}
<div class="w-full">
    <!-- Section Title -->
    <div class="mb-12 reveal-on-scroll section-title-group">
        <h2 class="section-heading font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/30 tracking-tighter pb-4">About Me</h2>
    </div>

    <!-- Content -->
    <div class="glass-panel p-8 md:p-14 rounded-[2.5rem] relative overflow-hidden reveal-on-scroll">
        <!-- Ambient Light -->
        <div class="absolute -top-20 -left-20 w-60 h-60 bg-sky-500/10 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-60 h-60 bg-purple-500/10 rounded-full blur-[80px] pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-start gap-12 lg:gap-16">
            <!-- Left: Bio -->
            <div class="flex-1 space-y-6">
            
            <p class="text-base lg:text-lg text-slate-300 leading-relaxed font-light">
                {{ $profile->bio ?? 'A passionate developer eager to build innovative solutions.' }}
            </p>

            <div class="flex flex-wrap gap-3 pt-2">
                <a href="#experience" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-500/10 rounded-full border border-sky-500/20 hover:bg-sky-500/20 transition-all">
                    <i class="fas fa-briefcase"></i> Experience
                </a>
                <a href="#skills" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold tracking-wider uppercase text-purple-400 bg-purple-500/10 rounded-full border border-purple-500/20 hover:bg-purple-500/20 transition-all">
                    <i class="fas fa-bolt"></i> Skills
                </a>
            </div>
        </div>

        <!-- Divider -->
        <div class="hidden lg:block w-px self-stretch bg-gradient-to-b from-transparent via-white/10 to-transparent"></div>
        <div class="block lg:hidden w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        <!-- Right: Stats -->
        <div class="flex lg:flex-col justify-around lg:justify-center gap-8 lg:gap-10 w-full lg:w-auto lg:min-w-[160px]">
            <div class="flex flex-col items-center gap-1.5 group">
                <span class="text-4xl lg:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-400 group-hover:to-sky-400 transition-all">3+</span>
                <span class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-semibold">Years Exp</span>
            </div>
            <div class="flex flex-col items-center gap-1.5 group">
                <span class="text-4xl lg:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-400 group-hover:to-purple-400 transition-all">10+</span>
                <span class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-semibold">Projects</span>
            </div>
            <div class="flex flex-col items-center gap-1.5 group">
                <span class="text-4xl lg:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-400 group-hover:to-emerald-400 transition-all">100%</span>
                <span class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-semibold">Commitment</span>
            </div>
        </div>
    </div>
    </div>
</div>
