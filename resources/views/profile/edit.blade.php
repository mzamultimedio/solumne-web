<x-student-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        {{-- Header --}}
        <div class="animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                Mi Perfil
            </h1>
            <p class="text-gray-400">
                Gestiona tu información personal
            </p>
        </div>

        {{-- Información del Usuario --}}
        <div class="glass-card p-6 md:p-8 animate-slide-up">
            <div class="flex items-center gap-6 mb-8">
                {{-- Avatar --}}
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center text-gray-900 font-bold text-3xl">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                
                {{-- Info --}}
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-400">{{ Auth::user()->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 text-xs font-medium rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                        Alumno
                    </span>
                </div>
            </div>

            {{-- Mensaje Próximamente --}}
            <div class="border-t border-gray-700/50 pt-8">
                <div class="text-center py-12">
                    <svg class="w-20 h-20 mx-auto text-yellow-400/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-200 mb-3">Sección en Desarrollo</h3>
                    <p class="text-gray-400 max-w-md mx-auto mb-6">
                        Estamos trabajando en las opciones de edición de perfil. Pronto podrás actualizar tu información personal, cambiar tu contraseña y personalizar tu experiencia.
                    </p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-yellow-400/10 border border-yellow-400/20 text-yellow-400 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Próximamente disponible
                    </div>
                </div>
            </div>
        </div>

        {{-- Información Adicional --}}
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Cursos Inscritos --}}
            <div class="glass-card p-6 animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-200">Cursos Activos</h3>
                </div>
                <p class="text-3xl font-bold text-white">{{ Auth::user()->cursos->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">Cursos en los que estás inscrito</p>
            </div>

            {{-- Cuenta Creada --}}
            <div class="glass-card p-6 animate-slide-up" style="animation-delay: 0.15s">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-200">Miembro Desde</h3>
                </div>
                <p class="text-3xl font-bold text-white">{{ Auth::user()->created_at->format('Y') }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ Auth::user()->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</x-student-layout>
