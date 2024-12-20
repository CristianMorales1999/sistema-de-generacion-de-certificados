<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url("{{ public_path('images/CERTIFICADOS-PLANTILLAS-T.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {}

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 36px;
            color: #444;
        }

        p {
            font-size: 18px;
            margin-top: 10px;
        }

        #admin-header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            align-items: center;
            /* horizontal */
            justify-content: space-between;
            max-height: 103px;
            padding-top: 0;
            padding-bottom: 0;
            z-index: 1000;
            position: sticky;
            background-color: var(--color-neutral-0);
            box-shadow:
                0px 0px 5px 0px rgba(127, 89, 248, 0.2),
                0px 7px 10px 0px rgba(127, 89, 248, 0.14),
                0px 2px 16px 0px rgba(127, 89, 248, 0.12);
        }

        .admin-container-fluid

        /* Header */
            {
            width: 100%;
            padding-right: 24px;
            padding-left: 24px;
            margin-right: auto;
            margin-left: auto;
        }

        /* *********************POR REVISAR************************ */

        /* Menú lateral */
        .sidebar {
            position: fixed;
            top: 50px;
            /* Altura del header */
            left: 0;
            width: 240px;
            z-index: 100;
            height: calc(100vh - 50px);
            /* Resto de la altura después del header */
            background-color: var(--color-neutral-0);
            overflow-y: auto;
            /* Permite scroll si el contenido excede */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding-top: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li.active {
            background-color: var(--color-accent-300);
            /* Color cuando está activo */
            color: white;
        }

        .sidebar ul li.active:hover {
            background-color: var(--color-primary-300);
            /* Un tono más oscuro cuando se hace hover sobre un item activo */
            color: white;
        }

        .sidebar ul li:hover:not(.active) {
            background-color: var(--color-accent-100);
            /* Color de hover para ítems no activos */
            color: white;
        }



        .sidebar ul li a {
            text-decoration: none;
            color: var(--color-primary-800);
            display: block;
        }


        /* Contenido del dashboard */
        .dashboard-container {
            display: flex;
            margin-left: 180px;
            /* Espacio del menú lateral */
        }

        .dashboard-content {
            flex: 1;
            padding: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-box h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .stat-box i {
            font-size: 2rem;
            color: var(--color-primary-300);
        }

        .chart {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }


        /* Template dinamico de certificado */

        .certificate-container {
            position: relative;
            width: 1123px;
            /* Ajusta al ancho de tu imagen */
            height: 794px;
            /* Ajusta al alto de tu imagen */
        }

        .certificate-background {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .certificate-data {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            font-family: 'Arial', sans-serif;
            color: #4a4a4a;
        }

        .certificate-title {
            font-size: 48px;
            font-weight: bold;
            text-align: center;
            margin-top: 180px;
            /* Ajusta para alinear con tu diseño */
            color: #a8924f;
        }

        .certificate-subtitle {
            font-size: 32px;
            text-align: center;
            margin-top: -20px;
            color: #4a4a4a;
        }

        .recipient-name {
            font-size: 36px;
            font-family: 'Great Vibes', cursive;
            text-align: center;
            margin-top: 50px;
            color: #a8924f;
        }

        .certificate-description {
            font-size: 16px;
            text-align: center;
            margin: 10px auto;
            width: 70%;
            line-height: 1.5;
        }

        .certificate-location-date {
            font-size: 14px;
            text-align: right;
            margin-right: 100px;
            margin-top: 20px;
        }

        .signatures {
            width: 70%;
            margin: 0% auto;
        }

        .signature {
            text-align: center;
        }

        .signature-name {
            font-size: 14px;
            font-weight: bold;
        }

        .signature-title {
            font-size: 12px;
            color: #4a4a4a;
        }

        /* Lineas */
        /* Línea debajo del nombre */
        .name-line {
            position: absolute;
            width: 400px;
            /* Ajusta el ancho según sea necesario */
            height: 2px;
            background-color: #4a4a4a;
            /* Color de la línea */
            top: 340px;
            /* Ajusta según la posición de tu diseño */
            left: 50%;
            transform: translateX(-50%);
        }

        /* Líneas sobre las firmas */
        .signature-line {
            width: 200px;
            /* Ajusta el ancho de las líneas */
            height: 1px;
            background-color: #4a4a4a;
            margin: 0 auto 10px auto;
            /* Centra la línea y añade margen inferior */
        }

        .signature-image {
            width: 100px;
            /* Ajusta el tamaño de las imágenes según sea necesario */
            height: 100px;
            /* Mantiene la proporción de la imagen */
            display: block;
            margin: 0 auto;
            /* Centra la imagen */
            margin-bottom: 10px;
            /* Espacio debajo de la imagen */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="certificate-generator-container">

            <div class="certificate-data">
                <p class="recipient-name" style="margin-top: 330px;">
                    {{ isset($certificate->person) ? $certificate->person->fist_name ?? 'Carlos Arturo' : 'Carlos Arturo' }}
                    {{ isset($certificate->person) ? $certificate->person->last_name ?? 'Silva Castillo' : 'Silva Castillo' }}
                </p>
                <div class="line name-line" style="margin-top: 45px;"></div>

                <!-- Descripción -->
                <p class="certificate-description">
                    Por su excelente desempeño como <span class="role">ASESOR(A)</span> del
                    área de
                    <span
                        class="department">{{ isset($areas) && $areas->isNotEmpty() ? $areas->first()->name : 'MARKETING' }}</span>,
                    correspondiente a
                    <span class="date-range">
                        {{ isset($start_date) && !empty($start_date) ? Carbon\Carbon::parse($start_date)->format('d \d\e F \d\e Y') : 'Agosto del año 2023' }}
                        hasta
                        {{ isset($end_date) && !empty($end_date) ? Carbon\Carbon::parse($end_date)->format('d \d\e F \d\e Y') : 'Enero del año 2024' }}
                    </span>.
                </p>

                <p class="certificate-location-date">
                    {{ $location ?? 'Trujillo' }},
                    {{ isset($issue_date) && !empty($issue_date) ? Carbon\Carbon::parse($issue_date)->format('d \d\e F \d\e Y') : '21 de enero de 2024' }}
                </p>

                <table class="signatures">
                    <tr>
                        <td class="signature">
                            <img src="{{ public_path('images/firmas/firma1.png') }}" alt="Firma de Luis Julca"
                                class="signature-image">

                            <div class="line signature-line"></div>
                            <p class="signature-name">
                                {{ isset($signatures[0]) && isset($signatures[0]->person) ? $signatures[0]->person->first_name . ' ' . ($signatures[0]->person->last_name ?? '') : 'Inc. Luis Julca Verástegui' }}
                            </p>
                            <p class="signature-title">
                                {{ isset($signatures[0]) && isset($signatures[0]->position) ? $signatures[0]->position->name : 'SPONSOR SEDIPRO UNT' }}
                            </p>
                        </td>
                        <td class="signature">
                            <img src="{{ public_path('images/firmas/firma2.png') }}"
                                alt="Firma de Cinthya Soledad" class="signature-image">
                            <div class="line signature-line"></div>
                            <p class="signature-name">
                                {{ isset($signatures[1]) && isset($signatures[1]->person) ? $signatures[1]->person->first_name . ' ' . ($signatures[1]->person->last_name ?? '') : 'Cinthya Soledad Gil Toribio' }}
                            </p>
                            <p class="signature-title">
                                {{ isset($signatures[1]) && isset($signatures[1]->position) ? $signatures[1]->position->name : 'PRESIDENTA SEDIPRO UNT 2023-2024' }}
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
