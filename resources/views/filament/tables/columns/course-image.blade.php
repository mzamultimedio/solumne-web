<div class="px-3 py-2">
    @if($getState())
        <img 
            src="{{ Storage::url($getState()) }}" 
            alt="Portada del curso" 
            class="w-12 h-12 rounded-full object-cover border-2 border-slate-700 shadow-md"
        >
    @else
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg border-2 border-amber-300/30">
            <x-heroicon-o-academic-cap class="w-7 h-7 text-white" />
        </div>
    @endif
</div>
