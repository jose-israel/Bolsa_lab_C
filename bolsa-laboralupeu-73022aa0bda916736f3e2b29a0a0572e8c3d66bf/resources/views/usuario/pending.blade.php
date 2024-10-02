<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios Pendientes de Aprobación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <!-- Lista de usuarios pendientes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($users as $user)
                    <div class="bg-white border border-gray-200 shadow-md rounded-lg p-4 flex flex-col">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500">{{ $user->rol }}</p>
                        </div>

                        <!-- Botón para aprobar usuario -->
                        <div class="flex mt-auto space-x-2 justify-center pt-4">
                            <form action="{{ route('usuarios.approve', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    Aprobar
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Enlaces de paginación -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
