{{-- filepath: resources/views/resume/partials/_projects.blade.php --}}
<div class="w-full">
    <!-- Header -->
    <div class="mb-12 reveal-on-scroll section-title-group">
        <h2 class="section-heading font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/30 tracking-tighter pb-4">Selected Work</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
        <div class="group glass-card rounded-[2rem] overflow-hidden hover:scale-[1.02] transition-all duration-500 flex flex-col h-full reveal-on-scroll bg-gradient-to-br from-white/5 to-white/[0.02]">
            <!-- Thumbnail -->
            <div class="relative h-56 overflow-hidden">
                @if($project->thumbnail_path)
                    <img src="{{ asset($project->thumbnail_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-900/50 text-slate-700 group-hover:text-purple-400 transition-colors backdrop-blur-sm">
                        <i class="fas fa-laptop-code text-6xl opacity-50"></i>
                    </div>
                @endif
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                
                <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
                     <!-- Tech Stack Badges (limited) -->
                      <div class="flex -space-x-2">
                        @foreach(array_slice(explode(',', $project->technologies), 0, 3) as $tech)
                            <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-[10px] text-white font-bold shadow-lg" title="{{ trim($tech) }}">
                                {{ substr(trim($tech), 0, 2) }}
                            </div>
                        @endforeach
                      </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 flex flex-col flex-1 relative">
                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">{{ $project->title }}</h3>
                
                <p class="text-slate-400 text-sm leading-relaxed mb-8 flex-1 line-clamp-3 font-light">{{ $project->description }}</p>

                <div class="flex gap-4 mt-auto">
                     @if($project->repository_link)
                    <a href="{{ $project->repository_link }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-xs font-bold uppercase tracking-wider text-white bg-white/5 hover:bg-white/10 rounded-xl border border-white/10 transition-all backdrop-blur-md">
                        <i class="fab fa-github text-lg"></i> Code
                    </a>
                    @endif
                    @if($project->live_link)
                    <a href="{{ $project->live_link }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-xs font-bold uppercase tracking-wider text-white bg-purple-500 hover:bg-purple-400 rounded-xl shadow-lg shadow-purple-500/20 transition-all">
                        <i class="fas fa-bolt text-lg"></i> Live
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="inline-block p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                <i class="fas fa-folder-open text-4xl text-slate-600 mb-4"></i>
                <p class="text-slate-400">No projects to display yet.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
