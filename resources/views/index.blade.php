@extends('layouts.app')

@section('title','SEDICERT')

@section('content')
    <main>
        <div class="content-wrapper" style="background-color: var(--color-primary-50);">
            <h1 class="h1">
                GENERADOR DE CERTIFICADOS
            </h1>

            <p class="text-medium-regular">
                Carga tu plantilla, logo y firmas para poder generar y descargar tus diferentes tipos de certificados.
            </p>

            <div class="button-container" style="margin: 30px auto;">
                <a href="{{ route('certificates.generation') }}" class="button btn-large btn-filled">
                    Generar certificados
                </a>
                <a href="{{ route('certificates.validate.process') }}" class="button btn-large btn-outline">
                    Validar certificados
                </a>
            </div>

            <img src="{{ asset('../images/exampleCertificates/defaultCertificate.png') }}" alt="Ejemplo de certificado"
                class="cover-certificate-container">
        </div>

        <div class="content-wrapper" style="background-color: var(--color-neutral-0);"">
            <p class="text-medium-semibold" style="margin-top: 70px;">Si aún no tienes una plantilla personalizada,
                puedes elegir una de nuestras plantillas prediseñadas.</p>

            <div class="certificate-gallery">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate01.jpg') }}"
                    alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate02.jpg') }}"
                    alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate03.jpeg') }}"
                    alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate04.jpeg') }}"
                    alt="Plantilla de certiicado" class="certificate-card">
                <img src="{{ asset('../images/exampleCertificates/exampleCertificate05.jpeg') }}"
                    alt="Plantilla de certiicado" class="certificate-card">
            </div>
        </div>

    </main>
@endsection
