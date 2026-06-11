<x-student-layout>
    <x-slot name="title">Mis Facturas</x-slot>

    <div class="animate-fade-in">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gradient-gold">Mis Facturas</h1>
                <p class="text-gray-500 text-sm mt-1">Historial de pagos y comprobantes</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="btn-ghost shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a cursos
            </a>
        </div>

        @if ($invoices->isEmpty())
            <div class="glass-card p-12 text-center animate-slide-up">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-gray-400 text-lg mb-2">No hay facturas</p>
                <p class="text-sm text-gray-600">Todavía no tienes facturas emitidas.</p>
            </div>
        @else
            {{-- Resumen --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-6">
                <div class="glass-card p-4 animate-slide-up stagger-1">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-100">{{ $invoices->total() }}</p>
                            <p class="text-xs text-gray-500">Total facturas</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-card p-4 animate-slide-up stagger-2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-100">${{ number_format($invoices->sum('monto_total'), 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500">Total pagado</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-card p-4 animate-slide-up stagger-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-100">{{ $invoices->first()?->fecha_emision?->format('M Y') ?? '—' }}</p>
                            <p class="text-xs text-gray-500">Última factura</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabla Desktop --}}
            <div class="hidden md:block glass-card overflow-hidden animate-slide-up" style="animation-delay: 0.2s">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-700/50 bg-gray-900/50">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">N°</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Concepto</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Cuota</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Monto</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @foreach ($invoices as $invoice)
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-yellow-400">#{{ $invoice->numero }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-300">{{ $invoice->fecha_emision->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-300">{{ $invoice->alumno_curso ?: '—' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($invoice->cuota_nro)
                                            <span class="badge-info">{{ $invoice->cuota_nro }}</span>
                                        @else
                                            <span class="text-gray-500">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-semibold text-emerald-400">${{ number_format($invoice->monto_total, 2, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button 
                                                @click.prevent="window.dispatchEvent(new CustomEvent('open-invoice-modal', { detail: { url: '{{ route('invoices.pdf', $invoice) }}', numero: '{{ $invoice->numero }}' } }))"
                                                class="btn-ghost text-xs"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Ver
                                            </button>
                                            <a href="{{ route('invoices.pdf', [$invoice, 'download' => 1]) }}" class="btn-secondary text-xs">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Descargar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($invoices->hasPages())
                    <div class="px-6 py-4 border-t border-gray-700/50">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>

            {{-- Cards Mobile --}}
            <div class="md:hidden space-y-4">
                @foreach ($invoices as $index => $invoice)
                    <div class="glass-card p-4 animate-slide-up" style="animation-delay: {{ ($index % 5) * 0.05 }}s">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div>
                                <span class="text-lg font-bold text-yellow-400">#{{ $invoice->numero }}</span>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $invoice->fecha_emision->format('d/m/Y') }}</p>
                            </div>
                            <span class="text-lg font-bold text-emerald-400">${{ number_format($invoice->monto_total, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm mb-4">
                            <span class="text-gray-400">{{ $invoice->alumno_curso ?: 'Pago' }}</span>
                            @if($invoice->cuota_nro)
                                <span class="badge-info">Cuota {{ $invoice->cuota_nro }}</span>
                            @endif
                        </div>
                        
                        <div class="flex gap-2">
                            <button 
                                x-data
                                @click="$dispatch('open-mobile-invoice', { url: '{{ route('invoices.pdf', $invoice) }}', numero: '{{ $invoice->numero }}' })"
                                class="flex-1 btn-ghost text-sm justify-center"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Ver
                            </button>
                            <a href="{{ route('invoices.pdf', [$invoice, 'download' => 1]) }}" class="flex-1 btn-secondary text-sm justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Descargar
                            </a>
                        </div>
                    </div>
                @endforeach
                
                @if($invoices->hasPages())
                    <div class="px-2 py-4">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>

    {{-- Modal Global Desktop --}}
    <div 
        x-data="{ open: false, url: '', numero: '' }" 
        x-cloak 
        @open-invoice-modal.window="open = true; url = $event.detail.url; numero = $event.detail.numero"
    >
        <template x-if="open">
            <div 
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 animate-fade-in"
                @keydown.escape.window="open = false"
            >
                <div 
                    class="glass-card w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden animate-scale-in"
                    @click.outside="open = false"
                >
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-700/50">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-200">Factura #<span x-text="numero"></span></span>
                        </div>
                        <button @click="open = false" class="btn-ghost">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cerrar
                        </button>
                    </div>
                    <iframe :src="url" class="flex-1 w-full bg-white"></iframe>
                </div>
            </div>
        </template>
    </div>

    {{-- Modal Mobile --}}
    <div 
        x-data="{ open: false, url: '', numero: '' }" 
        x-cloak 
        @open-mobile-invoice.window="open = true; url = $event.detail.url; numero = $event.detail.numero"
    >
        <template x-if="open">
            <div 
                class="fixed inset-0 z-50 flex items-end bg-black/80 animate-fade-in md:hidden"
                @keydown.escape.window="open = false"
            >
                <div 
                    class="bg-gray-900 w-full h-[90vh] rounded-t-3xl flex flex-col overflow-hidden animate-slide-up"
                    @click.outside="open = false"
                >
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-700/50 shrink-0">
                        <span class="text-sm font-medium text-gray-200">Factura #<span x-text="numero"></span></span>
                        <button @click="open = false" class="p-2 text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <iframe :src="url" class="flex-1 w-full bg-white"></iframe>
                </div>
            </div>
        </template>
    </div>
</x-student-layout>
