<x-filament-widgets::widget>
    <div class="space-y-4">
        <div class="flex items-center gap-2 px-1">
            <x-heroicon-o-bolt class="w-5 h-5 text-yellow-400" />
            <h3 class="text-lg font-bold text-gray-100">Acciones Rápidas</h3>
        </div>
        
        @php
            $user = auth()->user();
            $isAdmin = $user?->role === 'admin';
            $isGestor = $user?->role === 'gestor';
            $isProfesor = $user?->role === 'profesor';
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Nuevo Alumno (solo admin/gestor) --}}
            @if($isAdmin || $isGestor)
            <a href="{{ \App\Filament\Resources\UserResource::getUrl('create') }}" 
               class="group flex flex-col items-center gap-3 p-5 rounded-2xl bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20 hover:border-blue-500/40 hover:from-blue-500/20 hover:to-blue-600/10 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-blue-500/10">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <x-heroicon-o-user-plus class="w-7 h-7 text-blue-400" />
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold text-gray-200 group-hover:text-blue-400 transition-colors">Nuevo Alumno</span>
                    <p class="text-xs text-gray-500 mt-0.5">Crear usuario</p>
                </div>
            </a>
            @endif

            {{-- Nuevo Curso (solo admin) --}}
            @if($isAdmin)
            <a href="{{ \App\Filament\Resources\CursoResource::getUrl('create') }}" 
               class="group flex flex-col items-center gap-3 p-5 rounded-2xl bg-gradient-to-br from-yellow-500/10 to-amber-600/5 border border-yellow-500/20 hover:border-yellow-500/40 hover:from-yellow-500/20 hover:to-amber-600/10 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-yellow-500/10">
                <div class="w-14 h-14 rounded-2xl bg-yellow-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <x-heroicon-o-academic-cap class="w-7 h-7 text-yellow-400" />
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold text-gray-200 group-hover:text-yellow-400 transition-colors">Nuevo Curso</span>
                    <p class="text-xs text-gray-500 mt-0.5">Crear contenido</p>
                </div>
            </a>
            @endif

            {{-- Nueva Factura (solo admin/gestor) --}}
            @if($isAdmin || $isGestor)
            <a href="{{ \App\Filament\Resources\InvoiceResource::getUrl('create') }}" 
               class="group flex flex-col items-center gap-3 p-5 rounded-2xl bg-gradient-to-br from-emerald-500/10 to-green-600/5 border border-emerald-500/20 hover:border-emerald-500/40 hover:from-emerald-500/20 hover:to-green-600/10 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-emerald-500/10">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <x-heroicon-o-document-plus class="w-7 h-7 text-emerald-400" />
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold text-gray-200 group-hover:text-emerald-400 transition-colors">Nueva Factura</span>
                    <p class="text-xs text-gray-500 mt-0.5">Generar cobro</p>
                </div>
            </a>
            @endif

            {{-- Nuevo Módulo (admin y profesor) --}}
            @if($isAdmin || $isProfesor)
            <a href="{{ \App\Filament\Resources\ModuloResource::getUrl('create') }}" 
               class="group flex flex-col items-center gap-3 p-5 rounded-2xl bg-gradient-to-br from-purple-500/10 to-violet-600/5 border border-purple-500/20 hover:border-purple-500/40 hover:from-purple-500/20 hover:to-violet-600/10 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-purple-500/10">
                <div class="w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <x-heroicon-o-rectangle-stack class="w-7 h-7 text-purple-400" />
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold text-gray-200 group-hover:text-purple-400 transition-colors">Nuevo Módulo</span>
                    <p class="text-xs text-gray-500 mt-0.5">Agregar contenido</p>
                </div>
            </a>
            @endif

            {{-- Ir a Mis Cursos (solo profesor) --}}
            @if($isProfesor)
            <a href="{{ \App\Filament\Resources\CursoResource::getUrl('index') }}" 
               class="group flex flex-col items-center gap-3 p-5 rounded-2xl bg-gradient-to-br from-yellow-500/10 to-amber-600/5 border border-yellow-500/20 hover:border-yellow-500/40 hover:from-yellow-500/20 hover:to-amber-600/10 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-yellow-500/10">
                <div class="w-14 h-14 rounded-2xl bg-yellow-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <x-heroicon-o-academic-cap class="w-7 h-7 text-yellow-400" />
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold text-gray-200 group-hover:text-yellow-400 transition-colors">Mis Cursos</span>
                    <p class="text-xs text-gray-500 mt-0.5">Ver y gestionar</p>
                </div>
            </a>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
