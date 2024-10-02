<!-- resources/views/usuario/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white border-b border-gray-200">

                    <!-- Formulario de búsqueda -->
                    <div class="mb-4">
                        <form action="{{ route('usuarios.index') }}" method="GET" class="flex items-center space-x-4">
                            <!-- Campo de búsqueda -->
                            <input type="text" name="search" id="search" placeholder="Buscar..." class="w-full border border-gray-300 rounded-md p-2" value="{{ request()->get('search') }}">

                            <!-- Filtro por Rol -->
                            <select name="rol" id="rol" class="border border-gray-300 rounded-md p-2">
                                <option value="">Todos los Roles</option>
                                <option value="admin" {{ request()->get('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="empresa" {{ request()->get('rol') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                                <option value="postulante" {{ request()->get('rol') == 'postulante' ? 'selected' : '' }}>Postulante</option>
                                <option value="supervisor" {{ request()->get('rol') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            </select>

                            <!-- Botón de Búsqueda -->
                            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Buscar
                            </button>
                        </form>
                    </div>

                    <!-- Usar componentes de botón con iconos y contador -->
                    <div class="mb-4 flex space-x-2">
                        <x-buttonusers href="{{ route('usuarios.create') }}" color="bg-green-500" hover="hover:bg-green-600" icon="fas fa-user-plus">
                            Crear Nuevo Usuario
                        </x-buttonusers>

                        <x-buttonusers href="{{ route('usuarios.pending') }}" color="bg-orange-500" hover="hover:bg-orange-600" icon="fas fa-users-cog" :counter="$pendingUsersCount">
                            Usuarios Pendientes
                        </x-buttonusers>
                    </div>

                    <!-- Lista de usuarios en formato de tarjetas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($users as $user)
                        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-4 flex flex-col relative">
                            <!-- Ícono de ojo en la esquina superior derecha -->
                            <x-button-icon
                                icon="fas fa-eye"
                                tooltip="Ver más"
                                classes="absolute top-2 right-2 bg-transparent text-blue-500 hover:text-blue-700"
                                onclick="showModal({{ $user->id }})"
                            />

                            <!-- Foto de perfil -->
                            <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" alt="Foto de {{ $user->name }}" class="w-24 h-24 rounded-full mx-auto mb-4">

                            <!-- Información del usuario -->
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                <p class="text-sm text-gray-500">{{ $user->celular }}</p>
                                <p class="text-sm text-gray-500">{{ $user->rol }}</p>
                            </div>

                            <!-- Botones de acción en la parte inferior -->
                            <div class="flex mt-auto space-x-2 justify-center pt-4">
                                <!-- Botón para editar con un ícono de lápiz -->
                                <x-button-icon
                                    icon="fas fa-edit"
                                    tooltip="Editar"
                                    classes="bg-yellow-500 hover:bg-yellow-700 text-white"
                                    href="{{ route('usuarios.edit', $user->id) }}"
                                />

                                <!-- Botón para eliminar con un ícono de papelera -->
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-icon
                                        icon="fas fa-trash"
                                        tooltip="Eliminar"
                                        classes="bg-red-500 hover:bg-red-700 text-white"
                                        onclick="if(confirm('¿Está seguro de que desea eliminar este usuario?')) { this.closest('form').submit(); }"
                                    />
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Enlaces de paginación -->
                    <div class="mt-4">
                        {{ $users->appends(['search' => request()->get('search')])->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar más información -->
    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900">Información del Usuario</h3>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>
            <div class="mt-4">
                <p><strong>Nombre:</strong> <span id="modalName"></span></p>
                <p><strong>DNI:</strong> <span id="modalDNI"></span></p>
                <p><strong>RUC:</strong> <span id="modalRUC"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Correo Alternativo:</strong> <span id="modalCorreo"></span></p>
                <p><strong>Celular:</strong> <span id="modalCelular"></span></p>
                <p><strong>Rol:</strong> <span id="modalRol"></span></p>
                <p><strong>Archivo CV:</strong> <a href="#" id="modalCV" target="_blank" class="text-blue-500">Ver CV</a></p>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cerrar</button>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // JavaScript para manejar el modal y mostrar la información del usuario
    const users = @json($users);

    function showModal(userId) {
        const user = users.data.find(u => u.id === userId);
        if (user) {
            document.getElementById('modalName').innerText = user.name;
            document.getElementById('modalDNI').innerText = user.dni || 'N/A';
            document.getElementById('modalRUC').innerText = user.ruc || 'N/A';
            document.getElementById('modalEmail').innerText = user.email;
            document.getElementById('modalCorreo').innerText = user.correo || 'N/A';
            document.getElementById('modalCelular').innerText = user.celular || 'N/A';
            document.getElementById('modalRol').innerText = user.rol;
            document.getElementById('modalCV').href = user.archivo_cv ? "{{ asset('storage/') }}" + '/' + user.archivo_cv : '#';
            document.getElementById('modalCV').innerText = user.archivo_cv ? 'Ver CV' : 'No disponible';

            document.getElementById('userModal').classList.remove('hidden');
            document.getElementById('userModal').classList.add('flex');
        }
    }

    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
        document.getElementById('userModal').classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                if (confirm('¿Está seguro de que desea eliminar este usuario?')) {
                    form.submit();
                }
            });
        });
    });
</script>
