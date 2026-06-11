<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Crear Módulo para: <span class="text-gray-300">{{ $curso->title }}</span></h1>

        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <form action="{{ route('admin.curso.modulo.store', $curso) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Título del Módulo</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="w-full bg-gray-900 border border-gray-700 text-gray-200 rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        {{-- RUTA CORREGIDA AQUÍ --}}
                        <a href="{{ route('admin.curso.modulo.index', $curso) }}" class="px-6 py-2 border border-gray-600 text-gray-300 font-bold rounded-lg hover:bg-gray-700 transition duration-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300 transition duration-300">
                            Guardar Módulo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>