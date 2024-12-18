<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateValidationController extends Controller
{
    public function showValidationForm()
    {
        return view('certificates.validate');
    }

    public function validateCertificate(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'code' => 'required|string|max:255', // Valida que el código no esté vacío
        ]);
        /**
         * Code
         * first_name -> mediante la clave foranea person_id llega a la tabla people(Modelo:Person) y obtiene su campo first_name
         * last_name -> mediante la clave foranea person_id llega a la tabla people(Modelo:Person) y obtiene su campo last_name
         * group_name -> mediante la clave foranea certification_group_id llega a la tabla certification_groups(Modelo:CertificationGroup) y obtiene su campo name
         * issue_date -> mediante la clave foranea certification_group_id llega a la tabla certification_groups(Modelo:CertificationGroup) y obtiene su campo issue_date
         */
        // Buscar el certificado con las condiciones requeridas
        $certificate = Certificate::where('code', $request->code)
            ->where('is_validated', true)
            ->whereHas('certificateStatus', function ($query) {
                $query->where('name', 'Validado');
            })
            ->with(['person', 'certificationGroup']) // Carga las relaciones
            ->first();

        if ($certificate) {
            // Mapeamos los datos a la estructura que necesitas
            $data = [
                $certificate->code => [
                    'firstName' => $certificate->person->first_name,
                    'lastName' => $certificate->person->last_name,
                    'certification' => $certificate->certificationGroup->name, // o el nombre del tipo de certificado
                    'issueDate' => $certificate->certificationGroup->issue_date, // Asegúrate de formatear la fecha correctamente
                ]
            ];
            // Si se encuentra el certificado, redirigir con éxito y datos
            return back()->with([
                'success' => 'Certificado válido.',
                'certificate' => $data,
            ]);
        } else {
            // Si no se encuentra el certificado, redirigir con un mensaje de error
            return back()->with('error', 'El certificado no existe o el código es incorrecto.');
        }
    }
}
