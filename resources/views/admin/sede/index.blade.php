<x-app-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-yellow-400">Gestión de Sedes</h1>
            <a href="{{ route('admin.sede.create') }}" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Crear Sede</a>
        </div>

        @if (session('success'))
            <div class="bg-green-800/50 border-green-600 text-green-300 px-4 py-3 rounded-lg"><p>{{ session('success') }}</p></div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left align-middle">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-bold uppercase text-sm">Imagen</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm">Nombre</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm">Redes</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($sedes as $sede)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($sede->image_path)
                                    <img src="{{ Storage::url($sede->image_path) }}" alt="Logo {{ $sede->name }}" class="h-12 w-12 object-cover rounded-md">
                                @else
                                    <div class="h-12 w-12 bg-gray-700 rounded-md flex items-center justify-center text-xs text-gray-400">Sin foto</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $sede->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    @if ($sede->facebook_url)
                                        <a href="{{ $sede->facebook_url }}" target="_blank" class="text-blue-400 hover:text-blue-300">FB</a>
                                    @endif
                                    @if ($sede->instagram_url)
                                        <a href="{{ $sede->instagram_url }}" target="_blank" class="text-pink-400 hover:text-pink-300">IG</a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center space-x-4">
                                    <a href="{{ route('admin.sede.edit', $sede) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                                    <form action="{{ route('admin.sede.destroy', $sede) }}" method="POST" onsubmit="return confirm('¿Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">No hay sedes creadas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>