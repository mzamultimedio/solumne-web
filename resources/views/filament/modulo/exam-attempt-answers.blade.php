<div class="space-y-4">
    <div class="p-4 bg-gray-800 rounded-lg border border-gray-700 text-sm text-gray-200">
        <p class="font-semibold">Alumno: {{ $attempt->user->name }}</p>
        <p class="text-gray-400">Enviado el {{ optional($attempt->submitted_at)->format('d/m/Y H:i') ?? '—' }}</p>
    </div>

    @foreach($attempt->answers()->with('question')->get() as $index => $answer)
        <div class="p-4 bg-gray-900 rounded-lg border border-gray-800 space-y-2">
            <h3 class="font-semibold text-yellow-300">Pregunta {{ $index + 1 }}: {{ $answer->question->prompt }}</h3>
            @if($answer->question->description)
                <p class="text-xs text-gray-500">{{ $answer->question->description }}</p>
            @endif
            <div class="text-sm text-gray-200 leading-relaxed">
                {!! nl2br(e($answer->answer_text ?? 'Sin respuesta')) !!}
            </div>
        </div>
    @endforeach
</div>
