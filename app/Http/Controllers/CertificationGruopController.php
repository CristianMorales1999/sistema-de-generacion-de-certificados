<?php

namespace App\Http\Controllers;

use App\Models\CertificationGroup;
use Illuminate\Http\Request;

class CertificationGruopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Nombre del grupo de certificación
         * Tipo de Grupo de certificación
         * Descripción de grupo de certificación
         * Fecha de inicio del grupo de certificación
         * Fecha de fin del grupo de certificación
         * Usuario Generador de certificados para el grupo de certificación
         * Usuario Creador del grupo de certificación	
         * Persona dueña de Firma 1	
         * Persona dueña de Firma 2	
         * Persona dueña de Firma 3	
         * Persona dueña de Firma 4	
         * Imagen de Tipo Plantilla del Grupo de certificación
         */
        $filtered_groups = CertificationGroup::with([
            'certificationType',
            'createdBy.person',        // Usuario creador
            'certifiedBy.person',      // Usuario generador de certificados
            'signatureImages.person', // Personas dueñas de las firmas
            'images' => function ($query) {  // Filtramos las imágenes de tipo 'Plantilla'
                $query->whereHas('imageType', function ($query) {
                    $query->where('name', 'Plantilla');  // Filtrar por el tipo 'Plantilla'
                });
            }
        ])->get();

        // Mapear los datos a la estructura requerida
        $groups = $filtered_groups->map(function ($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'type' => $group->certificationType->name,
                'description' => $group->description,
                'start_date' => $group->start_date,
                'end_date' => $group->end_date,
                'createdBy' => $group->createdBy->person->first_name." ".$group->createdBy->person->last_name,
                'certifiedBy' => $group->certifiedBy->person->first_name." ".$group->certifiedBy->person->last_name,

                // Personas dueñas de las firmas (iterar sobre las imágenes de firmas)
                'signatories' => $group->signatureImages->map(function ($signatureImage) {
                    return $signatureImage->person->first_name . ' ' . $signatureImage->person->last_name;
                }),

                // Imágenes de tipo 'Plantilla' (iterar sobre la colección de imágenes)
                'templates' => $group->images->map(function ($image) {
                    return $image->url;
                })//->implode(', ') // Unir los nombres de las imágenes con coma si hay varias
            ];
        });

        return view('administrator.groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
