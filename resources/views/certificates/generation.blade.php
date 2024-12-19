@extends('layouts.app')

@section('title', 'SEDICERT-GENERATION')

@section('content')
    <!--Inicio Boton flotante (Ubicado esquina inferior derecha)-->
    <a href="{{ route('certificates.validate.process') }}" target="_blank" class="floating-button">
        <img src="{{ asset('images/icons/validate-certificate.svg') }}" alt="Validar certificado">
    </a>
    <!--Fin Boton flotante-->

    <main>
        <div class="main-container" style="background-color: var(--color-primary-50);">
            <!-- INICIO TITULO -->
            <div>
                <h3 class="h2">
                    Generación de certificados
                </h3>
            </div>
            <!-- FIN TITULO -->

            <!--INICIO CONTENEDOR DE PREVISUALIZACION Y FORMULARIO-->
            <div class="certificate-generator-container">

                <!--Imagen de Previsualizacion(Aqui en vez de una imagen estática deberia ir la previsualización de todos los certificados que se van a generar, uno por uno, con flechas a los costados de siguiente y anterior, donde el numero de estas previsualizacion son el numero total de miembros del grupo de certificación)-->
                <div class="certificate-preview-container">
                    <img src="{{ asset('images/exampleCertificates/defaultCertificate.png') }}" alt="Ejemplo de certificado"
                        class="cover-certificate-container">
                </div>
                <!--Fin Imagen de Previsualizacion-->

                <!--Formulario de seleccionables-->
                <form class="form-general-data" action="{{ route('certificates.generatePDF') }}" method="POST">
                    @csrf
                    <!--Inicio Seleccion de Plantilla y Grupo-->
                    <div class="form-dropdown-row">
                        <!--INICIO PLANTILLA-->
                        <div class="search-dropdown">
                            <div class="search-dropdown-button"> <!-- Select -->
                                <span class="search-dropdown-text-selected">Seleccionar plantilla</span> <!-- Selected -->
                                <div class="search-dropdown-caret"></div>
                            </div>

                            <div class="search-dropdown-menu">
                                <!-- Input de búsqueda -->
                                <div class="search-dropdown-search-container">
                                    <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar"
                                        class="search-icon" style="width: 35px;">
                                    <input type="text" class="search-dropdown-input" placeholder="Buscar..." />
                                </div>
                                <ul class="search-dropdown-options">
                                    @if ($templates->isEmpty())
                                        <p>No hay plantillas disponibles.</p>
                                    @else
                                        @foreach ($templates as $template)
                                            <li data-value="{{ $template->id }}">{{ $template->name }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- Campo oculto para almacenar el ID de la plantilla seleccionada -->
                        <input type="hidden" name="template_id" id="template_id">
                        <!--FIN PLANTILLA-->

                        <!--INICIO GRUPOS DE CERTIFICACION-->
                        <div class="container-search-dropdown-plus" style="align-items: baseline;">

                            <div class="search-dropdown"> <!-- GRUPO -->
                                <div class="search-dropdown-button"> <!-- Select -->
                                    <span class="search-dropdown-text-selected">Seleccionar grupo</span> <!-- Selected -->
                                    <div class="search-dropdown-caret"></div>
                                </div>

                                <div class="search-dropdown-menu"> <!-- Menu -->
                                    <div class="search-dropdown-search-container">
                                        <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar"
                                            class="search-icon" style="width: 35px;">
                                        <input type="text" class="search-dropdown-input" placeholder="Buscar..." />
                                    </div>
                                    <ul class="search-dropdown-options">
                                        @foreach ($certificationGroups as $group)
                                            <li data-value="{{ $group->id }}">{{ $group->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Campo oculto para almacenar el ID del grupo seleccionado -->
                            <input type="hidden" name="group_id" id="group_id">

                            <a href="/marketing/create-group.html" class="button btn-icon-only btn-outline">
                                <img src="{{ asset('images/icons/icon-plus.svg') }}" alt="Añadir registro">
                            </a>
                        </div>
                        <!--FIN GRUPOS DE CERTIFICACION-->
                    </div>
                    <!--FIN Seleccion de Plantilla y Grupo-->

                    <!--Linea de separacion-->
                    <div class="formHorizontalRule"></div>

                    <!--INICIO ROLES Y FIRMAS-->
                    @for ($i = 0; $i < 3; $i++)
                        <!-- FIRMA Y ROL NRO I -->
                        <span class="dropdown-text-title">Firma N°.{{ $i + 1 }}</span>

                        <div class="form-dropdown-row">
                            <!-- FIRMA I -->
                            <div class="search-dropdown">
                                <div class="search-dropdown-button">
                                    <span class="search-dropdown-text-selected">Seleccionar nombre</span>
                                    <div class="search-dropdown-caret"></div>
                                </div>
                                <div class="search-dropdown-menu">
                                    <div class="search-dropdown-search-container">
                                        <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar"
                                            class="search-icon" style="width: 35px;">
                                        <input type="text" class="search-dropdown-input" placeholder="Buscar...">
                                    </div>
                                    <ul class="search-dropdown-options">
                                        @foreach ($signatures as $signature)
                                            <li data-value="{{ $signature->id }}">
                                                {{ $signature->person->first_name . ' ' . $signature->person->last_name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Campo oculto para almacenar el ID de la firma seleccionada -->
                            <input type="hidden" name="signatures[]" class="signature-input">
                            <!-- FIN FIRMA I -->

                            <!-- ROL I -->
                            <div class="search-dropdown">
                                <div class="search-dropdown-button">
                                    <span class="search-dropdown-text-selected">Seleccionar rol</span>
                                    <div class="search-dropdown-caret"></div>
                                </div>
                                <div class="search-dropdown-menu">
                                    <div class="search-dropdown-search-container">
                                        <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar"
                                            class="search-icon" style="width: 35px;">
                                        <input type="text" class="search-dropdown-input" placeholder="Buscar...">
                                    </div>
                                    <ul class="search-dropdown-options">
                                        @foreach ($signatures as $signature)
                                            <li data-value="{{ $signature->position->name }}">
                                                {{ $signature->position->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Campo oculto para almacenar el rol seleccionado -->
                            <input type="hidden" name="roles[]" class="role-input">
                            <!-- FIN ROL I -->
                        </div>
                        <!-- FIRMA Y ROL NRO I -->
                    @endfor
                    <!--FIN ROLES Y FIRMAS-->

                    <!-- INICIO BOTONES -->
                    <div class="button-container" style="margin: 30px auto;">
                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="button btn-large btn-filled">Guardar</button>

                        <!-- Botón para limpiar los campos -->
                        <a href="{{ route('certificates.generation') }}" class="button btn-large btn-filled">
                            Limpiar
                        </a>
                    </div>
                    <!-- FIN BOTONES -->

                </form>
                <!--Fin de Formulario de seleccionables-->
            </div>
            <!--FIN CONTENEDOR DE PREVISUALIZACION Y FORMULARIO-->
        </div>
    </main>
@endsection

@push('styles')
    <!-- Agregar un archivo CSS específico para esta vista -->
    @vite('resources/css/common-styles/admin-dashboard-styles.css')
    @vite('resources/css/common-styles/create-group.css')
    @vite('resources/css/common-styles/table-styles.css')
@endpush

@push('scripts')
    @vite('resources/js/marketing/generator-form.js')
@endpush
