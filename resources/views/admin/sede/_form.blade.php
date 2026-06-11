@csrf
<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Nombre de la Sede</label>
        <input type="text" id="name" name="name" value="{{ old('name', $sede->name ?? '') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
    </div>

    <div>
        <label for="image" class="block text-sm font-bold text-gray-300 mb-2">Imagen de la Sede</label>
        <input type="file" id="image" name="image" class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-400 file:text-gray-900 hover:file:bg-yellow-300">
        @isset($sede)
            @if ($sede->image_path)
                <div class="mt-4">
                    <p class="text-sm text-gray-400 mb-2">Imagen actual:</p>
                    <img src="{{ Storage::url($sede->image_path) }}" alt="Imagen actual" class="h-24 w-auto rounded-lg">
                </div>
            @endif
        @endisset
    </div>

    <div>
        <label for="facebook_url" class="block text-sm font-bold text-gray-300 mb-2">URL de Facebook</label>
        <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $sede->facebook_url ?? '') }}" placeholder="https://facebook.com/usuario" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
    </div>
    <div>
        <label for="instagram_url" class="block text-sm font-bold text-gray-300 mb-2">URL de Instagram</label>
        <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $sede->instagram_url ?? '') }}" placeholder="https://instagram.com/usuario" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
    </div>
</div>

@if ($errors->any())
    <div class="text-red-400 text-sm mt-4">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="flex justify-end space-x-4 mt-8">
    <a href="{{ route('admin.sede.index') }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
    <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Guardar Sede</button>
</div>