<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.curso.index') }}" class="text-yellow-400 hover:text-yellow-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h1 class="text-3xl font-bold text-yellow-400">Crear Nuevo Curso</h1>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('admin.curso.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Título del Curso</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-300 mb-2">Descripción</label>
                        <textarea id="description" name="description" rows="5" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-bold text-gray-300 mb-2">Imagen de Portada (Opcional)</label>
                        <input type="file" id="image" name="image" class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-yellow-300 hover:file:bg-gray-600">
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.curso.index') }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Guardar Curso</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>