<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Crear Nuevo Usuario</h1>
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-300 mb-2">Contraseña</label>
                        <input type="password" id="password" name="password" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-300 mb-2">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                    </div>

                    {{-- Lógica para el campo ROL --}}
                    @if(auth()->user()->role === 'admin')
                    <div>
                        <label for="role" class="block text-sm font-bold text-gray-300 mb-2">Rol</label>
                        <select id="role" name="role" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                            <option value="alumno" @selected(old('role') == 'alumno')>Alumno</option>
                            <option value="gestor" @selected(old('role') == 'gestor')>Gestor</option>
                            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                        </select>
                    </div>
                    @else
                        {{-- Para el Gestor, el rol se envía de forma oculta y segura --}}
                        <input type="hidden" name="role" value="alumno">
                    @endif
                </div>
                @if ($errors->any())
                    <div class="text-red-400 text-sm mt-4">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.user.index') }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>