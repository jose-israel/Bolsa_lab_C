<!-- resources/views/usuario/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">

                <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-input w-full @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- DNI -->
                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 text-sm font-bold mb-2">DNI:</label>
                        <input type="text" name="dni" id="dni" value="{{ old('dni', $user->dni) }}" class="form-input w-full @error('dni') border-red-500 @enderror">
                        @error('dni')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- RUC -->
                    <div class="mb-4">
                        <label for="ruc" class="block text-gray-700 text-sm font-bold mb-2">RUC:</label>
                        <input type="text" name="ruc" id="ruc" value="{{ old('ruc', $user->ruc) }}" class="form-input w-full @error('ruc') border-red-500 @enderror">
                        @error('ruc')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input w-full @error('email') border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Correo Alternativo -->
                    <div class="mb-4">
                        <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Alternativo:</label>
                        <input type="email" name="correo" id="correo" value="{{ old('correo', $user->correo) }}" class="form-input w-full @error('correo') border-red-500 @enderror">
                        @error('correo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Celular -->
                    <div class="mb-4">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular:</label>
                        <input type="text" name="celular" id="celular" value="{{ old('celular', $user->celular) }}" class="form-input w-full @error('celular') border-red-500 @enderror">
                        @error('celular')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Rol -->
                    <div class="mb-4">
                        <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
                        <select name="rol" id="rol" class="form-input w-full @error('rol') border-red-500 @enderror">
                            <option value="admin" {{ old('rol', $user->rol) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="empresa" {{ old('rol', $user->rol) == 'empresa' ? 'selected' : '' }}>Empresa</option>
                            <option value="postulante" {{ old('rol', $user->rol) == 'postulante' ? 'selected' : '' }}>Postulante</option>
                            <option value="supervisor" {{ old('rol', $user->rol) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        </select>
                        @error('rol')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Archivo CV -->
                    <div class="mb-4">
                        <label for="archivo_cv" class="block text-gray-700 text-sm font-bold mb-2">Archivo CV:</label>
                        <input type="file" name="archivo_cv" id="archivo_cv" class="form-input w-full @error('archivo_cv') border-red-500 @enderror">
                        @error('archivo_cv')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto de Perfil -->
                    <div class="mb-4">
                        <label for="profile_photo" class="block text-gray-700 text-sm font-bold mb-2">Foto de Perfil:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-input w-full @error('profile_photo') border-red-500 @enderror">
                        @error('profile_photo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botón de Envío -->
                    <div class="flex items-center justify-end">
                        <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar alerta de SweetAlert2 si hay un mensaje de éxito en la sesión
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
