@extends('layouts.app')

@section('title', 'SEDICERT-GENERATION')

@section('content')
    <main>
        <div class="main-container" style="background-color: var(--color-primary-50);">
            <!-- INICIO TITULO -->
            <div>
                <h3 class="h2">
                    Generación de certificados
                </h3>
            </div>
            <!-- FIN TITULO -->
            @foreach ($group->certificates as $certificate)
                <!--INICIO CONTENEDOR DE PREVISUALIZACION Y FORMULARIO-->
                <div class="certificate-generator-container">
                    <div class="certificate-container">
                        <!-- Imagen del certificado -->
                        <img src="{{ asset('images/sin-lineas/CERTIFICADOS-PLANTILLAS.png') }}" alt="Certificado Base"
                            class="certificate-background">

                        <!-- Contenedor de datos dinámicos -->
                        <div class="certificate-data">
                            <!-- Título -->
                            {{-- h2 class="certificate-subtitle">DE RECONOCIMIENTO</> --}}

                            <!-- Nombre dinámico -->
                            <p class="recipient-name"style="margin-top: 330px;">
                                {{ $certificate->person->first_name . ' ' . $certificate->person->last_name ?? 'Nombre del destinatario' }}
                            </p>
                            <div class="line name-line" style="margin-top: 45px;"></div>

                            <!-- Descripción -->
                            <p class="certificate-description">
                                Por su excelente desempeño como <span class="role">{{ $role ?? 'ASESOR(A)' }}</span> del
                                área de
                                <span class="department">{{ $department ?? 'MARKETING' }}</span>, correspondiente a
                                <span
                                    class="date-range">{{ $dateRange ?? 'Agosto del año 2023 hasta Enero del año 2024' }}</span>.
                            </p>

                            <!-- Ubicación y fecha -->
                            <p class="certificate-location-date">
                                {{ $location ?? 'Trujillo' }},
                                {{ $group->issue_date ? \Carbon\Carbon::parse($group->issue_date)->format('d \d\e F \d\e Y') : '21 de enero de 2024' }}
                            </p>                            

                            <!-- Firmas -->
                            <div class="signatures">
                                <div class="signature">
                                    <!-- Línea sobre la firma izquierda -->
                                    <div class="line signature-line"></div>
                                    <p class="signature-name">{{ $sponsorName ?? 'Inc. Luis Julca Verástegui' }}</p>
                                    <p class="signature-title">SPONSOR SEDIPROUNT</p>
                                </div>
                                <div class="signature">
                                    <!-- Línea sobre la firma derecha -->
                                    <div class="line signature-line"></div>
                                    <p class="signature-name">{{ $presidentName ?? 'Cinthya Soledad Gil Toribio' }}</p>
                                    <p class="signature-title">PRESIDENTA SEDIPRO UNT 2023-2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN CONTENEDOR DE PREVISUALIZACION Y FORMULARIO-->
            @endforeach
        </div>
    </main>
@endsection

@push('styles')
    <link href="{{ public_path('css/common-styles/admin-dashboard-styles.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/create-group.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/table-styles.css') }}" rel="stylesheet">

    <link href="{{ public_path('css/common-styles/general-styles.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/generator-form-styles.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/styles.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/buttons.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/general-styles.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/typography.css') }}" rel="stylesheet">
    <link href="{{ public_path('css/common-styles/color-palette.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    @vite('resources/js/marketing/generator-form.js')
@endpush
