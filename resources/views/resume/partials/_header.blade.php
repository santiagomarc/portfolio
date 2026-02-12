{{-- filepath: resources/views/resume/partials/_header.blade.php --}}
<div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-12 lg:gap-20 w-full">
    <!-- Left Content -->
    <div class="flex-1 text-center lg:text-left space-y-8 relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 mb-6 text-[10px] font-bold tracking-[0.2em] text-emerald-400 uppercase bg-emerald-500/10 rounded-full border border-emerald-500/20 backdrop-blur-md shadow-[0_0_10px_rgba(52,211,153,0.2)]">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Available for Work
            </div>
            <h1 class="text-6xl lg:text-8xl font-bold bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/50 leading-tight tracking-tighter drop-shadow-2xl pb-2">
                {{ $profile->full_name }}
            </h1>
        </div>
        
        <h2 class="text-2xl lg:text-3xl text-slate-300 font-light flex flex-col lg:flex-row items-center gap-4 lg:gap-6 justify-center lg:justify-start">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-purple-400 font-medium">{{ $profile->title ?? 'Full Stack Developer' }}</span>
            <span class="hidden lg:inline-flex items-center justify-center w-1.5 h-1.5 rounded-full bg-slate-600 flex-shrink-0"></span>
            <span class="text-base text-slate-500 inline-flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-slate-600 text-sm"></i>
                {{ $profile->location ?? 'Remote' }}
            </span>
        </h2>

        <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-4">
            <a href="#projects" class="group relative px-8 py-4 bg-sky-500 text-white font-semibold rounded-2xl overflow-hidden shadow-[0_10px_30px_-10px_rgba(14,165,233,0.5)] hover:shadow-[0_20px_40px_-10px_rgba(14,165,233,0.6)] transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-white/20 group-hover:translate-x-full transition-transform duration-700 ease-in-out -skew-x-12 origin-left"></div>
                <span class="relative flex items-center gap-3">
                    View Projects <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </span>
            </a>
            
            <a href="{{ route('resume.pdf') }}" class="group px-8 py-4 bg-white/5 text-slate-200 hover:text-white font-semibold rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300 backdrop-blur-md flex items-center gap-3 hover:border-white/20">
                <i class="fas fa-download opacity-70 group-hover:opacity-100 transition-opacity"></i> Resume
            </a>
            
             @if($profile->github)
            <a href="{{ $profile->github }}" target="_blank" class="px-5 py-4 bg-white/5 text-slate-400 hover:text-white border border-white/10 rounded-2xl hover:bg-white/10 transition-all duration-300 backdrop-blur-md flex items-center justify-center hover:-translate-y-1">
                <i class="fab fa-github text-xl"></i>
            </a>
            @endif
        </div>
        
        <div class="flex flex-wrap justify-center lg:justify-start gap-6 text-slate-500 text-sm mt-8 border-t border-white/5 pt-8 w-fit mx-auto lg:mx-0">
             <a href="mailto:{{ $user->email }}" class="hover:text-sky-400 transition-colors flex items-center gap-2">
                <i class="fas fa-envelope"></i> {{ $user->email }}
            </a>
        </div>
    </div>
    
    <!-- Profile Image -->
    <div class="relative group flex-shrink-0">
        <div class="absolute -inset-4 bg-gradient-to-br from-sky-500/30 to-purple-500/30 rounded-3xl blur-2xl opacity-40 group-hover:opacity-60 transition-all duration-700"></div>
        <div class="relative w-64 h-64 lg:w-80 lg:h-80 rounded-3xl overflow-hidden border border-white/10 shadow-2xl ring-1 ring-white/5 bg-slate-900/50 backdrop-blur-md">
            @if($profile->profile_image)
                <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('images/me.jpg') }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($profile->full_name) }}&background=0ea5e9&color=fff&size=512'" alt="Profile" class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 transition duration-700">
            @endif
        </div>
        <!-- Accent dots -->
        <div class="absolute -top-2 -right-2 w-4 h-4 bg-sky-400 rounded-full shadow-[0_0_15px_rgba(56,189,248,0.6)] animate-pulse"></div>
        <div class="absolute -bottom-2 -left-2 w-3 h-3 bg-purple-400 rounded-full shadow-[0_0_15px_rgba(192,132,252,0.6)] animate-pulse" style="animation-delay: 1s;"></div>
    </div>
</div>
