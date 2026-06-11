<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <a href="{{ route('admin.curso.index') }}" class="text-yellow-400 hover:text-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-yellow-400">Módulos del Curso</h1>
                <p class="text-lg text-gray-400">{{ $curso->title }}</p>
            </div>
        </div>

        <div class="flex justify-end">
             <a href="{{ route('admin.curso.modulo.create', $curso) }}" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300 transition duration-300">
                Crear Nuevo Módulo
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-800/50 border border-green-600 text-green-300 px-4 py-3 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300 tracking-wider">Título del Módulo</th>
                            <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300 tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($modulos as $modulo)
                            <tr class="hover:bg-gray-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $modulo->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end items-center space-x-4">
                                        {{-- TODAS LAS RUTAS DEBEN ESTAR EN SINGULAR --}}
                                        <a href="{{ route('admin.modulo.leccion.index', $modulo) }}" class="px-3 py-1 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-500 text-xs">Gestionar Lecciones</a>
                                        <a href="{{ route('admin.modulo.edit', $modulo) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                                        <form action="{{ route('admin.modulo.destroy', $modulo) }}" method="POST" onsubmit="return confirm('¿Estás seguro? Se eliminarán todas las lecciones de este módulo.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-gray-400">No hay módulos para este curso.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>