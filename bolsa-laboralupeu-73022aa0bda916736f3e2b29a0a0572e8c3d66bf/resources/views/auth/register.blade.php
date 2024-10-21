<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-green-500">
        <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-md w-full mx-auto animate__animated animate__fadeIn">
            <div class="mb-6 text-center">
                <!-- Logo personalizado -->
                <x-authentication-card-logo class="mx-auto w-20 h-20 mb-4" />
                <h1 class="text-3xl font-bold text-gray-900">Crea tu Cuenta</h1>
                <p class="text-gray-600 mt-2">Únete a nuestra bolsa laboral</p>
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nombre Completo -->
                <div class="relative">
                    <x-label for="name" class="text-lg font-semibold text-gray-700" value="{{ __('Nombre Completo') }}" />
                    <x-input id="name" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Ingresa tu nombre completo" />
                </div>

                <!-- DNI (Solo 8 dígitos numéricos) -->
                <div class="relative">
                    <x-label for="dni" class="text-lg font-semibold text-gray-700" value="{{ __('DNI') }}" />
                    <x-input id="dni" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="text" name="dni" :value="old('dni')" required pattern="\d{8}" maxlength="8" title="El DNI debe contener 8 dígitos." placeholder="Documento de Identidad" />
                </div>

                <!-- RUC (Solo 11 dígitos numéricos) -->
                <div class="relative">
                    <x-label for="ruc" class="text-lg font-semibold text-gray-700" value="{{ __('RUC') }}" />
                    <x-input id="ruc" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="text" name="ruc" :value="old('ruc')" required pattern="\d{11}" maxlength="11" title="El RUC debe contener 11 dígitos." placeholder="Registro Único de Contribuyente" />
                </div>

                <!-- Email -->
                <div class="relative">
                    <x-label for="email" class="text-lg font-semibold text-gray-700" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Correo electrónico principal" />
                </div>

                <!-- Correo Alternativo -->
                <div class="relative">
                    <x-label for="correo" class="text-lg font-semibold text-gray-700" value="{{ __('Correo Alternativo') }}" />
                    <x-input id="correo" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="email" name="correo" :value="old('correo')" placeholder="Otro correo electrónico" />
                </div>

                <!-- Celular (Solo 9 dígitos numéricos) -->
                <div class="relative">
                    <x-label for="celular" class="text-lg font-semibold text-gray-700" value="{{ __('Celular') }}" />
                    <x-input id="celular" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="text" name="celular" :value="old('celular')" required pattern="\d{9}" maxlength="9" title="El número de celular debe contener 9 dígitos." placeholder="Número de celular" />
                </div>

                <!-- Rol Selection -->
                <div class="relative">
                    <x-label for="rol" class="text-lg font-semibold text-gray-700" value="{{ __('Rol') }}" />
                    <select id="rol" name="rol" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" onchange="toggleCvUploadField()">
                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="empresa" {{ old('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                        <option value="postulante" {{ old('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                        <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    </select>
                </div>

                <!-- Contraseña -->
                <div class="relative">
                    <x-label for="password" class="text-lg font-semibold text-gray-700" value="{{ __('Contraseña') }}" />
                    <x-input id="password" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="password" name="password" required autocomplete="new-password" placeholder="Crea una contraseña segura" />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="relative">
                    <x-label for="password_confirmation" class="text-lg font-semibold text-gray-700" value="{{ __('Confirmar Contraseña') }}" />
                    <x-input id="password_confirmation" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirma tu contraseña" />
                </div>

                <!-- CV Upload (solo para postulantes) -->
                <div id="cv-upload" style="display: none;">
                    <x-label for="archivo_cv" class="text-lg font-semibold text-gray-700" value="{{ __('Cargar CV (solo para postulantes)') }}" />
                    <x-input id="archivo_cv" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-3 bg-gray-50 text-gray-900" type="file" name="archivo_cv" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-green-600 hover:text-green-900" href="{{ route('login') }}">
                        {{ __('¿Ya tienes cuenta?') }}
                    </a>

                    <x-button class="ml-4 bg-gradient-to-r from-green-500 to-blue-500 text-white hover:from-blue-500 hover:to-green-500">
                        {{ __('Regístrate') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            toggleCvUploadField();
        });
    </script>
</x-guest-layout>
