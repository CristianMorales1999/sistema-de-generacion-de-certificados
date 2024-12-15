<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los usuarios con las relaciones necesarias
        $filtered_people = Person::with([
            'user',
            'areas' => function ($query) {
                $query->where('area_person.is_active', true); // Filtrar áreas activas
            },
            'signatureImage', // Relación con las firmas (tabla signature_images)
            'signatureImage.position' // Cargo de la firma
        ])->get();
    
        // Mapear los datos a la estructura requerida
        $people = $filtered_people->map(function ($people) {
            return [
                'id' => $people->id,
                'first_name' => $people->first_name,
                'last_name' => $people->last_name,
                'phone_number' => $people->phone_number,
                'gender' => $people->gender,
                'email' => $people->user->email,
                'areas' => $people->areas->pluck('name'), // Extrae solo los nombres de las áreas activas
                'signature_image' => $people->signature->url ?? null, // Firma de la persona (si existe)
                'signature_position' => $people->signature->position->name ?? null // Cargo de la firma (si existe)
            ];
        });
        //Obtener registros del modelo person
        // Pasar los datos mapeados a la vista
        return view('administrator.people.index', compact('people'));
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
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
    }
}
