<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-3xl font-bold text-yellow-400">Gestión de Cursos</h1>
            {{-- RUTA CORREGIDA AQUÍ --}}
            <a href="{{ route('admin.curso.create') }}" class="mt-4 md:mt-0 px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300 transition duration-300">
                Crear Nuevo Curso
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
                            <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300 tracking-wider">Título</th>
                            <th class="px-6 py-3 font-bold uppercase text-sm text-gray-300 tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($cursos as $curso)
                            <tr class="hover:bg-gray-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $curso->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end items-center space-x-4">
                                        {{-- RUTAS CORREGIDAS AQUÍ --}}
                                        <a href="{{ route('admin.curso.modulo.index', $curso) }}" class="px-3 py-1 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 text-xs">Gestionar Módulos</a>
                                        <a href="{{ route('admin.curso.edit', $curso) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                                        <form action="{{ route('admin.curso.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este curso?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-gray-400">No hay cursos para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>