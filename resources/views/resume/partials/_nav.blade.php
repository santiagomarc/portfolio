<nav class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50">
    <div class="glass-panel px-6 py-4 rounded-full flex items-center gap-6 md:gap-8 shadow-2xl border border-white/10 ring-1 ring-white/5 transition-all duration-500 hover:scale-105">
        @php
            $navItems = [
                ['id' => 'profile', 'label' => 'Home', 'icon' => 'fa-home'],
                ['id' => 'summary', 'label' => 'About', 'icon' => 'fa-user'],
                ['id' => 'experience', 'label' => 'Exp', 'icon' => 'fa-briefcase'],
                ['id' => 'projects', 'label' => 'Work', 'icon' => 'fa-cube'],
                ['id' => 'skills', 'label' => 'Skills', 'icon' => 'fa-bolt'],
            ];
        @endphp

        @foreach($navItems as $item)
        <a href="#{{$item['id']}}" 
           class="group relative flex flex-col items-center justify-center w-10 h-10 md:w-12 md:h-12 text-slate-400 hover:text-white transition-all duration-300">
            
            <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 rounded-xl transition-all duration-300 scale-0 group-hover:scale-100"></div>
            
            <i class="fas {{ $item['icon'] }} text-lg md:text-xl relative z-10 transition-transform duration-300 group-hover:-translate-y-1"></i>
            
            <span class="absolute -top-10 scale-0 group-hover:scale-100 bg-black/80 text-white text-[10px] px-2 py-1 rounded-md transition-all duration-300 backdrop-blur-md border border-white/10 whitespace-nowrap">
                {{ $item['label'] }}
            </span>
            
            <div class="absolute -bottom-1 w-1 h-1 bg-sky-400 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
        </a>
        @endforeach

        <div class="w-px h-8 bg-white/10 mx-2"></div>

        <a href="{{ route('resume.pdf') }}" 
           class="group relative flex items-center justify-center w-10 h-10 md:w-12 md:h-12 text-sky-400 hover:text-sky-300 transition-all duration-300"
           title="Download PDF">
            <div class="absolute inset-0 bg-sky-500/0 group-hover:bg-sky-500/20 rounded-xl transition-all duration-300 scale-0 group-hover:scale-100"></div>
            <i class="fas fa-file-arrow-down text-lg md:text-xl relative z-10"></i>
        </a>
    </div>
</nav>