@php use Illuminate\Support\Str; @endphp

<x-student-layout>
    <x-slot name="title">{{ $leccion->title }}</x-slot>

    @php
        $viewableTypes = ['video', 'image', 'pdf', 'audio'];
        $mediaGallery = collect();
        $allLecciones = $leccion->modulo->lecciones()->orderBy('order')->get();
        $currentIndex = $allLecciones->search(fn($l) => $l->id === $leccion->id);
        $prevLeccion = $currentIndex > 0 ? $allLecciones[$currentIndex - 1] : null;
        $nextLeccion = $currentIndex < $allLecciones->count() - 1 ? $allLecciones[$currentIndex + 1] : null;

        // Video Principal
        if ($leccion->video_url) {
            $rawUrl = $leccion->video_url;
            $driveId = null;
            if (preg_match('#file/d/([\w-]+)#', $rawUrl, $matches)) {
                $driveId = $matches[1];
            } elseif (preg_match('#id=([\w-]+)#', $rawUrl, $matches)) {
                $driveId = $matches[1];
            }
            $isDrive = !is_null($driveId);
            $isYoutube = str_contains($rawUrl, 'youtube.com');

            if ($isYoutube) {
                $videoUrl = 'https://www.youtube.com/embed/' . Str::after($rawUrl, 'v=');
                $thumbnailUrl = 'https://img.youtube.com/vi/' . Str::after($rawUrl, 'v=') . '/mqdefault.jpg';
            } elseif ($isDrive) {
                $videoUrl = sprintf('https://drive.google.com/file/d/%s/preview', $driveId);
                $thumbnailUrl = sprintf('https://drive.google.com/thumbnail?id=%s', $driveId);
            } else {
                $videoUrl = $rawUrl;
                $thumbnailUrl = null;
            }

            $mediaGallery->push([
                'id' => 'video-main',
                'url' => $videoUrl,
                'type' => 'video',
                'name' => 'Video Principal',
                'thumbnail' => $thumbnailUrl,
                'isYoutube' => $isYoutube,
                'isDrive' => $isDrive,
            ]);
        }

        // Recursos
        foreach($leccion->recursos as $recurso) {
            if (in_array($recurso->file_type, $viewableTypes)) {
                $thumbnailUrl = $recurso->file_type === 'image' ? Storage::url($recurso->file_path) : null;
                
                $formattedSize = '';
                $filePath = storage_path('app/public/' . $recurso->file_path);
                if (file_exists($filePath)) {
                    $size = filesize($filePath);
                    if ($size < 1024) $formattedSize = $size . ' B';
                    elseif ($size < 1048576) $formattedSize = round($size/1024, 1) . ' KB';
                    else $formattedSize = round($size/1048576, 1) . ' MB';
                }

                $mediaGallery->push([
                    'id' => 'resource-' . $recurso->id,
                    'url' => Storage::url($recurso->file_path),
                    'type' => $recurso->file_type,
                    'name' => $recurso->display_name,
                    'thumbnail' => $thumbnailUrl,
                    'isYoutube' => false,
                    'isDrive' => false,
                    'size' => $formattedSize
                ]);
            }
        }

        $initialMedia = $mediaGallery->first() ?? ['url' => '', 'type' => 'none', 'name' => 'No hay contenido'];
        $downloadableResources = $leccion->recursos->filter(fn($r) => !in_array($r->file_type, $viewableTypes));
        $isCompleted = Auth::user()->completedLecciones->contains($leccion);
    @endphp

    <div 
        x-data='{
            activeMedia: @json($initialMedia),
            mediaGallery: @json($mediaGallery),
            lightboxOpen: false,
            lightboxImages: [],
            lightboxIndex: 0,
            sidebarOpen: false,

            setActiveMedia(media) {
                this.activeMedia = media;
                if (media.type === "image") {
                    this.lightboxImages = this.mediaGallery.filter(m => m.type === "image");
                    this.lightboxIndex = this.lightboxImages.findIndex(m => m.id === media.id);
                }
            },
            openLightbox() {
                if (this.activeMedia.type === "image") {
                    this.lightboxOpen = true;
                    document.body.style.overflow = "hidden";
                }
            },
            closeLightbox() {
                this.lightboxOpen = false;
                document.body.style.overflow = "";
            },
            nextImage() {
                this.lightboxIndex = (this.lightboxIndex + 1) % this.lightboxImages.length;
                this.setActiveMedia(this.lightboxImages[this.lightboxIndex]);
            },
            prevImage() {
                this.lightboxIndex = (this.lightboxIndex - 1 + this.lightboxImages.length) % this.lightboxImages.length;
                this.setActiveMedia(this.lightboxImages[this.lightboxIndex]);
            },
            getTypeIcon(type) {
                return { video: "🎬", image: "🖼️", pdf: "📄", audio: "🎵" }[type] || "📎";
            }
        }'
        class="animate-fade-in"
    >
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('student.dashboard') }}" class="hover:text-yellow-400 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('student.curso.show', $leccion->modulo->curso) }}" class="hover:text-yellow-400 transition-colors truncate max-w-[120px] sm:max-w-none">
                {{ $leccion->modulo->curso->title }}
            </a>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-300 truncate max-w-[150px]">{{ $leccion->title }}</span>
        </nav>

        <div class="lg:flex lg:gap-6">
            {{-- Sidebar Toggle Mobile --}}
            <button 
                @click="sidebarOpen = !sidebarOpen" 
                class="lg:hidden mb-4 btn-secondary w-full justify-between"
            >
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Lecciones del módulo
                </span>
                <svg class="w-5 h-5 transition-transform" :class="sidebarOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Sidebar - Mini Mapa de Navegación --}}
            <aside 
                class="lg:w-72 shrink-0 mb-6 lg:mb-0"
                :class="sidebarOpen ? 'block' : 'hidden lg:block'"
            >
                <div class="glass-card overflow-hidden sticky top-20">
                    <div class="p-4 border-b border-gray-700/50 bg-gray-900/50">
                        <h3 class="font-semibold text-gray-200 text-sm truncate">{{ $leccion->modulo->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $allLecciones->count() }} lecciones</p>
                    </div>
                    <div class="max-h-[60vh] overflow-y-auto scrollbar-thin">
                        @foreach($allLecciones as $idx => $item)
                            @php $itemCompleted = Auth::user()->completedLecciones->contains($item); @endphp
                            <a 
                                href="{{ route('student.leccion.show', $item) }}" 
                                class="flex items-center gap-3 p-3 border-b border-gray-800/50 transition-colors
                                    {{ $item->id === $leccion->id ? 'bg-yellow-500/10 border-l-2 border-l-yellow-400' : 'hover:bg-gray-800/40' }}"
                            >
                                <div class="shrink-0 w-6 h-6 rounded-md flex items-center justify-center text-xs font-medium
                                    {{ $itemCompleted ? 'bg-emerald-500/20 text-emerald-400' : ($item->id === $leccion->id ? 'bg-yellow-500/20 text-yellow-400' : 'bg-gray-700/50 text-gray-500') }}">
                                    @if($itemCompleted)
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        {{ $idx + 1 }}
                                    @endif
                                </div>
                                <span class="text-sm truncate {{ $item->id === $leccion->id ? 'text-yellow-400 font-medium' : 'text-gray-400' }}">
                                    {{ $item->title }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 min-w-0 space-y-6">
                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gradient-gold">{{ $leccion->title }}</h1>
                        <p class="text-sm text-gray-500 mt-1">Lección {{ $currentIndex + 1 }} de {{ $allLecciones->count() }}</p>
                    </div>
                    @if($isCompleted)
                        <span class="badge-success shrink-0">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Completada
                        </span>
                    @endif
                </div>

                {{-- Visor Principal --}}
                @if($mediaGallery->isNotEmpty())
                    <div class="glass-card overflow-hidden animate-slide-up">
                        <div class="relative bg-black aspect-video flex items-center justify-center">
                            <template x-if="activeMedia.url">
                                <div class="w-full h-full">
                                    {{-- Video YouTube --}}
                                    <template x-if="activeMedia.type === 'video' && activeMedia.isYoutube">
                                        <iframe :src="activeMedia.url" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </template>
                                    {{-- Video Drive --}}
                                    <template x-if="activeMedia.type === 'video' && activeMedia.isDrive">
                                        <iframe :src="activeMedia.url" class="w-full h-full" allow="autoplay" allowfullscreen></iframe>
                                    </template>
                                    {{-- Video Local --}}
                                    <template x-if="activeMedia.type === 'video' && !activeMedia.isYoutube && !activeMedia.isDrive">
                                        <video :src="activeMedia.url" controls class="w-full h-full bg-black"></video>
                                    </template>
                                    {{-- Image --}}
                                    <template x-if="activeMedia.type === 'image'">
                                        <img :src="activeMedia.url" :alt="activeMedia.name" class="max-w-full max-h-full mx-auto cursor-pointer object-contain" @click="openLightbox()">
                                    </template>
                                    {{-- PDF --}}
                                    <template x-if="activeMedia.type === 'pdf'">
                                        <iframe :src="activeMedia.url" class="w-full h-full bg-white"></iframe>
                                    </template>
                                    {{-- Audio --}}
                                    <template x-if="activeMedia.type === 'audio'">
                                        <div class="w-full h-full bg-gradient-to-br from-purple-900/40 to-pink-900/40 flex flex-col items-center justify-center p-8">
                                            <svg class="w-16 h-16 text-purple-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                            </svg>
                                            <p class="text-sm text-gray-400 mb-4" x-text="activeMedia.name"></p>
                                            <audio :src="activeMedia.url" controls class="w-full max-w-md"></audio>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="!activeMedia.url">
                                <p class="text-gray-500">No hay contenido multimedia para mostrar.</p>
                            </template>
                        </div>
                        
                        {{-- Nombre del recurso activo --}}
                        <div class="px-4 py-3 border-t border-gray-700/50 bg-gray-900/50">
                            <p class="text-sm font-medium text-gray-300" x-text="activeMedia.name"></p>
                        </div>
                    </div>

                    {{-- Galería de Recursos --}}
                    @if($mediaGallery->count() > 1)
                        <div class="animate-slide-up" style="animation-delay: 0.1s">
                            <h3 class="text-sm font-medium text-gray-400 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Recursos ({{ $mediaGallery->count() }})
                            </h3>
                            <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                                @foreach($mediaGallery as $index => $media)
                                    <button
                                        @click="setActiveMedia(mediaGallery[{{ $index }}])"
                                        :class="activeMedia.id === '{{ $media['id'] }}' ? 'ring-2 ring-yellow-400 ring-offset-2 ring-offset-gray-900' : 'opacity-70 hover:opacity-100'"
                                        class="shrink-0 w-32 h-20 rounded-xl overflow-hidden transition-all duration-200 group"
                                    >
                                        <div class="w-full h-full bg-gray-800 flex items-center justify-center relative">
                                            @if($media['thumbnail'])
                                                <img src="{{ $media['thumbnail'] }}" alt="{{ $media['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-2xl opacity-50">{{ ['video' => '🎬', 'image' => '🖼️', 'pdf' => '📄', 'audio' => '🎵'][$media['type']] ?? '📎' }}</span>
                                            @endif
                                            <div class="absolute inset-x-0 bottom-0 p-1.5 bg-black/70">
                                                <p class="text-[10px] text-white truncate">{{ $media['name'] }}</p>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Examen del módulo --}}
                @if($exam)
                    <div class="glass-card overflow-hidden animate-slide-up" style="animation-delay: 0.15s">
                        <div class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Examen del módulo</p>
                                    <h3 class="font-semibold text-gray-100 mt-0.5">{{ $exam->title }}</h3>
                                    @if($exam->due_at)
                                        <p class="text-xs text-gray-500 mt-1">
                                            Fecha límite: {{ $exam->due_at->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @php $examStatus = $examAttempt?->status ?? 'pending'; @endphp
                                @if($examAttempt)
                                    <span class="{{ $examStatus === 'graded' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $examStatus === 'graded' ? 'Calificado' : 'Enviado' }}
                                    </span>
                                @endif
                                <a href="{{ route('student.modulo.exam.show', $leccion->modulo) }}" class="btn-primary text-sm">
                                    {{ $examAttempt ? 'Ver examen' : 'Responder' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Contenido de Texto --}}
                @if($leccion->text_content)
                    <div class="glass-card p-6 animate-slide-up" style="animation-delay: 0.2s">
                        <h3 class="font-semibold text-gray-200 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Contenido de la lección
                        </h3>
                        <div class="prose prose-invert prose-sm max-w-none text-gray-300">
                            {!! nl2br(e($leccion->text_content)) !!}
                        </div>
                    </div>
                @endif

                {{-- Recursos Descargables --}}
                @if($downloadableResources->isNotEmpty())
                    <div class="animate-slide-up" style="animation-delay: 0.25s">
                        <h3 class="font-semibold text-gray-200 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Archivos descargables
                        </h3>
                        <div class="grid sm:grid-cols-2 gap-3">
                            @foreach($downloadableResources as $recurso)
                                @php
                                    $filePath = storage_path('app/public/' . $recurso->file_path);
                                    $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                                    $formattedSize = $fileSize < 1024 ? $fileSize . ' B' : ($fileSize < 1048576 ? round($fileSize/1024, 1) . ' KB' : round($fileSize/1048576, 1) . ' MB');
                                @endphp
                                <a href="{{ Storage::url($recurso->file_path) }}" download="{{ $recurso->display_name }}"
                                   class="glass-card-hover p-4 flex items-center gap-3 group">
                                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-200 group-hover:text-yellow-400 transition-colors truncate">{{ $recurso->display_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $formattedSize }}</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-400 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Navegación y Completar --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4 animate-slide-up" style="animation-delay: 0.3s">
                    {{-- Anterior --}}
                    <div class="flex-1">
                        @if($prevLeccion)
                            <a href="{{ route('student.leccion.show', $prevLeccion) }}" class="glass-card-hover p-4 flex items-center gap-3 group h-full">
                                <svg class="w-5 h-5 text-gray-500 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                                </svg>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-500">Anterior</p>
                                    <p class="text-sm font-medium text-gray-300 group-hover:text-yellow-400 transition-colors truncate">{{ $prevLeccion->title }}</p>
                                </div>
                            </a>
                        @endif
                    </div>
                    
                    {{-- Completar --}}
                    <form action="{{ route('student.leccion.complete', $leccion) }}" method="POST" class="shrink-0">
                        @csrf
                        <button type="submit" class="{{ $isCompleted ? 'btn-secondary' : 'btn-primary' }} w-full sm:w-auto">
                            @if($isCompleted)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Desmarcar
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Completar lección
                            @endif
                        </button>
                    </form>
                    
                    {{-- Siguiente --}}
                    <div class="flex-1">
                        @if($nextLeccion)
                            <a href="{{ route('student.leccion.show', $nextLeccion) }}" class="glass-card-hover p-4 flex items-center justify-end gap-3 group h-full">
                                <div class="min-w-0 text-right">
                                    <p class="text-xs text-gray-500">Siguiente</p>
                                    <p class="text-sm font-medium text-gray-300 group-hover:text-yellow-400 transition-colors truncate">{{ $nextLeccion->title }}</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </main>
        </div>

        {{-- Lightbox --}}
        <div x-show="lightboxOpen" x-cloak @click="closeLightbox()" 
             class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <button @click="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <button x-show="lightboxImages.length > 1" @click.stop="prevImage()" class="absolute left-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div @click.stop class="max-w-5xl max-h-[85vh] flex flex-col items-center">
                <img :src="activeMedia.url" :alt="activeMedia.name" class="max-w-full max-h-[75vh] rounded-lg">
                <p class="text-white mt-4 text-center font-medium" x-text="activeMedia.name"></p>
                <p class="text-gray-500 text-sm" x-show="lightboxImages.length > 1" x-text="`${lightboxIndex + 1} / ${lightboxImages.length}`"></p>
            </div>
            <button x-show="lightboxImages.length > 1" @click.stop="nextImage()" class="absolute right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</x-student-layout>
