<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-yellow-400">Crear Nueva Sede</h1>
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('admin.sede.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.sede._form')
            </form>
        </div>
    </div>
</x-app-layout>