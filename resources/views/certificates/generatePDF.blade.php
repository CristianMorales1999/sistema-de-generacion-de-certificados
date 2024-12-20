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

        /* Template dinamico de certificado */

        .certificate-data {
            /* position: absolute; */
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
            /* margin-top: 180px; */
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
            /* margin-top: 50px; */
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

@foreach ($group->certificates as $certificate)

    <body>

        <div class="certificate-data">
            <p class="recipient-name" style="margin-top: 330px;">
                {{ isset($certificate->person) ? $certificate->person->first_name ?? 'dasda Arturo' : 'dasda Arturo' }}
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
                    {{ isset($group->start_date) && !empty($group->start_date) ? Carbon\Carbon::parse($group->start_date)->format('d \d\e F \d\e Y') : 'Agosto del año 2023' }}
                    hasta
                    {{ isset($group->end_date) && !empty($group->end_date) ? Carbon\Carbon::parse($group->end_date)->format('d \d\e F \d\e Y') : 'Enero del año 2024' }}
                </span>.
            </p>

            <p class="certificate-location-date">
                {{ $location ?? 'Trujillo' }},
                {{ isset($group->issue_date) && !empty($group->issue_date) ? Carbon\Carbon::parse($group->issue_date)->format('d \d\e F \d\e Y') : '21 de enero de 2024' }}
            </p>

            <table class="signatures">
                <tr>
                    @foreach ($signatures as $signature)
                        <td class="signature">
                            <img src="{{ public_path('images' . $signature->url) }}" alt="{{ $signature->url }}">
                            <div class="line signature-line"></div>
                            <p class="signature-name">
                                {{ isset($signature->person) ? $signature->person->first_name . ' ' . ($signature->person->last_name ?? '') : 'cdsfdas' }}
                            </p>
                            <p class="signature-title">
                                {{ isset($signature->position) ? $signature->position->name : 'SPONSOR SEDIPRO UNT' }}
                            </p>
                        </td>
                    @endforeach
                </tr>
            </table>
        </div>
    </body>
@endforeach

</html>
