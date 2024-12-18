@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')
    <main>
        <div class="main-container" style="background-color: var(--color-primary-50);">
            <div class="dashboard-container">
                <!-- Menú lateral -->
                <x-sidebar />

                <!-- Contenido principal -->
                <section class="dashboard-content">
                    <h2 class="h3">Personas</h2>

                    <!-- ============RESPONSIVE TABLE============ -->

                    <div class="general-table" style="width: 100%;">
                        <div class="table-container">
                            <div class="table-header">
                                <div class="search-container">
                                    <button class="filter-button">
                                        <img src="{{ asset('images/icons/icon-filter.svg') }}" alt="Filtro"
                                            class="filter-icon">
                                    </button>
                                    <div class="search-box">
                                        <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar"
                                            class="search-icon">
                                        <input type="text" id="search" placeholder="Search...">
                                    </div>
                                </div>

                                <!--Acciones-->
                                <div class="action-buttons">
                                    <a href="#" class="button-action btn-small btn-outline">
                                        <img src="{{ asset('images/icons/icon-plus.svg') }}" alt="Añadir registro">
                                        Añadir registro
                                    </a>
                                    <a href="#" class="button-action btn-small btn-filled">
                                        <img src="{{ asset('images/icons/icon-upload.svg') }}" alt="Cargar archivo">
                                        Cargar archivo
                                    </a>
                                </div>
                                <!--Fin Acciones-->
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Área</th>
                                        <th>Cargo</th>
                                        <th>Firma</th>
                                        <th>Contacto</th>
                                        <th>Sexo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($people as $person)
                                        <tr>
                                            <td><input type="checkbox" class="row-checkbox" data-id="{{ $person['id'] }}">
                                            </td>
                                            <td>{{ $person['first_name'] }}</td>
                                            <td>{{ $person['last_name'] }}</td>
                                            <td>{{ $person['email'] }}</td>
                                            <td>
                                                @if (count($person['areas']) > 0)
                                                    {{ implode(', ', $person['areas']->toArray()) }}
                                                @else
                                                    Externo
                                                @endif
                                            </td>
                                            <td>
                                                @if ($person['signature_position'])
                                                    {{ $person['signature_position'] }}
                                                @else
                                                    Sin Cargo
                                                @endif
                                            </td>
                                            <td>
                                                @if ($person['signature_image'])
                                                    <img src="{{ $person['signature_image'] }}" alt="Firma"
                                                        style="width:50px; height:auto;">
                                                @else
                                                    Sin firma
                                                @endif
                                            </td>

                                            <td>{{ $person['phone_number'] }}</td>
                                            <td>{{ $person['gender'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="pagination">
                                <span id="rows-info">1-10 de 20</span>
                                <button class="btn-pagination" id="prev-page" disabled>&laquo; Anterior</button>
                                <button class="btn-pagination" id="next-page">Siguiente &raquo;</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <!-- Agregar un archivo CSS específico para esta vista -->
    @vite('resources/css/common-styles/admin-dashboard-styles.css')
    @vite('resources/css/common-styles/table-styles.css')
@endpush

{{-- Este archivo .js lo comento por mientras para que no jala la data ficticia definida en el archivo y asi poder usar la data que capturo aqui de la base de datos mediante los modelos --}}
{{-- @push('scripts')
    @vite('resources/js/administrator/users-table.js')
@endpush --}}
