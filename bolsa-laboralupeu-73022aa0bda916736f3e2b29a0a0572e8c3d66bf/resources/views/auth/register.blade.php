<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Añadido: Campo para DNI -->
            <div class="mt-4">
                <x-label for="dni" value="{{ __('DNI') }}" />
                <x-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" />
            </div>

            <!-- Añadido: Campo para RUC -->
            <div class="mt-4">
                <x-label for="ruc" value="{{ __('RUC') }}" />
                <x-input id="ruc" class="block mt-1 w-full" type="text" name="ruc" :value="old('ruc')" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Añadido: Campo para Correo Alternativo -->
            <div class="mt-4">
                <x-label for="correo" value="{{ __('Correo Alternativo') }}" />
                <x-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')" />
            </div>

            <!-- Añadido: Campo para Celular -->
            <div class="mt-4">
                <x-label for="celular" value="{{ __('Celular') }}" />
                <x-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular')" />
            </div>

            <!-- Añadido: Selección de Rol -->
            <div class="mt-4">
                <x-label for="rol" value="{{ __('Rol') }}" />
                <select id="rol" name="rol" class="block mt-1 w-full" onchange="toggleCvUploadField()">
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="empresa" {{ old('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                    <option value="postulante" {{ old('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                    <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Añadido: Carga de archivo CV (solo para postulantes) -->
            <div class="mt-4" id="cv-upload" style="display: none;">
                <x-label for="archivo_cv" value="{{ __('Cargar CV (solo para postulantes)') }}" />
                <x-input id="archivo_cv" class="block mt-1 w-full" type="file" name="archivo_cv" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <!-- Script para mostrar u ocultar el campo de carga de CV -->
    <script>
        function toggleCvUploadField() {
            var rol = document.getElementById('rol').value;
            var cvUploadField = document.getElementById('cv-upload');
            if (rol === 'postulante') {
                cvUploadField.style.display = 'block';
            } else {
                cvUploadField.style.display = 'none';
            }
        }

        // Llama a la función al cargar la página para establecer el estado inicial
        document.addEventListener('DOMContentLoaded', function() {
            toggleCvUploadField();
        });
    </script>
</x-guest-layout>
