<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Resume Portfolio | migoy')</title>
    
    
    <!-- Google Analytics (placeholder - replace UA-XXXXX with your tracking ID) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-XXXXX');
    </script> -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased overflow-x-hidden selection:bg-sky-500/30 selection:text-white">
    <!-- Animated Background -->
    <div class="fixed inset-0 -z-50 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-sky-900/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-900/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>
    <!-- Flash Messages -->
    @auth
        <div class="fixed top-8 right-8 z-[100] flex flex-col gap-4 w-full max-w-sm pointer-events-none">
            @if(session('success'))
                <div class="glass-panel px-6 py-4 rounded-xl border-l-4 border-emerald-500 text-emerald-100 pointer-events-auto transform transition-all duration-300 hover:scale-105 shadow-[0_10px_40px_-10px_rgba(16,185,129,0.2)]">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-emerald-500/20 rounded-full">
                            <i class="fas fa-check text-emerald-400"></i>
                        </div>
                        <span class="font-medium tracking-wide">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="glass-panel px-6 py-4 rounded-xl border-l-4 border-rose-500 text-rose-100 pointer-events-auto transform transition-all duration-300 hover:scale-105 shadow-[0_10px_40px_-10px_rgba(244,63,94,0.2)]">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-rose-500/20 rounded-full">
                            <i class="fas fa-exclamation text-rose-400"></i>
                        </div>
                        <span class="font-medium tracking-wide">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                 <div class="glass-panel px-6 py-4 rounded-xl border-l-4 border-amber-500 text-amber-100 pointer-events-auto transform transition-all duration-300 shadow-[0_10px_40px_-10px_rgba(245,158,11,0.2)]">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle mt-1 text-amber-400"></i>
                         <div>
                            <p class="font-medium mb-1">Please fix the following:</p>
                            <ul class="list-disc pl-4 space-y-1 text-sm opacity-90">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endauth

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <!-- This script handles the reveal-on-scroll animation for elements with the class 'reveal-on-scroll' -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '-60px 0px',
                threshold: 0.15
            };
    
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        entry.target.classList.remove('unrevealed');
                    } else {
                        entry.target.classList.remove('revealed');
                        entry.target.classList.add('unrevealed');
                    }
                });
            }, observerOptions);
    
            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
    @yield('scripts')
</body>
</html>