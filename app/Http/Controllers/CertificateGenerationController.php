<?php

namespace App\Http\Controllers;

use App\Models\CertificationGroup;
use App\Models\Image;
use App\Models\SignatureImage;
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
        dd($request->all());
        
        return view('certificates.generatePDF',compact('request'));
        
    }
}
