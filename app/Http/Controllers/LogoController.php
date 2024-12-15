<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class LogoController extends Controller
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
        $filtered_images = Image::with([
            'imageStatus',
            'imageType'
        ])
        ->whereHas('imageType', function ($query) {
            $query->where('name', 'logo');  // Filtrar por el valor 'logo' en el campo 'name' de image_types
        })
        ->get();

        // Mapear los datos a la estructura requerida
        $logos = $filtered_images->map(function ($logos) {
            return [
                'id' => $logos->id,
                'name'=>$logos->name,
                'image' => $logos->url,
                'status' => $logos->imageStatus->name
            ];
        });

        return view('administrator.logos.index',compact('logos'));
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
