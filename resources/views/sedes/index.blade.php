<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nuestras Sedes - Instituto Solumne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #111827; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-gray-300">

    <div x-data="{ modalOpen: false, selectedSede: null }">
        <header class="p-6 text-center">
            <a href="{{ route('home') }}">
                <img src="/images/logo-solumne.png" alt="Logo Instituto Solumne" class="w-24 mx-auto">
            </a>
        </header>

        <main class="container mx-auto px-6 py-12">
            <h1 class="text-4xl font-bold text-center text-yellow-400 mb-4 tracking-wider uppercase">Nuestras Sedes</h1>
            <p class="text-lg text-center text-gray-400 max-w-2xl mx-auto mb-12">Conoce los espacios donde formamos a nuestros profesionales.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($sedes as $sede)
                    {{-- LA CORRECCIÓN CLAVE ESTÁ AQUÍ: Usamos un @click simple y directo, sin x-data anidado --}}
                    <div @click='selectedSede = @json($sede); modalOpen = true'
                         class="group relative overflow-hidden rounded-lg shadow-2xl shadow-black/30 cursor-pointer">
                        @if ($sede->image_path)
                            <img src="{{ Storage::url($sede->image_path) }}" alt="Imagen de {{ $sede->name }}" class="w-full h-96 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                            <h2 class="text-2xl font-bold text-white transition-transform duration-300 group-hover:-translate-y-2">{{ $sede->name }}</h2>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-500">No hay sedes para mostrar en este momento.</p>
                @endforelse
            </div>
        </main>

        {{-- MODAL (Sin cambios, ya estaba bien diseñado) --}}
        <div x-show="modalOpen" 
             @click="modalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" 
             x-cloak>
            <div @click.stop
                 x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 class="bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

                <button @click="modalOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-white z-10 p-2 rounded-full hover:bg-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <template x-if="selectedSede">
                    <div class="flex flex-col md:flex-row w-full">
                        <div class="w-full md:w-1/2 flex-shrink-0">
                            <template x-if="selectedSede.image_path">
                                <img :src="selectedSede.image_url" :alt="'Imagen de ' + selectedSede.name" class="w-full h-64 md:h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none">
                            </template>
                            <template x-if="!selectedSede.image_path">
                                <div class="w-full h-64 md:h-full bg-gray-700 flex items-center justify-center rounded-t-lg md:rounded-l-lg md:rounded-t-none">
                                    <span class="text-gray-500">Sin imagen</span>
                                </div>
                            </template>
                        </div>
                        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
                            <h2 class="text-3xl font-bold text-yellow-400 mb-6" x-text="selectedSede.name"></h2>
                            <div class="space-y-4 text-gray-300">
                                <strong class="block text-gray-400 text-sm uppercase tracking-wider mb-2">Redes Sociales</strong>
                                <div class="flex items-center gap-4">
                                    <template x-if="selectedSede.facebook_url && selectedSede.facebook_url.length > 0">
                                        <a :href="selectedSede.facebook_url" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-500 transition-colors" title="Facebook">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                                        </a>
                                    </template>
                                    <template x-if="selectedSede.instagram_url && selectedSede.instagram_url.length > 0">
                                        <a :href="selectedSede.instagram_url" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-pink-500 transition-colors" title="Instagram">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                        </a>
                                    </template>
                                </div>
                                <template x-if="(!selectedSede.facebook_url || selectedSede.facebook_url.length === 0) && (!selectedSede.instagram_url || selectedSede.instagram_url.length === 0)">
                                    <p class="text-gray-500 text-sm">No hay redes sociales disponibles.</p>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
@include('components.ai-assistant')

</body>
</html>
</html>
