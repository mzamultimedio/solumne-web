<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <a href="{{ route('admin.curso.modulo.index', $modulo->curso) }}" class="text-yellow-400 hover:text-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-yellow-400">Lecciones del Módulo</h1>
                <p class="text-lg text-gray-400">{{ $modulo->title }}</p>
            </div>
        </div>

        <div class="flex justify-end">
            {{-- RUTA CORREGIDA AQUÍ --}}
             <a href="{{ route('admin.modulo.leccion.create', $modulo) }}" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300 transition duration-300">
                Crear Nueva Lección
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-800/50 border border-green-600 text-green-300 px-4 py-3 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300">Título</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300">Tipo</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($lecciones as $leccion)
                        <tr class="hover:bg-gray-700/50">
                            <td class="px-6 py-4">{{ $leccion->title }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full {{ $leccion->content_type === 'video' ? 'bg-blue-800 text-blue-200' : 'bg-purple-800 text-purple-200' }}">{{ $leccion->content_type }}</span></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center space-x-4">
                                    {{-- RUTAS CORREGIDAS AQUÍ --}}
                                    <a href="{{ route('admin.leccion.recurso.index', $leccion) }}" class="font-semibold text-teal-400 hover:text-teal-300">Recursos</a>
                                    <a href="{{ route('admin.leccion.edit', $leccion) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                                    <form action="{{ route('admin.leccion.destroy', $leccion) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta lección?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-4 text-center text-gray-400">No hay lecciones para este módulo.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>