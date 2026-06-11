<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento - Instituto Solumne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            background-attachment: fixed;
        }

        .timer-box {
            background: rgba(15, 52, 96, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.2), inset 0 0 30px rgba(59, 130, 246, 0.1);
        }

        .timer-item {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .glow-text {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.8), 0 0 20px rgba(59, 130, 246, 0.4);
        }

        .spinner {
            border: 4px solid rgba(59, 130, 246, 0.2);
            border-top: 4px solid rgba(59, 130, 246, 0.8);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen font-sans text-gray-300">

    <div class="relative z-10 flex flex-col items-center p-8 text-center max-w-2xl mx-auto">

        <!-- Icono de mantenimiento -->
        <div class="mb-8">
            <svg class="w-24 h-24 text-blue-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4v2m0 4v2M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <!-- Título principal -->
        <h1 class="text-5xl md:text-6xl font-black text-blue-400 glow-text mb-4">
            Mantenimiento
        </h1>

        <!-- Subtítulo -->
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">
            Estamos realizando un mantenimiento importante
        </h2>

        <p class="max-w-md mt-4 text-base text-gray-300 mb-8">
            Estamos trabajando para mejorar tu experiencia. Pronto estaremos de vuelta.
        </p>

        <!-- Divisor -->
        <div class="w-20 h-1 bg-gradient-to-r from-transparent via-blue-400 to-transparent my-8"></div>

        <!-- Texto de cuenta atrás -->
        <p class="text-lg text-gray-400 mb-6">
            Estaremos de vuelta en...
        </p>

        <!-- Cronómetro -->
        <div class="timer-box rounded-lg p-8 mb-8 w-full max-w-md">
            <div class="grid grid-cols-4 gap-4">
                <!-- Horas -->
                <div class="timer-item">
                    <div class="bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg p-4 mb-2">
                        <span id="hours" class="text-4xl md:text-5xl font-black text-white glow-text block">
                            00
                        </span>
                    </div>
                    <p class="text-xs md:text-sm uppercase font-bold text-blue-300">Horas</p>
                </div>

                <!-- Separador -->
                <div class="flex items-center justify-center">
                    <span class="text-3xl md:text-4xl font-black text-blue-400 glow-text">:</span>
                </div>

                <!-- Minutos -->
                <div class="timer-item">
                    <div class="bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg p-4 mb-2">
                        <span id="minutes" class="text-4xl md:text-5xl font-black text-white glow-text block">
                            00
                        </span>
                    </div>
                    <p class="text-xs md:text-sm uppercase font-bold text-blue-300">Minutos</p>
                </div>

                <!-- Separador -->
                <div class="flex items-center justify-center">
                    <span class="text-3xl md:text-4xl font-black text-blue-400 glow-text">:</span>
                </div>

                <!-- Segundos -->
                <div class="timer-item">
                    <div class="bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg p-4 mb-2">
                        <span id="seconds" class="text-4xl md:text-5xl font-black text-white glow-text block">
                            00
                        </span>
                    </div>
                    <p class="text-xs md:text-sm uppercase font-bold text-blue-300">Segundos</p>
                </div>
            </div>
        </div>

        <!-- Mensaje de estado -->
        <div class="flex items-center justify-center space-x-3 text-gray-400">
            <div class="spinner"></div>
            <p id="status" class="text-sm md:text-base">Sistema en mantenimiento...</p>
        </div>

    </div>

    <script>
        function updateCountdown() {
            // Obtener fecha y hora actual en Argentina (UTC-3)
            const now = new Date();

            // Convertir a hora de Argentina
            const argentinaTime = new Date(now.toLocaleString('en-US', { timeZone: 'America/Argentina/Buenos_Aires' }));

            // Crear la fecha objetivo: hoy a las 13:20:00
            const targetTime = new Date(argentinaTime);
            targetTime.setHours(13, 20, 0, 0);

            // Si ya pasó las 13:20, la siguiente será mañana
            if (argentinaTime >= targetTime) {
                targetTime.setDate(targetTime.getDate() + 1);
            }

            // Calcular diferencia en milisegundos
            const diff = targetTime - argentinaTime;

            // Si la diferencia es negativa o muy pequeña, mostrar que volvemos pronto
            if (diff <= 0) {
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                document.getElementById('status').textContent = '¡Pronto estaremos en línea!';
                return;
            }

            // Convertir a horas, minutos y segundos
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            // Actualizar display con formato de dos dígitos
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        // Actualizar cada segundo
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>

</body>
</html>
