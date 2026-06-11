<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-800 border-gray-600 text-gray-200 focus:ring-yellow-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" class="text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-800 border-gray-600 text-gray-200 focus:ring-yellow-400"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 bg-gray-800 text-yellow-400 shadow-sm focus:ring-yellow-400" name="remember">
                <span class="ms-2 text-sm text-gray-400">Recordar sesión</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <x-primary-button class="ms-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900">
                Acceder
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>