@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')
    <div class="main-container" style="background-color: var(--color-primary-50);">

        <div class="dashboard-container">
            <!-- Menú lateral -->
            <x-sidebar />

            <!-- Contenido principal -->
            <section class="dashboard-content">
                <h2 class="h3">Usuarios</h2>


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

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>ID</th>
                                    <th>Foto de Perfil</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Verificación</th>
                                    <th>Estado</th>
                                    <th>Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <!-- Llenar los datos dinámicamente -->
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox" data-id="{{ $user['id'] }}">
                                        </td>
                                        <td>{{ $user['id'] }}</td>
                                        <td>
                                            @if ($user['profile_image'])
                                                <img src="{{ $user['profile_image'] }}" alt="Firma"
                                                    style="width:50px; height:auto;">
                                            @else
                                                Sin Foto de Perfil
                                            @endif
                                        </td>
                                        <td>{{ $user['first_name'] }}</td>
                                        <td>{{ $user['last_name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            @if ($user['is_validated'])
                                                Verificado
                                            @else
                                                Sin Verificar
                                            @endif
                                        </td>
                                        <td>{{ $user['status'] }}</td>
                                        <td>
                                            @if (count($user['roles']) > 0)
                                                {{ implode(', ', $user['roles']->toArray()) }}
                                            @else
                                                Sin rol
                                            @endif
                                        </td>
                                    </tr>
                                    <!---->
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
@endsection

@push('styles')
    <!-- Agregar un archivo CSS específico para esta vista -->
    @vite('resources/css/common-styles/admin-dashboard-styles.css')
    @vite('resources/css/common-styles/table-styles.css')
@endpush

{{-- @push('scripts')
    @vite('resources/js/administrator/people-table.js')
@endpush --}}
