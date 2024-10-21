<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-blue-600">
        <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-md w-full mx-auto animate__animated animate__fadeIn">
            <div class="mb-6 text-center">
                <x-authentication-card-logo class="mx-auto w-20 h-20 mb-4" />
                <h1 class="text-3xl font-bold text-gray-900">Iniciar Sesión</h1>
                <p class="text-gray-600 mt-2">Accede a tu cuenta de la Bolsa Laboral</p>
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Input -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500 focus:border-green-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <!-- Forgot Password Link -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-green-600 hover:text-green-800 transition duration-200" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-3 text-lg text-white font-semibold bg-gradient-to-r from-green-500 to-blue-500 rounded-full shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-green-500 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </div>
            </form>

            <!-- Sign up Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-semibold transition duration-200">
                        Regístrate aquí
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
