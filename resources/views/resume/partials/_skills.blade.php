{{-- filepath: resources/views/resume/partials/_skills.blade.php --}}
<div class="w-full">
    <!-- Header -->
    <div class="mb-12 reveal-on-scroll section-title-group">
        <h2 class="section-heading font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/30 tracking-tighter pb-4">Skills</h2>
    </div>

    @php $groupedSkills = $skills->groupBy('category'); @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($groupedSkills as $category => $skillList)
        <div class="glass-panel p-8 rounded-[2rem] bg-white/[0.02] hover:bg-white/[0.04] transition-all duration-500 reveal-on-scroll">
            <h4 class="text-xl font-bold text-rose-400 mb-8 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg bg-rose-500/20 flex items-center justify-center text-rose-400">
                    <i class="fas fa-code text-sm"></i>
                </span>
                {{ $category ?: 'General' }}
            </h4>
            
            <div class="space-y-6">
                @foreach($skillList as $skill)
                <div class="group">
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-slate-200 font-medium tracking-wide group-hover:text-white transition-colors">{{ $skill->name }}</span>
                        <span class="text-slate-500 text-xs font-mono font-bold">{{ $skill->proficiency_level }}%</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden backdrop-blur-sm ring-1 ring-white/5">
                        <div class="h-full bg-gradient-to-r from-rose-600 to-amber-400 rounded-full transition-all duration-1000 ease-out group-hover:shadow-[0_0_15px_rgba(244,63,94,0.5)] transform origin-left scale-x-0 animate-expand-width" style="width: {{ $skill->proficiency_level }}%; animation-delay: 0.2s; animation-fill-mode: forwards;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
@keyframes expand-width {
    to { transform: scaleX(1); }
}
.animate-expand-width {
    animation: expand-width 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}
</style>
