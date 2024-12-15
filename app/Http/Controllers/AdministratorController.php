<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CertificationGroup;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeUsers = User::whereHas('userStatus', function ($query) {
            $query->where('name', 'activo');
        })
            ->orderBy('created_at', 'asc')
            ->get();
        $totalActiveUsers = $activeUsers->count();

        $validatedGroups = CertificationGroup::where('is_validated', 1)
            ->orderBy('issue_date', 'asc')
            ->get();
        $totalValidatedGroups = $validatedGroups->count();

        $validatedCertificates = Certificate::whereHas('certificateStatus', function ($query) {
            $query->where('name', 'validado');
        })
            ->orderBy('created_at', 'asc')
            ->get();

        // Procesar los datos de los certificados validados para el gráfico
        $chartLabels = [];
        $chartData = [];

        // Agrupar por mes y año
        $validatedCertificates->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M Y'); // Mes y año
        })->each(function ($group, $key) use (&$chartLabels, &$chartData) {
            $chartLabels[] = $key; // Etiqueta del gráfico (Mes Año)
            $chartData[] = $group->count(); // Cantidad de certificados validados
        });

        $totalValidatedCertificates = $validatedCertificates->count();

        $pendingCertificates = Certificate::whereHas('certificateStatus', function ($query) {
            $query->where('name', 'pendiente');
        })
            ->orderBy('created_at', 'asc')
            ->get();
        $totalPendingCertificates = $pendingCertificates->count();

        //Para filtrar entre un rango de fechaas puedo usar '->whereBetween('created_at', ['2024-01-01', '2024-12-31'])'

        return view('administrator.index', compact('activeUsers', 'totalActiveUsers', 'validatedGroups', 'totalValidatedGroups', 'validatedCertificates', 'totalValidatedCertificates', 'pendingCertificates', 'totalPendingCertificates','chartLabels', 'chartData'));
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
