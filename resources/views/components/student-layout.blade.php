<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#111827">
    <title>{{ $title ?? 'Instituto Solumne' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-900 text-gray-200 min-h-screen">
    <div class="flex flex-col min-h-screen pb-20 md:pb-0">
        {{-- Header Desktop --}}
        <header class="hidden md:block bg-gray-900/80 backdrop-blur-xl border-b border-gray-800/60 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between h-16 items-center">
                    {{-- Logo --}}
                    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 group">
                        <img src="/images/logo-solumne.png" alt="Solumne" class="h-9 w-auto transition-transform duration-300 group-hover:scale-105">
                    </a>
                    
                    {{-- Nav Desktop --}}
                    <nav class="flex items-center gap-1">
                        <a href="{{ route('student.dashboard') }}" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.dashboard') ? 'bg-gray-800/80 text-yellow-400' : 'text-gray-400 hover:text-gray-200 hover:bg-gray-800/50' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Mis Cursos
                        </a>
                        <a href="{{ route('student.cursos.index') }}" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.cursos.*') || request()->routeIs('student.curso.*') ? 'bg-gray-800/80 text-yellow-400' : 'text-gray-400 hover:text-gray-200 hover:bg-gray-800/50' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Cursos
                        </a>
                        <a href="{{ route('student.invoices.index') }}" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.invoices.*') ? 'bg-gray-800/80 text-yellow-400' : 'text-gray-400 hover:text-gray-200 hover:bg-gray-800/50' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Facturas
                        </a>
                    </nav>
                    
                    {{-- User Menu --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center text-gray-900 font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden lg:block">
                                <p class="text-sm font-medium text-gray-200">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Alumno</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-ghost text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden lg:inline">Salir</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Header Mobile --}}
        <header class="md:hidden bg-gray-900/95 backdrop-blur-xl border-b border-gray-800/60 sticky top-0 z-40">
            <div class="flex justify-between items-center h-14 px-4">
                <a href="{{ route('student.dashboard') }}">
                    <img src="/images/logo-solumne.png" alt="Solumne" class="h-7 w-auto">
                </a>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center text-gray-900 font-bold text-xs">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-1 max-w-7xl w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
        
        {{-- Footer Desktop --}}
        <footer class="hidden md:block border-t border-gray-800/60 mt-auto">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <p class="text-center text-xs text-gray-600">
                    © {{ date('Y') }} Instituto Solumne. Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </div>

    {{-- Bottom Navigation Mobile --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 bg-gray-900/95 backdrop-blur-xl border-t border-gray-800/60 z-50 pb-safe">
        <div class="flex justify-around items-center h-16 max-w-lg mx-auto">
            <a href="{{ route('student.dashboard') }}" 
               class="{{ request()->routeIs('student.dashboard') ? 'nav-bottom-item-active' : 'nav-bottom-item' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] font-medium">Inicio</span>
            </a>
            
            <a href="{{ route('student.cursos.index') }}" 
               class="{{ request()->routeIs('student.cursos.*') || request()->routeIs('student.curso.*') || request()->routeIs('student.leccion.*') ? 'nav-bottom-item-active' : 'nav-bottom-item' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-[10px] font-medium">Cursos</span>
            </a>
            
            <a href="{{ route('student.invoices.index') }}" 
               class="{{ request()->routeIs('student.invoices.*') ? 'nav-bottom-item-active' : 'nav-bottom-item' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-[10px] font-medium">Facturas</span>
            </a>
            
            <a href="{{ route('profile.edit') }}" 
               class="{{ request()->routeIs('profile.*') ? 'nav-bottom-item-active' : 'nav-bottom-item' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-[10px] font-medium">Perfil</span>
            </a>
        </div>
    </nav>
</body>
</html>