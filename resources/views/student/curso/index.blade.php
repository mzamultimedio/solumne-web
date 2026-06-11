<x-student-layout>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                Mis Cursos
            </h1>
            <p class="text-gray-400">
                Explora y continúa con tus cursos activos
            </p>
        </div>

        {{-- Grid de Cursos --}}
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
                <div class="col-span-full glass-card p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-300 mb-2">No tienes cursos asignados</h3>
                    <p class="text-gray-500">Contacta con el administrador para que te asigne cursos.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-student-layout>
