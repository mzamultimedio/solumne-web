<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-300">
        <div class="flex h-screen">
            <aside class="w-64 bg-gray-800 p-6 flex flex-col justify-between">
                <div>
                    <a href="{{ route('home') }}" class="block mb-10">
                        <img src="/images/logo-solumne.png" alt="Logo Instituto Solumne" class="w-24 mx-auto">
                    </a>

                    <nav class="flex flex-col space-y-2">
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.curso.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.curso.*') ? 'text-yellow-400 bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-yellow-400' }}">
                            <span class="font-bold">Cursos</span>
                        </a>
                        {{-- AÑADIMOS EL NUEVO ENLACE AQUÍ --}}
                        <a href="{{ route('admin.sede.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.sede.*') ? 'text-yellow-400 bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-yellow-400' }}">
                            <span class="font-bold">Sedes</span>
                        </a>
                        @endif

                        <a href="{{ route('admin.user.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.user.*') ? 'text-yellow-400 bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-yellow-400' }}">
                            <span class="font-bold">Usuarios</span>
                        </a>
                    </nav>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-400 hover:bg-gray-700 hover:text-yellow-400 rounded-lg">
                        Cerrar Sesión
                    </button>
                </form>
            </aside>

            <main class="flex-1 flex flex-col">
                <header class="bg-gray-800 border-b border-gray-700 p-6 flex justify-end">
                    <div class="text-right">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-400">{{ Auth::user()->role }}</p>
                    </div>
                </header>

                <div class="flex-1 p-6 md:p-8 overflow-y-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>