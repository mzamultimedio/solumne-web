<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instituto Solumne - Formación Profesional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #111827;
            background-image: radial-gradient(circle at center, rgba(30, 58, 58, 0.4), transparent 50%);
        }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        
        @keyframes float-medium {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(3deg); }
        }
        
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .animate-float-slow {
            animation: float-slow 4s ease-in-out infinite;
        }
        
        .animate-float-medium {
            animation: float-medium 3s ease-in-out infinite;
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 2.5s ease-in-out infinite;
        }
    </style>
</head>
<body class="overflow-hidden">

    <div x-data="{ menuOpen: false }" class="relative">
        
        <div x-show="menuOpen" class="fixed inset-0 z-40" @click="menuOpen = false" x-cloak>
            <div x-show="menuOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-black/80"></div>
        </div>
        
        <aside x-show="menuOpen"
               x-transition:enter="transition ease-in-out duration-500"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in-out duration-500"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed top-0 left-0 z-50 h-full w-72 bg-gray-800 p-8 shadow-2xl" x-cloak>
            
            <button @click="menuOpen = false" class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 border-2 border-red-400/50 rounded-full text-red-400/50 hover:border-red-400 hover:text-red-400 hover:bg-red-400/10 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            
            <nav class="flex flex-col space-y-6 text-lg mt-12">
                <a href="{{ route('downloads.index') }}" class="font-semibold text-gray-300 hover:text-yellow-400">Descargas</a>
                <a href="{{ route('sedes.index') }}" class="font-semibold text-gray-300 hover:text-yellow-400">Nuestras Sedes</a>
            </nav>
        </aside>

        <header class="absolute top-0 left-0 z-30 grid w-full grid-cols-3 items-center p-6 px-4 md:px-8">
            <div class="flex items-center justify-start">
                <button @click="menuOpen = !menuOpen" class="text-gray-400 hover:text-yellow-400 md:hidden">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <nav class="hidden md:flex md:items-center md:space-x-8">
                    <a href="{{ route('downloads.index') }}" class="text-sm font-semibold tracking-widest text-gray-400 uppercase transition duration-300 hover:text-yellow-400">Descargas</a>
                </nav>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="block w-24 md:w-32">
                    <img src="/images/logo-solumne.png" alt="Logo Instituto Solumne">
                </a>
            </div>
            <div></div>
        </header>

        <main class="relative flex items-center justify-center w-full min-h-screen pt-32 pb-32 md:pt-0 md:pb-0">
            <div class="absolute z-0 opacity-20">
                <img src="/images/logo-solumne.png" alt="Logo Solumne Fondo" class="w-[60vw] md:w-[50vw] max-w-xl animate-pulse">
            </div>
            <div class="relative z-10 flex flex-col items-center p-4 text-center text-white">
                <h1 class="text-3xl font-light text-yellow-400 md:text-6xl tracking-[0.2em] uppercase mb-4">
                    Instituto Solumne
                </h1>
                <p class="max-w-2xl text-base text-gray-400 md:text-xl">
                    Formación profesional de excelencia. Cursá desde cualquier lugar con nuestra plataforma educativa digital.
                </p>
                
                {{-- Iconos animados educativos --}}
                <div class="flex items-center justify-center gap-6 md:gap-10 my-8">
                    {{-- Libro abierto --}}
                    <div class="animate-float-slow">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-yellow-400/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    
                    {{-- Gorro de graduación --}}
                    <div class="animate-float-medium">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-amber-400/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                    </div>
                    
                    {{-- Estrella / Excelencia --}}
                    <div class="animate-pulse-slow">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    
                    {{-- Certificado --}}
                    <div class="animate-float-medium" style="animation-delay: -1s;">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-amber-400/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    
                    {{-- Bombilla / Ideas --}}
                    <div class="animate-float-slow" style="animation-delay: -2s;">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-yellow-400/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                        </svg>
                    </div>
                </div>
                
                <div class="w-24 h-px bg-yellow-400/50"></div>
                <div class="flex flex-col items-center space-y-4 md:space-y-5">
                    <a href="{{ route('login') }}" class="px-8 py-3 text-sm font-bold tracking-widest uppercase transition duration-300 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 md:px-10">
                        Acceso Alumnos
                    </a>
                    <a href="{{ route('sedes.index') }}" class="px-8 py-3 text-sm font-bold tracking-widest uppercase transition duration-300 bg-transparent border-2 md:px-10 border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                        Nuestras Sedes
                    </a>
                </div>
            </div>
        </main>
    </div>
    @include('components.ai-assistant')
</body>
</html>
