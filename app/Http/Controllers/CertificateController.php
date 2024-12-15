<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*ID	
        Código	
        Titular	
        Grupo	
        Fecha de emisión	
        Estado
        */
        $filtered_certificates = Certificate::with([
            'certificateStatus',
            'person',
            'certificationGroup'
        ])->get();

        // Mapear los datos a la estructura requerida
        $certificates = $filtered_certificates->map(function ($certificates) {
            return [
                'id' => $certificates->id,
                'code'=>$certificates->code,
                'titular' => $certificates->person->first_name." ".$certificates->person->last_name,
                'group' => $certificates->certificationGroup->name,
                'issue_date' => $certificates->certificationGroup->issue_date,
                'status' => $certificates->certificateStatus->name
            ];
        });

        return view('administrator.certificates.index',compact('certificates'));
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
