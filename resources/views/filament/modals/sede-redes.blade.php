<div class="space-y-4">
    @if($sede->facebook_url)
        <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20">
            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-200 mb-1">Facebook</p>
                <a href="{{ $sede->facebook_url }}" target="_blank" class="text-sm text-blue-400 hover:text-blue-300 break-all">
                    {{ $sede->facebook_url }}
                </a>
            </div>
            <a href="{{ $sede->facebook_url }}" target="_blank" class="btn-ghost text-sm">
                Visitar →
            </a>
        </div>
    @endif

    @if($sede->instagram_url)
        <div class="flex items-center gap-3 p-4 rounded-xl bg-pink-500/10 border border-pink-500/20">
            <div class="w-12 h-12 rounded-xl bg-pink-500/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-200 mb-1">Instagram</p>
                <a href="{{ $sede->instagram_url }}" target="_blank" class="text-sm text-pink-400 hover:text-pink-300 break-all">
                    {{ $sede->instagram_url }}
                </a>
            </div>
            <a href="{{ $sede->instagram_url }}" target="_blank" class="btn-ghost text-sm">
                Visitar →
            </a>
        </div>
    @endif

    @if(!$sede->facebook_url && !$sede->instagram_url)
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
            </svg>
            <p class="text-gray-400">No hay redes sociales configuradas</p>
        </div>
    @endif
</div>
