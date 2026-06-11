<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Sección 1: Seleccionar Profesor --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-primary-500"/>
                    Paso 1: Seleccionar Profesor
                </div>
            </x-slot>
            
            <x-slot name="headerEnd">
                <span class="text-xs text-gray-500">{{ $this->getProfesores()->count() }} profesor(es)</span>
            </x-slot>

            {{-- Buscador de profesores --}}
            <div class="mb-4">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="searchProfesor"
                    placeholder="🔍 Buscar profesor por nombre o email..."
                    class="w-full md:w-1/2 px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                >
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @forelse($this->getProfesores() as $profesor)
                    <button 
                        wire:click="$set('profesor_id', {{ $profesor->id }})"
                        class="p-4 rounded-lg border-2 transition-all text-left {{ $this->profesor_id == $profesor->id ? 'border-primary-500 bg-primary-500/10 shadow-lg shadow-primary-500/20' : 'border-gray-700 hover:border-gray-500 bg-gray-800/50' }}"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($profesor->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-white truncate">{{ $profesor->name }}</div>
                                <div class="text-xs text-gray-400 truncate">{{ $profesor->email }}</div>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $profesor->teachingCourses()->count() > 0 ? 'bg-green-500/20 text-green-400' : 'bg-gray-600/50 text-gray-400' }}">
                                {{ $profesor->teachingCourses()->count() }} curso(s)
                            </span>
                        </div>
                    </button>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <x-heroicon-o-user-group class="w-12 h-12 mx-auto mb-2 opacity-50"/>
                        <p>No se encontraron profesores</p>
                    </div>
                @endforelse
            </div>
        </x-filament::section>

        @if($this->profesor_id)
            @php
                $profesor = \App\Models\User::find($this->profesor_id);
                $cursosDisponibles = $this->getCursosDisponibles();
                $cursosAsignados = $profesor->teachingCourses()->orderBy('title')->get();
                $stats = $this->getProfesorStats();
            @endphp

            {{-- Estadísticas del Profesor --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="p-4 rounded-lg bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20">
                    <div class="text-2xl font-bold text-blue-400">{{ $stats['cursos'] }}</div>
                    <div class="text-xs text-gray-400">Cursos asignados</div>
                </div>
                <div class="p-4 rounded-lg bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20">
                    <div class="text-2xl font-bold text-green-400">{{ $stats['alumnos'] }}</div>
                    <div class="text-xs text-gray-400">Alumnos accesibles</div>
                </div>
                <div class="p-4 rounded-lg bg-gradient-to-br from-purple-500/10 to-purple-600/5 border border-purple-500/20">
                    <div class="text-2xl font-bold text-purple-400">{{ $stats['modulos'] }}</div>
                    <div class="text-xs text-gray-400">Módulos totales</div>
                </div>
            </div>

            {{-- Sección 2: Cursos Disponibles --}}
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-success-500"/>
                        Paso 2: Asignar Cursos a {{ $profesor->name }}
                    </div>
                </x-slot>

                @if($cursosDisponibles->isEmpty() && !$this->searchCurso)
                    <div class="text-center py-8">
                        <x-heroicon-o-check-badge class="w-12 h-12 mx-auto mb-2 text-green-500"/>
                        <p class="text-gray-400">Todos los cursos ya están asignados a este profesor.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        {{-- Barra de herramientas --}}
                        <div class="flex flex-wrap items-center gap-3">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="searchCurso"
                                placeholder="🔍 Buscar curso..."
                                class="flex-1 min-w-[200px] px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-white placeholder-gray-400 focus:border-primary-500"
                            >
                            
                            <div class="flex gap-2">
                                <button 
                                    wire:click="selectAll"
                                    class="px-3 py-2 text-xs rounded-lg bg-primary-500/20 text-primary-400 hover:bg-primary-500/30 transition-colors"
                                >
                                    Seleccionar todos
                                </button>
                                <button 
                                    wire:click="deselectAll"
                                    class="px-3 py-2 text-xs rounded-lg bg-gray-600/50 text-gray-400 hover:bg-gray-600 transition-colors"
                                >
                                    Deseleccionar
                                </button>
                            </div>
                            
                            <span class="text-xs text-gray-500">
                                {{ count($this->curso_ids) }} seleccionado(s) de {{ $cursosDisponibles->count() }}
                            </span>
                        </div>
                        
                        {{-- Grid de cursos --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-[400px] overflow-y-auto p-1">
                            @forelse($cursosDisponibles as $curso)
                                <label class="flex items-center gap-3 p-3 rounded-lg bg-gray-800/80 hover:bg-gray-700 cursor-pointer transition-colors border border-transparent hover:border-gray-600 {{ in_array((string)$curso->id, $this->curso_ids) ? 'ring-2 ring-primary-500 bg-primary-500/10' : '' }}">
                                    <input 
                                        type="checkbox" 
                                        wire:model.live="curso_ids" 
                                        value="{{ $curso->id }}"
                                        class="rounded border-gray-500 text-primary-500 focus:ring-primary-500"
                                    >
                                    <div class="flex-1 min-w-0">
                                        <span class="text-white text-sm block truncate">{{ $curso->title }}</span>
                                        <span class="text-xs text-gray-500">{{ $curso->modulos()->count() }} módulos</span>
                                    </div>
                                </label>
                            @empty
                                <div class="col-span-full text-center py-4 text-gray-500">
                                    No se encontraron cursos con "{{ $this->searchCurso }}"
                                </div>
                            @endforelse
                        </div>

                        {{-- Botón asignar --}}
                        @if(count($this->curso_ids) > 0)
                            <x-filament::button 
                                wire:click="asignar" 
                                color="success" 
                                icon="heroicon-o-check"
                                size="lg"
                                class="w-full"
                            >
                                <span wire:loading.remove wire:target="asignar">
                                    Asignar {{ count($this->curso_ids) }} Curso(s) Seleccionado(s)
                                </span>
                                <span wire:loading wire:target="asignar">
                                    Asignando...
                                </span>
                            </x-filament::button>
                        @endif
                    </div>
                @endif
            </x-filament::section>

            {{-- Sección 3: Cursos Ya Asignados --}}
            @if($cursosAsignados->isNotEmpty())
                <x-filament::section>
                    <x-slot name="heading">
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-academic-cap class="w-5 h-5 text-green-500"/>
                            Cursos Asignados a {{ $profesor->name }} ({{ $cursosAsignados->count() }})
                        </div>
                    </x-slot>

                    <x-slot name="headerEnd">
                        <button
                            wire:click="quitarTodos"
                            wire:confirm="¿Seguro que deseas quitar TODOS los cursos de {{ $profesor->name }}?"
                            class="text-xs text-red-400 hover:text-red-300 transition-colors"
                        >
                            Quitar todos
                        </button>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                        @foreach($cursosAsignados as $curso)
                            <div class="flex items-center justify-between p-3 bg-green-900/20 border border-green-700/50 rounded-lg group hover:bg-green-900/30 transition-colors">
                                <div class="flex-1 min-w-0">
                                    <span class="text-white text-sm block truncate">{{ $curso->title }}</span>
                                    <span class="text-xs text-gray-500">{{ $curso->alumnos()->count() }} alumnos</span>
                                </div>
                                <button
                                    wire:click="quitarCurso({{ $curso->id }})"
                                    wire:confirm="¿Seguro que deseas quitar '{{ $curso->title }}'?"
                                    class="ml-2 p-1 text-red-400 hover:text-red-300 hover:bg-red-500/20 rounded transition-colors opacity-0 group-hover:opacity-100"
                                >
                                    <x-heroicon-o-x-mark class="w-5 h-5"/>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            @endif
        @else
            {{-- Mensaje cuando no hay profesor seleccionado --}}
            <div class="text-center py-12 text-gray-500">
                <x-heroicon-o-cursor-arrow-rays class="w-16 h-16 mx-auto mb-4 opacity-30"/>
                <p class="text-lg">Selecciona un profesor para ver y asignar cursos</p>
            </div>
        @endif
    </div>
</x-filament-panels::page>
