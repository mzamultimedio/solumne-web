@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Str;
@endphp

<x-student-layout>
    <x-slot name="title">{{ $curso->title }}</x-slot>

    <div class="space-y-8 animate-fade-in">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('student.dashboard') }}" class="hover:text-yellow-400 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Mis Cursos
            </a>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-300">{{ Str::limit($curso->title, 40) }}</span>
        </nav>

        {{-- Hero del Curso --}}
        <div class="glass-card overflow-hidden animate-slide-up">
            <div class="relative h-48 md:h-64">
                <img src="{{ $curso->image_path ? Storage::url($curso->image_path) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&h=400&fit=crop' }}" 
                     alt="{{ $curso->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-end p-6 md:p-8">
                    <div class="max-w-2xl">
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $curso->title }}</h1>
                        @if($curso->description)
                            <p class="text-gray-300 text-sm md:text-base line-clamp-2">{{ $curso->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Progress Bar --}}
            <div class="p-5 border-t border-gray-700/50 bg-gray-900/50">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-300">Tu progreso</span>
                    <span class="text-sm font-bold text-yellow-400">{{ round($progreso) }}%</span>
                </div>
                <div class="progress-bar h-3">
                    <div class="progress-bar-fill" style="width: {{ round($progreso) }}%"></div>
                </div>
            </div>
        </div>

        {{-- Aviso de liberación gradual --}}
        @if($usaAsignaciones)
            <div class="glass-card p-4 border-l-4 border-yellow-500/60 animate-slide-up">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-yellow-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-yellow-300">Liberación gradual activa</p>
                        <p class="text-xs text-gray-400 mt-1">Tu institución habilita cada módulo según tu plan de pagos. Verás qué módulos están disponibles y cuáles se habilitarán próximamente.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Módulos (Timeline Style) --}}
        <div class="space-y-4" x-data="{ openModule: {{ $modulosVisibles->first()?->id ?? 'null' }} }">
            <h2 class="text-lg font-semibold text-gray-200 flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Contenido del curso
                <span class="text-sm font-normal text-gray-500">({{ $modulosVisibles->count() }} módulos)</span>
            </h2>

            @foreach($modulosVisibles as $index => $modulo)
                @php
                    $exam = $modulo->exam;
                    $attempt = $examAttempts[$modulo->id] ?? null;
                    $status = $attempt?->status ?? null;
                    $accessStatus = $modulo->getAttribute('access_status');
                    $leccionesTotales = $modulo->lecciones->count();
                    $leccionesCompletadas = $modulo->lecciones->filter(fn($l) => $leccionesCompletadasIds->contains($l->id))->count();
                    $moduloProgreso = $leccionesTotales > 0 ? round(($leccionesCompletadas / $leccionesTotales) * 100) : 0;
                @endphp
                
                <div class="glass-card overflow-hidden animate-slide-up" style="animation-delay: {{ $index * 0.05 }}s">
                    {{-- Header del Módulo --}}
                    <button 
                        @click="openModule = (openModule === {{ $modulo->id }} ? null : {{ $modulo->id }})"
                        class="w-full text-left p-5 flex items-start gap-4 hover:bg-gray-800/30 transition-colors"
                    >
                        {{-- Número/Estado del Módulo --}}
                        <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm
                            {{ $moduloProgreso == 100 ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            @if($moduloProgreso == 100)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <h3 class="font-semibold text-gray-100 group-hover:text-yellow-400 transition-colors">
                                        {{ $modulo->title }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $leccionesTotales }} lecciones · {{ $leccionesCompletadas }} completadas
                                    </p>
                                </div>
                                
                                {{-- Progress Circle Mini --}}
                                <div class="shrink-0 flex items-center gap-3">
                                    @if($usaAsignaciones)
                                        @php
                                            $badgeClass = match($accessStatus) {
                                                'unlocked' => 'badge-success',
                                                'scheduled' => 'badge-info',
                                                'expired' => 'badge-warning',
                                                'revoked' => 'badge-error',
                                                default => 'badge-neutral',
                                            };
                                            $badgeLabel = match($accessStatus) {
                                                'unlocked' => 'Disponible',
                                                'scheduled' => 'Programado',
                                                'expired' => 'Finalizado',
                                                'revoked' => 'Revocado',
                                                default => 'Pendiente',
                                            };
                                        @endphp
                                        <span class="{{ $badgeClass }}">{{ $badgeLabel }}</span>
                                    @endif
                                    
                                    <div class="hidden sm:flex items-center gap-2">
                                        <div class="w-20 progress-bar">
                                            <div class="progress-bar-fill" style="width: {{ $moduloProgreso }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-500 w-8">{{ $moduloProgreso }}%</span>
                                    </div>
                                    
                                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" 
                                         :class="openModule === {{ $modulo->id }} ? 'rotate-180' : ''"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </button>
                    
                    {{-- Contenido Expandible --}}
                    <div x-show="openModule === {{ $modulo->id }}" 
                         x-collapse
                         class="border-t border-gray-700/50">
                        
                        {{-- Lista de Lecciones --}}
                        <div class="divide-y divide-gray-800/50">
                            @foreach($modulo->lecciones as $leccion)
                                @php $completed = $leccionesCompletadasIds->contains($leccion->id); @endphp
                                <a href="{{ route('student.leccion.show', $leccion) }}" 
                                   class="flex items-center gap-4 p-4 hover:bg-gray-800/40 transition-colors group">
                                    
                                    {{-- Check Icon --}}
                                    <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center
                                        {{ $completed ? 'bg-emerald-500/20 text-emerald-400' : 'bg-gray-700/50 text-gray-500' }}">
                                        @if($completed)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    
                                    {{-- Title --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-200 group-hover:text-yellow-400 transition-colors truncate">
                                            {{ $leccion->title }}
                                        </p>
                                    </div>
                                    
                                    {{-- Arrow --}}
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-yellow-400 group-hover:translate-x-1 transition-all" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                        
                        {{-- Examen del Módulo --}}
                        @if($exam)
                            <div class="p-5 bg-gray-900/60 border-t border-gray-700/50">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-200">{{ $exam->title }}</p>
                                            @if($exam->due_at)
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    Fecha límite: {{ $exam->due_at->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        @if($status)
                                            <span class="{{ $status === 'graded' ? 'badge-success' : 'badge-warning' }}">
                                                {{ $status === 'graded' ? 'Calificado' : 'Enviado' }}
                                            </span>
                                        @endif
                                        
                                        @if(!$exam->is_published)
                                            <span class="badge-neutral">No publicado</span>
                                        @elseif($attempt)
                                            <a href="{{ route('student.modulo.exam.show', $modulo) }}" class="btn-secondary text-sm">
                                                Ver {{ $status === 'graded' ? 'resultado' : 'envío' }}
                                            </a>
                                        @else
                                            <a href="{{ route('student.modulo.exam.show', $modulo) }}" class="btn-primary text-sm">
                                                Responder examen
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Módulos Bloqueados --}}
        @if($usaAsignaciones && $modulosBloqueados->isNotEmpty())
            <div class="glass-card overflow-hidden animate-slide-up">
                <div class="p-5 border-b border-gray-700/50 bg-gray-900/40">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-300">Próximos módulos</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Se habilitarán cuando completes el pago correspondiente</p>
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-gray-800/50">
                    @foreach($modulosBloqueados as $modulo)
                        @php
                            $availableFrom = $modulo->getAttribute('access_available_from');
                        @endphp
                        <div class="p-4 flex items-center justify-between opacity-60">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-700/50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-400">{{ $modulo->title }}</p>
                                    @if($availableFrom instanceof Carbon)
                                        <p class="text-xs text-gray-600">Disponible desde {{ $availableFrom->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                            </div>
                            <span class="badge-neutral">Bloqueado</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($modulosVisibles->isEmpty())
            <div class="glass-card p-12 text-center animate-fade-in">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <p class="text-gray-400 text-lg mb-2">Aún no tienes módulos asignados</p>
                <p class="text-sm text-gray-600">Contacta a tu asesor para habilitar el contenido de este curso.</p>
            </div>
        @endif
    </div>
</x-student-layout>
