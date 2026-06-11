<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <a href="{{ $leccion->modulo ? route('admin.modulo.leccion.index', $leccion->modulo) : '#' }}" class="text-yellow-400 hover:text-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-yellow-400">Recursos de la Lección</h1>
                <p class="text-lg text-gray-400">{{ $leccion->title }}</p>
            </div>
        </div>

        <div class="flex justify-end">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <a href="{{ route('admin.leccion.recurso.create', $leccion) }}" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Subir Recurso</a>
        </div>

        @if (session('success'))
            <div class="bg-green-800/50 border-green-600 text-green-300 px-4 py-3 rounded-lg"><p>{{ session('success') }}</p></div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md">
            <ul class="divide-y divide-gray-700">
                @forelse ($recursos as $recurso)
                    <li class="p-4 flex justify-between items-center">
                        <span class="font-semibold">{{ $recurso->display_name }} <span class="text-xs text-gray-400">({{ $recurso->file_type }})</span></span>
                        {{-- RUTA CORREGIDA AQUÍ --}}
                        <form action="{{ route('admin.recurso.destroy', $recurso) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este recurso?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                        </form>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-400">No hay recursos para esta lección.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>