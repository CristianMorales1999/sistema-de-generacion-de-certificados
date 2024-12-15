@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')

<div class="main-container" style="background-color: var(--color-primary-50);">

    <div class="dashboard-container">
      <!-- Menú lateral -->
      <x-sidebar />

      <!-- Contenido principal -->
      <section class="dashboard-content">
        <h2 class="h3">Dashboard</h2>
        <div class="stats">
          <div class="stat-box">
            <i class="fas fa-user"></i>
            <h3>Usuarios</h3>
            <p>{{$totalActiveUsers}}</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-box"></i>
            <h3>Grupos</h3>
            <p>{{$totalValidatedGroups}}</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-chart-line"></i>
            <h3>Certificados</h3>
            <p>{{$totalValidatedCertificates}}</p>
          </div>
          <div class="stat-box">
            <i class="fas fa-clock"></i>
            <h3>Pendientes</h3>
            <p>{{$totalPendingCertificates}}</p>
          </div>
        </div>

        <!-- Gráfico -->
        <div class="chart">
          <h3>Certificados</h3>
          <canvas id="certificadosChart"></canvas>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/administrator/admin-dashboard.js')

    <!-- Pasar los datos desde PHP a JavaScript -->
    <script>
        window.chartLabels = @json($chartLabels);  // Las etiquetas
        window.chartData = @json($chartData);      // Los datos
    </script>
@endpush
