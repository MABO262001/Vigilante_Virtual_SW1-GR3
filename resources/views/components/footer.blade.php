<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Mejorado</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .footer-bg {
            background-color: #1E40AF;
        }
        .footer-link {
            transition: color 0.3s ease;
        }
        .footer-link:hover {
            color: #FFFFFF;
        }
        .footer-icon {
            transition: color 0.3s ease;
        }
        .footer-icon:hover {
            color: #FFFFFF;
        }
        .contact-info {
            color: #B0B7C3;
        }
    </style>
    <!-- Import Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Import FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Footer -->
    <footer class="footer-bg text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Clases Virtuales</h3>
                    <p class="text-gray-300">Únete a tus clases desde cualquier lugar, en cualquier momento, con seguridad avanzada.</p>
                </div>
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Navegación</h3>
                    <ul>
                        <li><a href="#" class="text-gray-300 footer-link hover:text-white">Inicio</a></li>
                        <li><a href="#" class="text-gray-300 footer-link hover:text-white">Clases</a></li>
                        <li><a href="#" class="text-gray-300 footer-link hover:text-white">Acerca de</a></li>
                        <li><a href="#" class="text-gray-300 footer-link hover:text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h3 class="text-xl font-bold mb-4">Contacto</h3>
                    <ul>
                        <li class="contact-info">Email: info@clasesvirtuales.com</li>
                        <li class="contact-info">Tel: +591 70605040</li>
                        <li class="mt-4">
                            <a href="#" class="text-gray-300 footer-icon hover:text-white mr-4"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-gray-300 footer-icon hover:text-white mr-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-300 footer-icon hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 text-center">
                <small>&copy; 2024 Clases Virtuales con Detección de IA. Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

</body>
</html>
