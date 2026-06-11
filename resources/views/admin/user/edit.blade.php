<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Gestionar Usuario: {{ $user->name }}</h1>

        @if (session('success'))
            <div class="bg-green-800/50 border-green-600 text-green-300 px-4 py-3 rounded-lg"><p>{{ session('success') }}</p></div>
        @endif
         @if ($errors->any())
            <div class="bg-red-800/50 border-red-600 text-red-300 px-4 py-3 rounded-lg">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div x-data="{ tab: 'info' }">
            <div class="border-b border-gray-700">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button @click="tab = 'info'" :class="{ 'border-yellow-400 text-yellow-400': tab === 'info', 'border-transparent text-gray-400 hover:text-gray-200': tab !== 'info' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Información del Usuario
                    </button>
                    <button @click="tab = 'cursos'" :class="{ 'border-yellow-400 text-yellow-400': tab === 'cursos', 'border-transparent text-gray-400 hover:text-gray-200': tab !== 'cursos' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Cursos Asignados ({{ $cursosInscritos->count() }})
                    </button>
                </nav>
            </div>

            <div class="py-6">
                <div x-show="tab === 'info'">
                    <div class="bg-gray-800 rounded-lg shadow-md p-6">
                        <form action="{{ route('admin.user.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Nombre</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-bold text-gray-300 mb-2">Nueva Contraseña</label>
                                    <input type="password" id="password" name="password" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400" placeholder="Dejar en blanco para no cambiar">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-bold text-gray-300 mb-2">Confirmar Nueva Contraseña</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label for="role" class="block text-sm font-bold text-gray-300 mb-2">Rol</label>
                                    <select id="role" name="role" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400" @if(auth()->id() === $user->id) disabled @endif>
                                        <option value="alumno" @selected(old('role', $user->role) == 'alumno')>Alumno</option>
                                        <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                                    </select>
                                    @if(auth()->id() === $user->id)<input type="hidden" name="role" value="{{ $user->role }}">@endif
                                </div>
                            </div>
                            <div class="flex justify-end space-x-4 mt-6">
                                <a href="{{ route('admin.user.index') }}" class="px-6 py-2 border border-gray-600 font-bold rounded-lg hover:bg-gray-700">Cancelar</a>
                                <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Actualizar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div x-show="tab === 'cursos'" class="space-y-6">
                    <div class="bg-gray-800 rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-200 mb-4">Asignar Nuevo Curso</h2>
                        <form action="{{ route('admin.user.enrollCourse', $user) }}" method="POST">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <select name="curso_id" class="flex-1 bg-gray-900 border-gray-700 rounded-lg focus:ring-yellow-400">
                                    <option value="">Selecciona un curso...</option>
                                    @foreach($cursosPotenciales as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-6 py-2 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-300">Asignar</button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-800 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold text-gray-200 p-6">Cursos Actuales</h2>
                        <ul class="divide-y divide-gray-700">
                            @forelse ($cursosInscritos as $curso)
                                <li class="p-4 flex justify-between items-center">
                                    <span>{{ $curso->title }}</span>
                                    <form action="{{ route('admin.user.unenrollCourse', $user) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                                        <button type="submit" class="font-semibold text-red-500 hover:text-red-400 text-sm">Desasignar</button>
                                    </form>
                                </li>
                            @empty
                                <li class="p-4 text-center text-gray-400">Este alumno no está inscrito en ningún curso.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>