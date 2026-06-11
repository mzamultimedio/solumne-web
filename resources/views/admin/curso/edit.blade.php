<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        {{-- ... (código del encabezado y sesión sin cambios) ... --}}

        <div x-data="{ tab: 'info' }">
            {{-- ... (código de las pestañas sin cambios) ... --}}

            <div class="py-6">
                <div x-show="tab === 'info'">
                    <div class="bg-gray-800 rounded-lg shadow-md p-6">
                        <form action="{{ route('admin.curso.update', $curso) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="space-y-6">
                                <div>
                                    <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Título del Curso</label>
                                    <input type="text" id="title" name="title" value="{{ old('title', $curso->title) }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-bold text-gray-300 mb-2">Descripción</label>
                                    <textarea id="description" name="description" rows="5" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">{{ old('description', $curso->description) }}</textarea>
                                </div>
                                <div>
                                    <label for="image" class="block text-sm font-bold text-gray-300 mb-2">Nueva Imagen de Portada (Opcional)</label>
                                    <input type="file" id="image" name="image" class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-yellow-300 hover:file:bg-gray-600">
                                    @if ($curso->image_path)
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-400">Imagen actual:</p>
                                            <img src="{{ Storage::url($curso->image_path) }}" alt="Imagen actual" class="mt-2 rounded-lg w-48 h-auto">
                                        </div>
                                    @endif
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Actualizar Curso</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div x-show="tab === 'alumnos'" class="space-y-6">
                    {{-- ... (código de inscripción de alumnos sin cambios) ... --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>