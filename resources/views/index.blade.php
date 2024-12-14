<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEDIPRO</title>

    <link rel="stylesheet" href="{{ asset('css/common-styles/general-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-styles/generator-form-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-styles/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-styles/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-styles/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-styles/color-palette.css') }}">

    <!--Unico agregado diferente que esta presente solo en create-group.html -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!---->

    <!-- PARA TAILWIND -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">


    <!-- PARA ICONOGRÁFIA -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMiSzw7Z3pObi/8/vZlJ/4xguZ5/AW/cHzD7ntg" crossorigin="anonymous">

    <!-- PARA TIPOGRAFIA -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
    
    <header id="header" class="container-fluid">
        <a href="#" class="logo">
            <img src="{{ asset('../images/logoDeSedipro.svg') }}" alt="Logo de SEDIPRO">
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

    <main class="main-content">
        <div class="content-wrapper" style="background-color: var(--color-primary-50);">
            <h1 class="h1">
                GENERADOR DE CERTIFICADOS
            </h1>

            <p class="text-medium-regular" >
                Carga tu plantilla, logo y firmas para poder generar y descargar tus diferentes tipos de certificados.
            </p>

            <div class="button-container" style="margin: 30px auto;">
                <a href="#" class="button btn-large btn-filled">
                    Generar certificados           
                </a>
                <a href="/validar-certificado.html" class="button btn-large btn-outline">
                    Validar certificados            
                </a>   
            </div>

            <img src="{{ asset('../images/exampleCertificates/defaultCertificate.png') }}" alt="Ejemplo de certificado" class="cover-certificate-container">
        </div>

        <div class="content-wrapper" style="background-color: var(--color-neutral-0);"">
            <p class="text-medium-semibold" style="margin-top: 70px;">Si aún no tienes una plantilla personalizada, puedes elegir una de nuestras plantillas prediseñadas.</p>

            <div class="certificate-gallery">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate01.jpg') }}" alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate02.jpg') }}" alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate03.jpeg') }}" alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate04.jpeg') }}" alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate05.jpeg') }}" alt="Plantilla de certiicado" class="certificate-card">
            </div>        

            <footer class="footer">

                <div class="content-wrapper">
                    <a href="#" class="logo">
                        <img src="{{ asset('../images/logoDeSedipro.svg') }}" alt="Logo de SEDIPRO">
                    </a>
    
                    <p class="text-small-medium">
                        Sección Estudiantil de Dirección de Proyectos de la UNT
                    </p>

                    <a href="mailto:sediprount@unt.edu.co" class="button btn-large btn-filled btn-large-custom">
                        Contáctanos           
                    </a>  
                    
                    <div class="icon-container">
                        <a href="https://www.facebook.com/SediproUNT/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-facebook.svg') }}" alt="Facebook" class="social-icon">
                        </a>
                        <a href="https://www.instagram.com/sediprount/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-instagram.svg') }}" alt="Instagram" class="social-icon">
                        </a>
                        <a href="https://pe.linkedin.com/company/sediprount" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-linkedin.svg') }}" alt="Linkedin" class="social-icon">
                        </a>
                        <a href="https://www.tiktok.com/@sediprount" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-tiktok.svg') }}" alt="TikTok" class="social-icon">
                        </a>
                        <a href="https://www.youtube.com/c/SEDIPROUNT" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-youtube.svg') }}" alt="Youtube" class="social-icon">
                        </a>

                        <!-- Enviar mensaje personalizado a whatsapp -->
                        <a href="https://wa.me/51949177350?text=¡Hola!%20Estoy%20interesado%20en%20ser%20parte%20de%20SEDIPRO." target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('../images/icons/icons8-whatsapp.svg') }}" alt="Whatsapp" class="social-icon">
                        </a>
                        
                        
                    </div>
                </div>
                <div class="rectangle-footer" style="font-family: var(--text-small-medium); color: var(--color-neutral-0); padding-left: 20px;">
                    <p>© 2024 All Rights Reserved</p>
                </div>
            </footer>

        </div>
    </main>
</body>
</html>