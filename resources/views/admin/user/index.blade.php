<x-app-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            {{-- Título dinámico según el rol --}}
            @if(auth()->user()->role === 'admin')
                <h1 class="text-3xl font-bold text-yellow-400">Gestión de Usuarios</h1>
            @else
                <h1 class="text-3xl font-bold text-yellow-400">Gestión de Alumnos</h1>
            @endif
            
            <a href="{{ route('admin.user.create') }}" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Crear Usuario</a>
        </div>

        @if (session('success'))
            <div class="bg-green-800/50 border-green-600 text-green-300 px-4 py-3 rounded-lg"><p>{{ session('success') }}</p></div>
        @endif
        @if (session('error'))
            <div class="bg-red-800/50 border-red-600 text-red-300 px-4 py-3 rounded-lg"><p>{{ session('error') }}</p></div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-bold uppercase text-sm">Nombre</th>
                        <th class="px-6 py-3 font-bold uppercase text-sm">Email</th>
                        {{-- La columna Rol solo la ve el admin --}}
                        @if(auth()->user()->role === 'admin')
                        <th class="px-6 py-3 font-bold uppercase text-sm">Rol</th>
                        @endif
                        <th class="px-6 py-3 font-bold uppercase text-sm text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            {{-- El dato del rol solo lo ve el admin --}}
                            @if(auth()->user()->role === 'admin')
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-yellow-800 text-yellow-200' : ($user->role === 'gestor' ? 'bg-blue-800 text-blue-200' : 'bg-gray-600 text-gray-200') }}">{{ $user->role }}</span></td>
                            @endif
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center space-x-4">
                                {{-- Las acciones de editar y eliminar solo las ve el admin --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.user.edit', $user) }}" class="font-semibold text-yellow-400 hover:text-yellow-300">Editar</a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-500 hover:text-red-400">Eliminar</button>
                                    </form>
                                    @endif
                                @else
                                    {{-- El gestor no ve acciones --}}
                                    <span class="text-gray-500 text-sm">N/A</span>
                                @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-4 text-center">No hay usuarios para mostrar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginación si es necesaria --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>