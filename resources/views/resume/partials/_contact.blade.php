{{-- filepath: resources/views/resume/partials/_contact.blade.php --}}
<div class="w-full max-w-2xl mx-auto">
    <div class="text-center mb-12">
        <h2 class="text-3xl lg:text-4xl font-bold text-slate-100 tracking-tight mb-4">Get In Touch</h2>
        <p class="text-slate-400">Feel free to reach out for collaboration opportunities or just to say hello!</p>
    </div>

    <form id="contactForm" method="POST" action="{{ route('contact.send') }}" class="space-y-6 bg-slate-900/50 p-8 rounded-2xl border border-transparent backdrop-blur-sm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="name" class="text-sm font-medium text-slate-300">Name</label>
                <input type="text" name="name" id="name" placeholder="John Doe" required 
                    class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent text-white placeholder-slate-500 transition-all outline-none">
            </div>
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-slate-300">Email</label>
                <input type="email" name="email" id="email" placeholder="john@example.com" required 
                    class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent text-white placeholder-slate-500 transition-all outline-none">
            </div>
        </div>
        <div class="space-y-2">
            <label for="message" class="text-sm font-medium text-slate-300">Message</label>
            <textarea name="message" id="message" rows="5" placeholder="Your message here..." required 
                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent text-white placeholder-slate-500 transition-all outline-none resize-none"></textarea>
        </div>
        <button type="submit" class="w-full py-4 bg-sky-600 hover:bg-sky-500 text-white font-bold rounded-lg transition-all transform hover:-translate-y-1 shadow-lg shadow-sky-600/20">
            Send Message
        </button>
    </form>
    <div id="form-response" class="mt-4 text-center"></div>
</div>
