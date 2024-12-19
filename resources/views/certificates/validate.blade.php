@extends('layouts.app')

@section('title', 'SEDICERT-VALIDATION')

@section('content')
<main>
    <div class="validate-container">
        <h2 class="title-text-validate-container">Validar certificado</h2>
        <form id="certificateForm" action="{{ route('certificates.validate.process') }}" method="POST">
            @csrf
            <span class="text-validate-input-title">Ingrese código de certificado</span>

            <div class="search-box">
                <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Buscar" class="search-icon">
                <input type="text" id="search" name="code" placeholder="D2I4-2ED3-283F-27SP" required>
            </div>

            @if (session('error'))
                <p style="color: red; text-align: center; margin-top: 5%">{{ session('error') }}</p>
            @endif

            @if (session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <div id="statusMessage" class="status-message"></div>
            <button type="submit" class="button btn-giant btn-filled login-button">
                Validar
            </button>
            
        </form>

    </div>

    <!-- Ventana Modal -->
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <h3 class="text-large-semibold">Detalles del certificado</h3>
            <div class="box-details-modal">
                <span class="detail-text" id="firstName">Juan</span>
            </div>
            <div class="box-details-modal">
                <span class="detail-text" id="lastName">Pérez</span>
            </div>
            <div class="box-details-modal">
                <span class="detail-text" id="certification">Certificación por: Desarrollo Web</span>
            </div>
            <div class="box-details-modal">
                <span class="detail-text" id="issueDate">Fecha de emisión: 2024-11-23</span>
            </div>

            <div class="button-container">
                <button type="button" id="close-modal" class="button btn-small btn-filled">Cerrar</button>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
    @vite('resources/css/common-styles/validate-certificate.css')
    @vite('resources/css/common-styles/admin-dashboard-styles.css')
@endpush

@push('scripts')
    @vite('resources/js/validate-certificate.js')
    <script>
        // Pasa los datos del certificado al archivo JS
        window.certificateData = @json(session('certificate'));
    </script>
@endpush
