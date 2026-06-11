@php use Illuminate\Support\Str; @endphp

<x-student-layout>
    <x-slot name="title">{{ $exam ? 'Examen: ' . $exam->title : 'Examen del módulo' }}</x-slot>

    <div class="animate-fade-in">
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
            <a href="{{ route('student.curso.show', $modulo->curso) }}" class="hover:text-yellow-400 transition-colors truncate max-w-[120px] sm:max-w-[200px]">
                {{ $modulo->curso->title }}
            </a>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-300">Examen</span>
        </nav>

        @if(!$exam)
            <div class="glass-card p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-gray-400 text-lg mb-2">Examen no disponible</p>
                <p class="text-sm text-gray-600">Aún no hay un examen configurado para este módulo.</p>
            </div>
        @else
            <div 
                x-data='{
                    currentStep: 0,
                    totalSteps: {{ $exam->questions->count() }},
                    showReview: false,
                    answers: {},
                    
                    init() {
                        // Cargar respuestas existentes
                        @foreach($exam->questions as $q)
                            this.answers[{{ $q->id }}] = "{{ old('answers.' . $q->id, optional($attempt?->answers?->firstWhere('exam_question_id', $q->id))->answer_text ?? '') }}";
                        @endforeach
                    },
                    
                    nextStep() {
                        if (this.currentStep < this.totalSteps - 1) {
                            this.currentStep++;
                            this.$nextTick(() => this.scrollToTop());
                        }
                    },
                    prevStep() {
                        if (this.currentStep > 0) {
                            this.currentStep--;
                            this.$nextTick(() => this.scrollToTop());
                        }
                    },
                    goToStep(index) {
                        this.currentStep = index;
                        this.showReview = false;
                        this.$nextTick(() => this.scrollToTop());
                    },
                    openReview() {
                        this.showReview = true;
                        this.$nextTick(() => this.scrollToTop());
                    },
                    scrollToTop() {
                        window.scrollTo({ top: 0, behavior: "smooth" });
                    },
                    getAnsweredCount() {
                        return Object.values(this.answers).filter(a => a && a.trim() !== "").length;
                    }
                }'
                class="space-y-6"
            >
                {{-- Header del Examen --}}
                <div class="glass-card overflow-hidden animate-slide-up">
                    <div class="p-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $modulo->title }}</p>
                                <h1 class="text-2xl md:text-3xl font-bold text-white mt-1">{{ $exam->title }}</h1>
                                @if($exam->description)
                                    <p class="text-gray-400 mt-2 text-sm">{{ $exam->description }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-start md:items-end gap-2">
                            @if($exam->due_at)
                                <div class="flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-orange-400 font-medium">{{ $exam->due_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500">{{ $exam->due_at->timezone(config('app.timezone'))->format('d/m/Y H:i') }}</p>
                            @endif
                            
                            @if($attempt)
                                <span class="{{ $attempt->status === 'graded' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $attempt->status === 'graded' ? 'Calificado' : 'Enviado' }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($exam->instructions)
                        <div class="px-6 pb-6">
                            <div class="p-4 bg-gray-800/60 rounded-xl border border-gray-700/50 text-sm text-gray-300 leading-relaxed">
                                {!! $exam->instructions !!}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="glass-card p-4 border-l-4 border-emerald-500 animate-slide-up">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-emerald-300 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(!$exam->is_published)
                    <div class="glass-card p-12 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-lg mb-2">Examen no habilitado</p>
                        <p class="text-sm text-gray-600">El docente aún no ha publicado este examen.</p>
                    </div>
                @elseif($exam->questions->isEmpty())
                    <div class="glass-card p-12 text-center">
                        <p class="text-gray-400">Este examen todavía no tiene preguntas cargadas.</p>
                    </div>
                @elseif($attempt && $attempt->status === 'graded')
                    {{-- Vista de Resultado Calificado --}}
                    <div class="space-y-6 animate-slide-up">
                        <div class="glass-card p-6 border-l-4 border-emerald-500">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h2 class="text-xl font-bold text-emerald-400">Resultado</h2>
                                    <p class="text-3xl font-black text-white mt-2">{{ $attempt->score ?? '—' }}</p>
                                </div>
                                @if($attempt->feedback)
                                    <div class="flex-1 max-w-xl">
                                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Feedback del docente</p>
                                        <p class="text-sm text-gray-300">{!! nl2br(e($attempt->feedback)) !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-200">Tus respuestas</h3>
                            @foreach($exam->questions as $index => $question)
                                @php $answer = $attempt->answers->firstWhere('exam_question_id', $question->id); @endphp
                                <div class="glass-card p-5">
                                    <div class="flex items-start justify-between gap-4 mb-3">
                                        <div>
                                            <span class="text-xs text-gray-500">Pregunta {{ $index + 1 }}</span>
                                            <h4 class="font-medium text-gray-100 mt-0.5">{{ $question->prompt }}</h4>
                                        </div>
                                        <span class="badge {{ optional($answer)->points_awarded !== null ? 'badge-success' : 'badge-neutral' }} shrink-0">
                                            {{ optional($answer)->points_awarded ?? '—' }}/{{ $question->points }}
                                        </span>
                                    </div>
                                    @if($question->description)
                                        <p class="text-xs text-gray-500 mb-3">{{ $question->description }}</p>
                                    @endif
                                    <div class="p-4 bg-gray-800/60 rounded-xl text-sm text-gray-300">
                                        {!! nl2br(e(optional($answer)->answer_text ?? 'Sin respuesta')) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Formulario con Stepper --}}
                    <form action="{{ route('student.modulo.exam.submit', $modulo) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        {{-- Stepper Visual --}}
                        <div class="glass-card p-4 animate-slide-up" style="animation-delay: 0.1s">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-400">Progreso</span>
                                <span class="text-sm font-medium text-yellow-400" x-text="`${getAnsweredCount()}/${totalSteps} respondidas`"></span>
                            </div>
                            <div class="flex gap-1.5 overflow-x-auto pb-2 scrollbar-hide">
                                @foreach($exam->questions as $index => $question)
                                    <button 
                                        type="button"
                                        @click="goToStep({{ $index }})"
                                        :class="{
                                            'bg-yellow-400 text-gray-900': currentStep === {{ $index }},
                                            'bg-emerald-500/30 text-emerald-400 border-emerald-500/50': currentStep !== {{ $index }} && answers[{{ $question->id }}]?.trim(),
                                            'bg-gray-700/50 text-gray-400 hover:bg-gray-700': currentStep !== {{ $index }} && !answers[{{ $question->id }}]?.trim()
                                        }"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium shrink-0 border border-transparent transition-all"
                                    >
                                        {{ $index + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Vista de Revisión --}}
                        <div x-show="showReview" x-cloak class="space-y-4 animate-slide-up">
                            <div class="glass-card p-5">
                                <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Revisión antes de enviar
                                </h3>
                                <div class="space-y-3">
                                    @foreach($exam->questions as $index => $question)
                                        <div class="p-4 bg-gray-800/50 rounded-xl">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs text-gray-500">Pregunta {{ $index + 1 }}</p>
                                                    <p class="text-sm font-medium text-gray-200 mt-0.5">{{ $question->prompt }}</p>
                                                    <p class="text-sm text-gray-400 mt-2 line-clamp-2" x-text="answers[{{ $question->id }}] || '(Sin respuesta)'"></p>
                                                </div>
                                                <button 
                                                    type="button"
                                                    @click="goToStep({{ $index }})"
                                                    class="btn-ghost text-xs shrink-0"
                                                >
                                                    Editar
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                                <button type="button" @click="showReview = false; currentStep = totalSteps - 1" class="btn-secondary">
                                    Volver a editar
                                </button>
                                <button type="submit" class="btn-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    {{ $attempt ? 'Actualizar envío' : 'Enviar examen' }}
                                </button>
                            </div>
                        </div>

                        {{-- Preguntas (una a la vez) --}}
                        <div x-show="!showReview">
                            @foreach($exam->questions as $index => $question)
                                @php
                                    $existingAnswer = $attempt ? optional($attempt->answers->firstWhere('exam_question_id', $question->id))->answer_text : null;
                                    $fieldKey = 'answers.' . $question->id;
                                    $inputName = 'answers[' . $question->id . ']';
                                @endphp
                                <div 
                                    x-show="currentStep === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-x-4"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    class="glass-card p-6 animate-slide-up"
                                >
                                    <div class="flex items-start justify-between gap-4 mb-4">
                                        <div>
                                            <span class="text-xs text-gray-500 uppercase tracking-wider">Pregunta {{ $index + 1 }} de {{ $exam->questions->count() }}</span>
                                            <h3 class="text-lg font-semibold text-gray-100 mt-1">{{ $question->prompt }}</h3>
                                        </div>
                                        <span class="badge-info shrink-0">{{ $question->points }} {{ Str::plural('punto', $question->points) }}</span>
                                    </div>
                                    
                                    @if($question->description)
                                        <p class="text-sm text-gray-500 mb-4">{{ $question->description }}</p>
                                    @endif
                                    
                                    <textarea
                                        name="{{ $inputName }}"
                                        x-model="answers[{{ $question->id }}]"
                                        rows="6"
                                        class="input-modern resize-none"
                                        placeholder="Escribe tu respuesta aquí..."
                                    >{{ old($fieldKey, $existingAnswer) }}</textarea>
                                    
                                    @error($fieldKey)
                                        <p class="text-xs text-red-400 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach

                            {{-- Navegación entre preguntas --}}
                            <div class="flex flex-col sm:flex-row gap-3 justify-between">
                                <button 
                                    type="button"
                                    @click="prevStep()"
                                    x-show="currentStep > 0"
                                    class="btn-secondary order-2 sm:order-1"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Anterior
                                </button>
                                
                                <div class="flex gap-3 order-1 sm:order-2">
                                    <a href="{{ route('student.curso.show', $modulo->curso) }}" class="btn-ghost">
                                        Volver al curso
                                    </a>
                                    
                                    <button 
                                        type="button"
                                        x-show="currentStep < totalSteps - 1"
                                        @click="nextStep()"
                                        class="btn-primary"
                                    >
                                        Siguiente
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                    
                                    <button 
                                        type="button"
                                        x-show="currentStep === totalSteps - 1"
                                        @click="openReview()"
                                        class="btn-primary"
                                    >
                                        Revisar
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        @endif
    </div>
</x-student-layout>
