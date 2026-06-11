<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Subir Recurso para: <span class="text-gray-300">{{ $leccion->title }}</span></h1>
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            {{-- RUTA CORREGIDA AQUÍ --}}
            <form action="{{ route('admin.leccion.recurso.store', $leccion) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="display_name" class="block text-sm font-bold text-gray-300 mb-2">Nombre a mostrar</label>
                        <input type="text" id="display_name" name="display_name" value="{{ old('display_name') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                        @error('display_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="file" class="block text-sm font-bold text-gray-300 mb-2">Archivo (PDF, JPG, PNG, MP4, MP3... Max: 2GB)</label>
                        <input type="file" id="file" name="file" required class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-400 file:text-gray-900 hover:file:bg-yellow-300">
                        @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex justify-end space-x-4">
                        {{-- RUTA CORREGIDA AQUÍ --}}
                        <a href="{{ route('admin.leccion.recurso.index', $leccion) }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Guardar Recurso</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>