<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Descargas - Instituto Solumne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #111827;
            background-image: radial-gradient(circle at center, rgba(30, 58, 58, 0.4), transparent 50%);
        }

        /* ====== LÓGICA DE VISIBILIDAD MEJORADA ====== */
        /* 1. Por defecto, el modal está completamente oculto usando su ID. */
        #videoModal {
            display: none;
        }
        
        /* 2. Esta clase se añadirá con JavaScript SÓLO al hacer clic para mostrarlo. */
        #videoModal.es-visible {
            display: flex;
        }
        
        /* ====== CONTROLES DE VIDEO ELEGANTES ====== */
        .video-container {
            position: relative;
            background: linear-gradient(145deg, #1a1a1a, #0f0f0f);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .video-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.03), transparent);
            pointer-events: none;
            z-index: 1;
        }

        #tutorialVideo {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 12px;
        }

        /* Ocultar controles nativos del video */
        #tutorialVideo::-webkit-media-controls {
            display: none !important;
        }

        #tutorialVideo::-moz-media-controls {
            display: none !important;
        }

        #tutorialVideo::-webkit-media-controls-enclosure {
            display: none !important;
        }

        /* Controles personalizados - Responsive */
        .custom-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7), transparent);
            padding: 15px;
            transform: translateY(100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
        }

        /* En desktop: mostrar controles al hover */
        @media (min-width: 768px) {
            .video-container:hover .custom-controls {
                transform: translateY(0);
            }
        }

        /* En móvil: mostrar controles al tocar */
        @media (max-width: 767px) {
            .custom-controls {
                padding: 10px;
            }
            
            .custom-controls.show {
                transform: translateY(0);
            }
            
            .custom-controls.hide {
                transform: translateY(100%);
            }
        }

        .control-button {
            background: rgba(255, 215, 0, 0.2);
            border: 1px solid rgba(255, 215, 0, 0.4);
            border-radius: 8px;
            color: #ffd700;
            padding: 8px 12px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            min-width: 40px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .control-button:hover {
            background: rgba(255, 215, 0, 0.3);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive para controles en móvil */
        @media (max-width: 767px) {
            .control-button {
                padding: 10px;
                min-width: 44px;
                min-height: 44px;
                font-size: 16px;
            }
        }

        .progress-container {
            background: rgba(255, 255, 255, 0.2);
            height: 8px;
            border-radius: 4px;
            margin: 12px 0;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        /* Barra de progreso más gruesa en móvil */
        @media (max-width: 767px) {
            .progress-container {
                height: 12px;
                margin: 15px 0;
            }
        }

        .progress-bar {
            background: linear-gradient(90deg, #ffd700, #ffed4e);
            height: 100%;
            border-radius: 4px;
            transition: width 0.1s ease;
            position: relative;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: #ffd700;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .progress-container:hover .progress-bar::after {
            opacity: 1;
        }

        .time-display {
            color: #ffd700;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        @media (max-width: 767px) {
            .time-display {
                font-size: 14px;
            }
        }

        .volume-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Ocultar control de volumen en móvil */
        @media (max-width: 767px) {
            .volume-control {
                display: none;
            }
        }

        .volume-slider {
            width: 60px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            outline: none;
            -webkit-appearance: none;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 14px;
            height: 14px;
            background: #ffd700;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        /* Layout responsivo para controles */
        .controls-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .controls-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .controls-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 480px) {
            .controls-row {
                flex-direction: column;
                gap: 8px;
            }
            
            .controls-left,
            .controls-right {
                width: 100%;
                justify-content: center;
            }
        }

        /* Loading spinner mejorado */
        .video-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 215, 0, 0.3);
            border-top: 3px solid #ffd700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Botón de play central */
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-container.paused .play-overlay {
            opacity: 1;
        }

        .play-btn-large {
            width: 80px;
            height: 80px;
            background: rgba(255, 215, 0, 0.9);
            border: none;
            border-radius: 50%;
            color: #000;
            font-size: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        }

        .play-btn-large:hover {
            transform: scale(1.1);
            box-shadow: 0 0 40px rgba(255, 215, 0, 0.7);
        }

        /* Efectos de hover en el video */
        .video-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .video-container:hover::after {
            opacity: 1;
        }

        /* ====== FIN DE LA MEJORA ====== */
    </style>
</head>
<body class="overflow-y-auto">

    <main class="relative flex flex-col items-center justify-center min-h-screen p-4 py-10 md:p-8">

        <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 opacity-20">
            <img src="/images/logo-solumne.png" alt="Logo Solumne Fondo" class="w-[60vw] md:w-[50vw] max-w-xl animate-pulse">
        </div>

        <div class="relative z-10 w-full max-w-4xl text-white">
            <h1 class="text-3xl font-light text-center text-yellow-400 md:text-5xl tracking-[0.2em] uppercase mb-4">
                Descargas
            </h1>
            <p class="mb-12 text-lg text-center text-gray-400">
                Herramientas y recursos del Instituto Solumne.
            </p>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <div class="flex flex-col items-center p-6 text-center transition duration-300 bg-gray-500/10 rounded-lg backdrop-blur-sm hover:bg-gray-500/20">
                    <img src="/images/crm-download.png" alt="CRM Icon" class="w-32 h-32 mb-4 object-cover rounded-md">
                    <span class="mb-4 text-xl text-gray-200">Instituto-Solumne-CRM.rar</span>
                    <a href="{{ route('resource.download', ['filename' => 'Instituto-Solumne-CRM.rar']) }}" class="w-full px-6 py-2 mt-auto text-sm font-bold tracking-widest uppercase transition duration-300 border-2 border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                        Descargar
                    </a>
                </div>

                <div class="flex flex-col items-center p-6 text-center transition duration-300 bg-gray-500/10 rounded-lg backdrop-blur-sm hover:bg-gray-500/20">
                    <img src="/images/winrar-64.png" alt="WinRAR x64 Icon" class="w-32 h-32 mb-4 object-cover rounded-md">
                    <span class="mb-4 text-xl text-gray-200">WinRAR (64-bit)</span>
                    <a href="{{ route('resource.download', ['filename' => 'winrar-x64.exe']) }}" class="w-full px-6 py-2 mt-auto text-sm font-bold tracking-widest uppercase transition duration-300 border-2 border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                        Descargar
                    </a>
                </div>

                <div class="flex flex-col items-center p-6 text-center transition duration-300 bg-gray-500/10 rounded-lg backdrop-blur-sm hover:bg-gray-500/20">
                    <img src="/images/winrar-32.png" alt="WinRAR x32 Icon" class="w-32 h-32 mb-4 object-cover rounded-md">
                    <span class="mb-4 text-xl text-gray-200">WinRAR (32-bit)</span>
                    <a href="{{ route('resource.download', ['filename' => 'winrar-x32.exe']) }}" class="w-full px-6 py-2 mt-auto text-sm font-bold tracking-widest uppercase transition duration-300 border-2 border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                        Descargar
                    </a>
                </div>
                
                <div class="flex flex-col items-center p-6 text-center transition duration-300 bg-gray-500/10 rounded-lg backdrop-blur-sm hover:bg-gray-500/20">
                    <img src="/images/play-button.png" alt="Icono de Tutorial" class="w-32 h-32 mb-4 object-cover rounded-md">
                    <span class="mb-4 text-xl text-gray-200">Tutorial (Video)</span>
                    <button id="openModalBtn" class="w-full px-6 py-2 mt-auto text-sm font-bold tracking-widest uppercase transition duration-300 border-2 border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                        Ver Tutorial
                    </button>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="/" class="text-yellow-500 transition duration-300 hover:text-yellow-300">
                    &larr; Volver al inicio
                </a>
            </div>
        </div>
    </main>

    <div id="videoModal" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black bg-opacity-70 backdrop-blur-sm">
        <div class="relative w-full max-w-3xl bg-gray-900/50 border border-gray-700 rounded-lg shadow-2xl">
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <h3 class="text-xl font-light text-yellow-400 tracking-wider">Tutorial CRM Solumne</h3>
                <button id="closeModalBtn" class="text-gray-400 transition hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-4 bg-black">
                <div class="video-container" id="videoContainer">
                    <!-- Loader -->
                    <div id="videoLoader" class="video-loader">
                        <div class="spinner"></div>
                    </div>
                    
                    <!-- Botón de play central -->
                    <div class="play-overlay">
                        <button class="play-btn-large" id="playBtnLarge">▶</button>
                    </div>
                    
                    <!-- Video -->
                    <video id="tutorialVideo" class="w-full h-auto rounded-md" preload="metadata">
                        <source src="{{ route('resource.download', ['filename' => 'tutorial-alejandro.mp4']) }}" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                    
                    <!-- Controles personalizados -->
                    <div class="custom-controls" id="customControls">
                        <div class="controls-row">
                            <div class="controls-left">
                                <button class="control-button" id="playPauseBtn">▶</button>
                                <button class="control-button" id="restartBtn">⟲</button>
                                <div class="volume-control">
                                    <button class="control-button" id="muteBtn">🔊</button>
                                    <input type="range" class="volume-slider" id="volumeSlider" min="0" max="1" step="0.1" value="1">
                                </div>
                            </div>
                            <div class="controls-right">
                                <span class="time-display" id="timeDisplay">00:00 / 00:00</span>
                                <button class="control-button" id="fullscreenBtn">⛶</button>
                            </div>
                        </div>
                        <div class="progress-container" id="progressContainer">
                            <div class="progress-bar" id="progressBar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoModal = document.getElementById('videoModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const tutorialVideo = document.getElementById('tutorialVideo');
        const videoContainer = document.getElementById('videoContainer');
        const videoLoader = document.getElementById('videoLoader');

        // Controles de video
        const playPauseBtn = document.getElementById('playPauseBtn');
        const playBtnLarge = document.getElementById('playBtnLarge');
        const restartBtn = document.getElementById('restartBtn');
        const muteBtn = document.getElementById('muteBtn');
        const volumeSlider = document.getElementById('volumeSlider');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const timeDisplay = document.getElementById('timeDisplay');
        const customControls = document.getElementById('customControls');

        // Variables para controles móviles
        let controlsTimeout;
        let isMobile = window.innerWidth <= 767;

        const openModal = () => {
            videoModal.classList.add('es-visible');
            document.body.style.overflow = 'hidden';
            videoContainer.classList.add('paused');
            isMobile = window.innerWidth <= 767;
        };

        const closeModal = () => {
            videoModal.classList.remove('es-visible');
            document.body.style.overflow = 'auto';
            tutorialVideo.pause();
            tutorialVideo.currentTime = 0;
            videoContainer.classList.add('paused');
            hideControlsMobile();
            updatePlayButton();
        };

        // Funciones para controles móviles
        const showControlsMobile = () => {
            if (isMobile) {
                customControls.classList.remove('hide');
                customControls.classList.add('show');
                clearTimeout(controlsTimeout);
                controlsTimeout = setTimeout(() => {
                    hideControlsMobile();
                }, 3000);
            }
        };

        const hideControlsMobile = () => {
            if (isMobile) {
                customControls.classList.remove('show');
                customControls.classList.add('hide');
            }
        };

        // Detectar toque en móvil para mostrar controles
        const handleVideoTouch = () => {
            if (isMobile) {
                if (customControls.classList.contains('show')) {
                    hideControlsMobile();
                } else {
                    showControlsMobile();
                }
            }
        };

        const togglePlayPause = () => {
            if (tutorialVideo.paused) {
                tutorialVideo.play();
                videoContainer.classList.remove('paused');
            } else {
                tutorialVideo.pause();
                videoContainer.classList.add('paused');
            }
            updatePlayButton();
        };

        const updatePlayButton = () => {
            const symbol = tutorialVideo.paused ? '▶' : '⏸';
            playPauseBtn.textContent = symbol;
            playBtnLarge.textContent = tutorialVideo.paused ? '▶' : '⏸';
        };

        const restartVideo = () => {
            tutorialVideo.currentTime = 0;
        };

        const toggleMute = () => {
            tutorialVideo.muted = !tutorialVideo.muted;
            muteBtn.textContent = tutorialVideo.muted ? '🔇' : '🔊';
            volumeSlider.value = tutorialVideo.muted ? 0 : tutorialVideo.volume;
        };

        const updateVolume = () => {
            tutorialVideo.volume = volumeSlider.value;
            tutorialVideo.muted = volumeSlider.value === '0';
            muteBtn.textContent = tutorialVideo.muted ? '🔇' : '🔊';
        };

        const toggleFullscreen = () => {
            if (!document.fullscreenElement) {
                videoContainer.requestFullscreen().catch(err => {
                    console.log('Error al entrar en pantalla completa:', err);
                });
            } else {
                document.exitFullscreen();
            }
        };

        const updateProgress = () => {
            const progress = (tutorialVideo.currentTime / tutorialVideo.duration) * 100;
            progressBar.style.width = progress + '%';
        };

        const formatTime = (seconds) => {
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        };

        const updateTimeDisplay = () => {
            const current = formatTime(tutorialVideo.currentTime);
            const total = formatTime(tutorialVideo.duration || 0);
            timeDisplay.textContent = `${current} / ${total}`;
        };

        const seekVideo = (e) => {
            const rect = progressContainer.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            tutorialVideo.currentTime = pos * tutorialVideo.duration;
        };

        // Event listeners
        openModalBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        playPauseBtn.addEventListener('click', togglePlayPause);
        playBtnLarge.addEventListener('click', togglePlayPause);
        restartBtn.addEventListener('click', restartVideo);
        muteBtn.addEventListener('click', toggleMute);
        volumeSlider.addEventListener('input', updateVolume);
        fullscreenBtn.addEventListener('click', toggleFullscreen);
        progressContainer.addEventListener('click', seekVideo);

        // Eventos para móvil
        tutorialVideo.addEventListener('touchstart', handleVideoTouch);
        tutorialVideo.addEventListener('click', handleVideoTouch);

        // Mostrar controles al tocar en móvil cuando se reproduce
        tutorialVideo.addEventListener('play', () => {
            if (isMobile && !tutorialVideo.paused) {
                showControlsMobile();
            }
        });

        // Actualizar detección de móvil en resize
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth <= 767;
        });

        // Video events
        tutorialVideo.addEventListener('loadstart', () => {
            videoLoader.style.display = 'block';
        });

        tutorialVideo.addEventListener('canplay', () => {
            videoLoader.style.display = 'none';
        });

        tutorialVideo.addEventListener('waiting', () => {
            videoLoader.style.display = 'block';
        });

        tutorialVideo.addEventListener('playing', () => {
            videoLoader.style.display = 'none';
        });

        tutorialVideo.addEventListener('play', updatePlayButton);
        tutorialVideo.addEventListener('pause', updatePlayButton);
        tutorialVideo.addEventListener('timeupdate', () => {
            updateProgress();
            updateTimeDisplay();
        });

        tutorialVideo.addEventListener('loadedmetadata', updateTimeDisplay);

        // Cerrar modal
        videoModal.addEventListener('click', (event) => {
            if (event.target === videoModal) {
                closeModal();
            }
        });
        
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && videoModal.classList.contains('es-visible')) {
                closeModal();
            }
        });

        // Espaciador para play/pause
        document.addEventListener('keydown', (event) => {
            if (event.code === 'Space' && videoModal.classList.contains('es-visible')) {
                event.preventDefault();
                togglePlayPause();
            }
        });
    </script>

@include('components.ai-assistant')

</body>
</html>
