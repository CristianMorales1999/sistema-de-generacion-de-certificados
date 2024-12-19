<?php

namespace App\Http\Controllers;

use App\Models\CertificateStatus;
use App\Models\CertificationGroup;
use App\Models\Image;
use App\Models\SignatureImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CertificateGenerationController extends Controller
{
    public function showGenerationForm()
    {
        // Obtener todas las firmas junto con la persona y posición relacionadas
        $signatures = SignatureImage::with(['person', 'position'])
            ->whereNotNull('position_id')
            ->get();

        // Obtener todas las imágenes de tipo "plantilla" con estado "activo"
        $templates = Image::with(['imageType', 'imageStatus'])
            ->whereHas('imageType', function ($query) {
                $query->where('name', 'plantilla');
            })
            ->whereHas('imageStatus', function ($query) {
                $query->where('name', 'activo');
            })
            ->get();

        $certificationGroups = CertificationGroup::with(['certificationType', 'createdBy', 'area'])
            ->whereNull('certified_by_user_id') // Filtrar por grupos no certificados
            ->whereHas('certificates', function ($query) {
                $query->whereHas('certificateStatus', function ($statusQuery) {
                    $statusQuery->where('name', 'Creado'); // Filtrar por estado "Creado"
                });
            })
            ->get();

        return view('certificates.generation', compact('signatures', 'templates', 'certificationGroups'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        //Actualizando datos de grupo de certificacion
        $group = CertificationGroup::find($request->group_id); // Reemplaza 'Modelo' por el nombre de tu modelo.
        // $group->is_validated = '1';
        // $group->certified_by_user_id = '11';


        //Plantillas
        $template = Image::find($request->template_id);

        if ($group && $template) {
            // Evita duplicados y no intenta registrar una relación ya existente
            $group->images()->syncWithoutDetaching([$template->id]);
        }

        $signatures = $request->signatures;
        //Total de firmas y roles
        foreach ($request->signatures as $signature_id) {
            if (!$group->signatureImages->contains($signature_id)) {
                $group->signatureImages()->attach($signature_id);
            }
        }
        //Obtener el tipo de certificado
        $certificationType = $group->certificationType->name;
        $content = "";
        //Evaluamos el tipo para asignar el contenido estatico del certificado
        if ($certificationType == 'Certificado de Voluntariado') {
            $content = "Por su destacada participación como MIEMBRO del proyecto " . $group->name . " organizado por la Sección Estudiantil de Dirección de Proyectos de la Universidad Nacional de Trujillo.";
        } else if ($certificationType == 'Certificado de Ponente') {
            $content = "Por su destacada participación como PONENTE del proyecto " . $group->name . " organizado por la Sección Estudiantil de Dirección de Proyectos de la Universidad Nacional de Trujillo.";
        } else if ($certificationType == 'Certificado de Cargo Directiva') {
            $content = "Por su destacada participación como DIRECTOR(a) del área de PMO correspondiente al periodo MARZO 2022 - MARZO 2023.";
        } else if ($certificationType == 'Certificado de Cargo DP') {
            $content = "Por su destacada participación como DIRECTOR del proyecto " . $group->name . " organizado por la Sección Estudiantil de Dirección de Proyectos de la Universidad Nacional de Trujillo.";
        } else if ($certificationType == 'Certificado de Egreso') {
            $content = "Por su destacada participación como ASESOR en su área correspondiente al periodo AGOSTO 2022 - MARZO 2024.";
        } else if ($certificationType == 'Certificado de Taller') {
            $content = "Por su destacada participación en el taller " . $group->name . ", realizado del " . $group->start_date . " - " . $group->end_date . " del presente año por la Sección Estudiantil de Dirección de Proyectos de la Universidad Nacional de Trujillo.";
        } else if ($certificationType == 'Certificado de Participante') {
            $content = "Por su destacada participación en el proyecto " . $group->name . ", realizado del " . $group->start_date . " - " . $group->end_date . " del presente año por la Sección Estudiantil de Dirección de Proyectos de la Universidad Nacional de Trujillo.";
        }

        $group->save();

        // Paso 3: Obtener el estado "Validado" de la tabla certificate_statuses
        // $validatedStatus = CertificateStatus::where('name', 'Validado')->first();

        // // Verificar si el estado "Validado" existe
        // if (!$validatedStatus) {
        //     // Manejar el caso si no existe el estado "Validado"
        //     return response()->json(['error' => 'Estado "Validado" no encontrado'], 404);
        // }
        // // Paso 4: Actualizar los certificados del grupo
        // $group->certificates()->update([
        //     'is_validated' => 1, // Cambiar a 1
        //     'certificate_status_id' => $validatedStatus->id, // Cambiar al estado "Validado"
        // ]);

        // return view('certificates.generatePDF', compact('group', 'template', 'request->signatures'));

        $pdf = Pdf::loadView('certificates.generatePDF', compact('group', 'template', 'signatures'))
        ->setPaper('a4', 'landscape'); // Establece el tamaño de papel y orientación

        // Desactivar el encabezado y pie de página
        $pdf->setOption('no-header', true);
        $pdf->setOption('no-footer', true);

        return $pdf->stream('certificates_' . $group->name . '_group' . '.pdf');
    }
}
