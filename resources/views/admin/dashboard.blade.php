<x-app-layout>
    <div class="space-y-8">
        <div>
            <h1 class="text-3xl font-bold text-yellow-400">Dashboard</h1>
            <p class="mt-1 text-gray-400">Un resumen del estado actual de tu plataforma.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gray-800 rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total de Cursos</p>
                    <p class="text-4xl font-extrabold text-white mt-2">{{ $totalCursos }}</p>
                </div>
                <a href="{{ route('admin.curso.index') }}" class="mt-4 text-sm font-semibold text-yellow-400 hover:text-yellow-300">Ver Cursos &rarr;</a>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total de Módulos</p>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $totalModulos }}</p>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total de Lecciones</p>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $totalLecciones }}</p>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total de Recursos</p>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $totalRecursos }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <h2 class="text-xl font-bold text-gray-200">Acciones Rápidas</h2>
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <a href="{{ route('admin.curso.create') }}" class="block w-full text-center px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300 transition duration-300">
                        + Crear Nuevo Curso
                    </a>
                    </div>
            </div>

            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-200 mb-6">Actividad Reciente</h2>
                <div class="bg-gray-800 rounded-lg shadow-md">
                    <ul class="divide-y divide-gray-700">
                        @forelse ($ultimosCursos as $curso)
                            <li class="p-4 flex justify-between items-center hover:bg-gray-700/50">
                                <div>
                                    <p class="font-semibold text-white">{{ $curso->title }}</p>
                                    <p class="text-sm text-gray-400">Creado {{ $curso->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.curso.edit', $curso) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                            </li>
                        @empty
                            <li class="p-4 text-center text-gray-400">Aún no se han creado cursos.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>