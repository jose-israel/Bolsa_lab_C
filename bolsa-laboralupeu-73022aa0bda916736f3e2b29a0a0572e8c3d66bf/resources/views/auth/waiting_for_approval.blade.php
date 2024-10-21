<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-600">
        <div class="bg-white shadow-lg rounded-xl p-10 max-w-lg mx-auto animate__animated animate__fadeIn lg:max-w-md md:max-w-sm sm:max-w-xs">
            <div class="flex flex-col items-center">
                <!-- Contenedor para la animación de Lottie en la página -->
                <div id="lottie-cat" class="w-48 h-48 mb-6"></div>

                <!-- Título con animación moderna -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4 text-center animate__animated animate__pulse animate__infinite">
                    Cuenta en Revisión
                </h1>

                <!-- Descripción con estilo y mejor tipografía -->
                <p class="text-gray-700 text-lg text-center mb-6 animate__animated animate__fadeInUp animate__delay-1s">
                    Su cuenta está siendo revisada por un administrador. Le notificaremos por correo electrónico cuando su cuenta sea aprobada.
                </p>

                <!-- Botón redirigiendo a la página principal con estilo moderno -->
                <button
                    class="mt-6 px-6 py-3 text-lg text-white font-semibold bg-gradient-to-r from-blue-500 to-purple-500 rounded-full shadow-lg hover:shadow-2xl hover:from-purple-500 hover:to-blue-500 transition duration-300 transform hover:-translate-y-1 hover:scale-105"
                    onclick="window.location.href='/'">
                    Ir a la Página Principal
                </button>

                <!-- Botón de salir -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="mt-6 px-6 py-3 text-lg text-white font-semibold bg-gradient-to-r from-red-500 to-red-600 rounded-full shadow-lg hover:shadow-2xl hover:from-red-600 hover:to-red-700 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                        {{ __('Salir') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts para Lottie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <script>
        // Inicializar la animación Lottie en la página
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-cat'), // ID del contenedor donde se reproducirá la animación
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://lottie.host/90632b3b-ff89-4301-a176-5a3e9fc1d1cb/lACFg6qLwi.json' // Ruta al archivo JSON de la animación proporcionada
        });

        // Mostrar SweetAlert con estilo moderno
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '¡Solicitud Enviada!',
                text: 'Gracias por tu paciencia. Te notificaremos cuando tu cuenta sea aprobada.',
                icon: 'success', // Usamos un ícono de éxito
                confirmButtonText: 'Entendido',
                customClass: {
                    popup: 'rounded-xl' // Estilo personalizado para el popup
                }
            });
        });
    </script>
</x-guest-layout>
