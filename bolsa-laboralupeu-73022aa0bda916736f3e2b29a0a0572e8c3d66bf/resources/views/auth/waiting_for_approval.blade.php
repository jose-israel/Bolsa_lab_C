<!-- resources/views/auth/waiting_for_approval.blade.php -->

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md mx-auto animate__animated animate__fadeIn">
            <div class="flex flex-col items-center">
                <!-- Contenedor para la animación de Lottie en la página -->
                <div id="lottie-cat" class="w-60 h-60 mb-4"></div>

                <!-- Título con animación suave -->
                <h1 class="text-2xl font-semibold text-gray-800 mb-2 animate__animated animate__pulse animate__infinite">Esperando Aprobación</h1>

                <!-- Descripción con un mensaje amable -->
                <p class="text-gray-600 text-center mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    Su cuenta está en espera de aprobación por un administrador. Recibirá un correo electrónico cuando su cuenta sea aprobada.
                </p>

                <!-- Botón con animación de hover -->
                <button
                    class="mt-4 px-5 py-2 text-white bg-blue-500 rounded-full shadow-md hover:bg-blue-600 hover:shadow-lg transition duration-300"
                    onclick="window.location.href='/'"> <!-- Añadimos el evento onclick para redirigir a la página principal -->
                    Página Principal
                </button>
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

        // Mostrar SweetAlert con solo texto y sin imagen que se distorsione
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '¡Solicitud Enviada con Éxito!',
                text: 'Tu solicitud ha sido enviada al administrador. Gracias por tu paciencia. Recibirás una notificación cuando sea aprobada.',
                icon: 'success', // Usamos un ícono de éxito en lugar de una imagen
                confirmButtonText: 'Entendido',
                customClass: {
                    popup: 'border-radius-lg' // Estilo personalizado para el popup
                }
            });
        });
    </script>
</x-guest-layout>
