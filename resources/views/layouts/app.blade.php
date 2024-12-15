<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite('resources/css/common-styles/general-styles.css')
    @vite('resources/css/common-styles/generator-form-styles.css')
    @vite('resources/css/common-styles/styles.css')
    @vite('resources/css/common-styles/buttons.css')
    @vite('resources/css/common-styles/general-styles.css')
    @vite('resources/css/common-styles/typography.css')
    @vite('resources/css/common-styles/color-palette.css')



    <!--Unico agregado diferente que esta presente solo en create-group.html -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!---->

    <!-- PARA TAILWIND -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">


    <!-- PARA ICONOGRÁFIA -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMiSzw7Z3pObi/8/vZlJ/4xguZ5/AW/cHzD7ntg" crossorigin="anonymous">

    <!-- PARA TIPOGRAFIA -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>
    @if (!Auth::check())
        <header id="header" class="container-fluid">
            <a href="#" class="logo">
                <img src="{{ asset('images/logoDeSedipro.svg') }}" alt="Logo de SEDIPRO">
            </a>
            <div class="button-container">
                <a href="/register.html" class="button btn-giant btn-outline">
                    Crear cuenta
                </a>
                <a href="/login.html" class="button btn-giant btn-filled">
                    Iniciar sesión
                </a>
            </div>
        </header>
    @else
        <header id="admin-header" class="admin-container-fluid">
            <a href="#" class="logo">
                <img src="{{ asset('images/logoDeSedipro.svg') }}" alt="Logo de SEDIPRO">
            </a>
            <a href="#" class="perfil">
                <img src="{{ asset('images/perfil.png') }}" alt="Perfil">
            </a>
        </header>
    @endif

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">

        <div class="content-wrapper">
            <a href="#" class="logo">
                <img src="{{ asset('images/logoDeSedipro.svg') }}" alt="Logo de SEDIPRO">
            </a>

            <p class="text-small-medium">
                Sección Estudiantil de Dirección de Proyectos de la UNT
            </p>

            <a href="mailto:sediprount@unt.edu.co" class="button btn-large btn-filled btn-large-custom">
                Contáctanos
            </a>

            <div class="icon-container">
                <a href="https://www.facebook.com/SediproUNT/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-facebook.svg') }}" alt="Facebook" class="social-icon">
                </a>
                <a href="https://www.instagram.com/sediprount/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-instagram.svg') }}" alt="Instagram" class="social-icon">
                </a>
                <a href="https://pe.linkedin.com/company/sediprount" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-linkedin.svg') }}" alt="Linkedin" class="social-icon">
                </a>
                <a href="https://www.tiktok.com/@sediprount" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-tiktok.svg') }}" alt="TikTok" class="social-icon">
                </a>
                <a href="https://www.youtube.com/c/SEDIPROUNT" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-youtube.svg') }}" alt="Youtube" class="social-icon">
                </a>

                <!-- Enviar mensaje personalizado a whatsapp -->
                <a href="https://wa.me/51949177350?text=¡Hola!%20Estoy%20interesado%20en%20ser%20parte%20de%20SEDIPRO."
                    target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/icons/icons8-whatsapp.svg') }}" alt="Whatsapp" class="social-icon">
                </a>


            </div>
        </div>
        <div class="rectangle-footer"
            style="font-family: var(--text-small-medium); color: var(--color-neutral-0); padding-left: 20px;">
            <p>© 2024 All Rights Reserved</p>
        </div>
    </footer>

     <!-- Incluir archivos CSS específicos de cada vista -->
     @stack('styles') <!-- Aquí se cargarán los estilos adicionales desde las vistas -->

     <!-- Aquí se incluirán los JS específicos de cada vista -->
     @stack('scripts')  <!-- Usamos stack para inyectar JS específicos desde las vistas -->
</body>

</html>
