<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Crear Lección en: <span class="text-gray-300">{{ $modulo->title }}</span></h1>
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('admin.modulo.leccion.store', $modulo) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Título de la Lección</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="video_url" class="block text-sm font-bold text-gray-300 mb-2">URL del Video (Opcional)</label>
                        <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="text_content" class="block text-sm font-bold text-gray-300 mb-2">Contenido de Texto (Opcional)</label>
                        <textarea id="text_content" name="text_content" rows="10" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">{{ old('text_content') }}</textarea>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.modulo.leccion.index', $modulo) }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Guardar Lección</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>