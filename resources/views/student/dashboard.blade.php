<x-student-layout>
    <x-slot name="title">Mis Cursos</x-slot>

    <div class="space-y-8 animate-fade-in">
        {{-- Header con Saludo --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <p class="text-gray-500 text-sm">¡Bienvenido de vuelta!</p>
                <h1 class="text-3xl md:text-4xl font-bold text-gradient-gold">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </h1>
            </div>
            <div class="flex items-center gap-3">
                @if($stats['progresoGeneral'] > 0)
                    <div class="glass-card px-4 py-2 flex items-center gap-3">
                        <div class="relative w-10 h-10">
                            <svg class="w-10 h-10 transform -rotate-90">
                                <circle cx="20" cy="20" r="16" stroke="currentColor" stroke-width="3" fill="none" class="text-gray-700"/>
                                <circle cx="20" cy="20" r="16" stroke="currentColor" stroke-width="3" fill="none" 
                                        class="text-yellow-400" 
                                        stroke-dasharray="{{ 100.53 }}" 
                                        stroke-dashoffset="{{ 100.53 - (100.53 * $stats['progresoGeneral'] / 100) }}"
                                        stroke-linecap="round"/>
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold text-yellow-400">
                                {{ $stats['progresoGeneral'] }}%
                            </span>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs text-gray-500">Progreso General</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $stats['leccionesCompletadas'] }}/{{ $stats['totalLecciones'] }} lecciones</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="glass-card p-4 animate-slide-up stagger-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-100">{{ $stats['totalCursos'] }}</p>
                        <p class="text-xs text-gray-500">Cursos activos</p>
                    </div>
                </div>
            </div>
            
            <div class="glass-card p-4 animate-slide-up stagger-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-100">{{ $stats['leccionesCompletadas'] }}</p>
                        <p class="text-xs text-gray-500">Completadas</p>
                    </div>
                </div>
            </div>
            
            <div class="glass-card p-4 animate-slide-up stagger-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-100">{{ $stats['totalLecciones'] - $stats['leccionesCompletadas'] }}</p>
                        <p class="text-xs text-gray-500">Por completar</p>
                    </div>
                </div>
            </div>
            
            <div class="glass-card p-4 animate-slide-up stagger-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-100">{{ $stats['progresoGeneral'] }}%</p>
                        <p class="text-xs text-gray-500">Progreso total</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Próximos Exámenes y Facturas --}}
        @if($proximosExamenes->isNotEmpty() || $facturasPendientes->isNotEmpty())
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Próximos Exámenes --}}
                @if($proximosExamenes->isNotEmpty())
                    <div class="glass-card p-5 animate-slide-up">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-200">Próximos Exámenes</h3>
                        </div>
                        <div class="space-y-3">
                            @foreach($proximosExamenes as $examen)
                                <a href="{{ route('student.modulo.exam.show', $examen->modulo) }}" 
                                   class="flex items-center justify-between p-3 rounded-xl bg-gray-800/50 hover:bg-gray-800/80 transition-colors group">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-200 truncate group-hover:text-yellow-400 transition-colors">
                                            {{ $examen->title }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $examen->modulo->curso->title ?? '' }}</p>
                                    </div>
                                    <div class="ml-4 text-right shrink-0">
                                        <p class="text-xs font-medium text-orange-400">
                                            {{ $examen->due_at->diffForHumans() }}
                                        </p>
                                        <p class="text-[10px] text-gray-600">
                                            {{ $examen->due_at->format('d/m H:i') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Últimas Facturas --}}
                @if($facturasPendientes->isNotEmpty())
                    <div class="glass-card p-5 animate-slide-up">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3 class="font-semibold text-gray-200">Últimas Facturas</h3>
                            </div>
                            <a href="{{ route('student.invoices.index') }}" class="text-xs text-yellow-400 hover:text-yellow-300">Ver todas →</a>
                        </div>
                        <div class="space-y-3">
                            @foreach($facturasPendientes as $factura)
                                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-800/50">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-200">#{{ $factura->numero }}</p>
                                        <p class="text-xs text-gray-500">{{ $factura->alumno_curso ?? 'Cuota' }}</p>
                                    </div>
                                    <div class="ml-4 text-right">
                                        <p class="text-sm font-semibold text-emerald-400">${{ number_format($factura->monto_total, 0, ',', '.') }}</p>
                                        <p class="text-[10px] text-gray-600">{{ $factura->fecha_emision->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- Mis Cursos --}}
        <div>
            <h2 class="text-xl font-bold text-gray-100 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Mis Cursos
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cursos as $index => $curso)
                    @php $data = $cursosData[$curso->id] ?? ['progreso' => 0, 'completadas' => 0, 'total' => 0]; @endphp
                    <a href="{{ route('student.curso.show', $curso) }}" 
                       class="glass-card-hover overflow-hidden group animate-slide-up relative h-80"
                       style="animation-delay: {{ ($index % 6) * 0.05 }}s">
                        {{-- Imagen de fondo completa --}}
                        <div class="absolute inset-0">
                            <img src="{{ $curso->image_path ? Storage::url($curso->image_path) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop' }}" 
                                 alt="{{ $curso->title }}" 
                                 class="w-full h-full object-contain bg-gray-900 transition-transform duration-500 group-hover:scale-105">
                        </div>
                        
                        {{-- Gradiente oscuro sobre la imagen --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
                        
                        {{-- Contenido superpuesto --}}
                        <div class="relative h-full flex flex-col justify-between p-5">
                            {{-- Badge de progreso (arriba a la derecha) --}}
                            @if($data['progreso'] > 0)
                                <div class="flex justify-end">
                                    <span class="badge {{ $data['progreso'] == 100 ? 'badge-success' : 'badge-warning' }} backdrop-blur-sm">
                                        @if($data['progreso'] == 100)
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Completado
                                        @else
                                            {{ $data['progreso'] }}%
                                        @endif
                                    </span>
                                </div>
                            @else
                                <div></div>
                            @endif
                            
                            {{-- Contenido inferior --}}
                            <div class="space-y-3">
                                {{-- Título --}}
                                <h3 class="text-xl font-bold text-white group-hover:text-yellow-400 transition-colors line-clamp-2 drop-shadow-lg">
                                    {{ $curso->title }}
                                </h3>
                                
                                {{-- Progress Bar --}}
                                <div>
                                    <div class="flex justify-between text-xs mb-1.5">
                                        <span class="text-gray-300 drop-shadow">Progreso</span>
                                        <span class="text-gray-200 font-medium drop-shadow">{{ $data['completadas'] }}/{{ $data['total'] }}</span>
                                    </div>
                                    <div class="progress-bar backdrop-blur-sm bg-gray-700/50">
                                        <div class="progress-bar-fill" style="width: {{ $data['progreso'] }}%"></div>
                                    </div>
                                </div>
                                
                                {{-- CTA --}}
                                <div class="flex items-center justify-between pt-2">
                                    <span class="text-xs text-gray-300 drop-shadow">{{ $curso->modulos->count() }} módulos</span>
                                    <span class="text-sm font-semibold text-yellow-400 group-hover:translate-x-1 transition-transform inline-flex items-center gap-1 drop-shadow-lg">
                                        Continuar
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 glass-card p-12 text-center animate-fade-in">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-lg mb-2">Aún no estás inscrito en ningún curso</p>
                        <p class="text-sm text-gray-600">Contacta con tu administrador para que te asignen tus cursos.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-student-layout>
