<div
    x-data="aiAssistant"
    x-init="init()"
    x-cloak
    class="pointer-events-none fixed bottom-4 right-4 z-50 flex flex-col items-end space-y-3"
>
    {{-- Chat modal --}}
    <div
        x-show="open"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-4 opacity-0 scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 scale-100"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-y-0 opacity-100 scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 scale-95"
        class="pointer-events-auto w-[340px] overflow-hidden rounded-2xl border border-white/10 bg-gray-900/98 shadow-2xl backdrop-blur-xl"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-white/10 bg-gradient-to-r from-yellow-400/15 to-transparent px-4 py-3">
            <div class="flex items-center gap-3">
                <span class="relative flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border border-yellow-400/30 bg-gradient-to-br from-yellow-400/20 to-amber-500/20">
                    <img src="/images/assistant-avatar.png" alt="Sol" class="h-full w-full object-cover" loading="lazy">
                    <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-gray-900 bg-green-400"></span>
                </span>
                <div>
                    <p class="text-sm font-semibold text-white">Sol Asistente Virtual</p>
                    <p class="text-xs text-green-400 flex items-center gap-1">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                        En línea
                    </p>
                </div>
            </div>
            <button @click="open = false" class="rounded-full p-1.5 text-gray-400 transition hover:bg-white/10 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- Messages area --}}
        <div x-ref="messages" class="h-80 space-y-3 overflow-y-auto px-4 py-3 text-sm">
            {{-- Sugerencias rápidas (solo cuando no hay mensajes) --}}
            <template x-if="messages.length === 0">
                <div class="flex flex-col items-center justify-center h-full space-y-4">
                    <p class="text-gray-400 text-center text-xs">¿En qué puedo ayudarte?</p>
                    <div class="flex flex-wrap gap-2 justify-center">
                        <button @click="sendQuickQuestion('¿Cuáles son los cursos disponibles?')" class="px-3 py-2 text-xs bg-yellow-400/10 text-yellow-400 rounded-lg hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                            📚 Cursos
                        </button>
                        <button @click="sendQuickQuestion('¿Cuáles son las sedes?')" class="px-3 py-2 text-xs bg-white/5 text-gray-300 rounded-lg hover:bg-white/10 transition-colors border border-white/10">
                            📍 Sedes
                        </button>
                        <button @click="sendQuickQuestion('¿Cómo me inscribo?')" class="px-3 py-2 text-xs bg-white/5 text-gray-300 rounded-lg hover:bg-white/10 transition-colors border border-white/10">
                            ✏️ Inscripción
                        </button>
                        <button @click="sendQuickQuestion('¿Cuáles son los horarios?')" class="px-3 py-2 text-xs bg-white/5 text-gray-300 rounded-lg hover:bg-white/10 transition-colors border border-white/10">
                            🕐 Horarios
                        </button>
                    </div>
                </div>
            </template>

            {{-- Mensajes --}}
            <template x-for="message in messages" :key="message.id">
                <div
                    class="flex"
                    :class="message.role === 'assistant' ? 'justify-start' : 'justify-end'"
                >
                    <div
                        class="max-w-[85%] rounded-2xl px-3 py-2.5"
                        :class="message.role === 'assistant' ? 'bg-white/5 text-gray-100 border border-white/10' : 'bg-gradient-to-r from-yellow-400 to-amber-500 text-gray-900'"
                    >
                        <p class="leading-relaxed text-sm whitespace-pre-wrap" x-text="message.role === 'assistant' ? (message.animatedText ?? message.text) : message.text"></p>
                    </div>
                </div>
            </template>

            {{-- Loading --}}
            <div x-show="loading" class="flex justify-start">
                <div class="flex items-center gap-2 rounded-2xl bg-white/5 border border-white/10 px-4 py-2.5">
                    <span class="flex gap-1">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-2 h-2 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-2 h-2 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                    </span>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <form @submit.prevent="send" class="border-t border-white/10 bg-gray-800/50 px-4 py-3">
            <div class="flex items-center gap-2">
                <input
                    x-model="input"
                    type="text"
                    placeholder="Escribe tu consulta..."
                    class="flex-1 rounded-xl border border-white/10 bg-gray-800 px-4 py-2.5 text-sm text-gray-100 placeholder-gray-500 focus:border-yellow-400 focus:outline-none focus:ring-1 focus:ring-yellow-400"
                />
                <button
                    type="submit"
                    :disabled="loading || !input.trim()"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-yellow-400 to-amber-500 text-gray-900 transition-all hover:scale-105 disabled:opacity-50 disabled:hover:scale-100"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    {{-- Floating button --}}
    <button
        @click="toggle()"
        class="pointer-events-auto group relative flex h-14 w-14 items-center justify-center"
    >
        <span class="absolute inset-0 rounded-full bg-yellow-400/20 group-hover:bg-yellow-400/30 transition-colors"></span>
        <span class="absolute inset-0 rounded-full border-2 border-yellow-400/40 group-hover:border-yellow-400/60 transition-colors"></span>
        <span class="relative flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 shadow-lg shadow-yellow-400/30">
            <img src="/images/assistant-avatar.png" alt="Sol" class="h-10 w-10 rounded-full border border-white/20 object-cover">
        </span>
        <span class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full border-2 border-gray-900 bg-green-400"></span>
    </button>
</div>
