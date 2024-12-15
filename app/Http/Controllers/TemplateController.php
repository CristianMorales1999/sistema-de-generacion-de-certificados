<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*ID		
        nombre
        Imagen
        Estado
        */
        $filtered_templates = Image::with([
            'imageStatus',
            'imageType'
        ])
        ->whereHas('imageType', function ($query) {
            $query->where('name', 'Plantilla');  // Filtrar por el valor 'plantilla' en el campo 'name' de image_types
        })
        ->get();

        // Mapear los datos a la estructura requerida
        $templates = $filtered_templates->map(function ($templates) {
            return [
                'id' => $templates->id,
                'name'=>$templates->name,
                'image' => $templates->url,
                'status' => $templates->imageStatus->name
            ];
        });
        return view('administrator.templates.index',compact('templates'));
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
