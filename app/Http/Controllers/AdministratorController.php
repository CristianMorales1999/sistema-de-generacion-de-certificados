<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CertificationGroup;
use App\Models\User;
use Carbon\Carbon;
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

        //
        $validatedCertificates = Certificate::whereHas('certificateStatus', function ($query) {
            $query->where('name', 'validado');
        })
        ->orderBy('created_at', 'asc')
        ->get(); // Obtienes todos los certificados validados
        
        $totalValidatedCertificates = $validatedCertificates->count(); // Contar certificados validados
        
        $chartData = Certificate::whereHas('certificateStatus', function ($query) {
            $query->where('name', 'validado');
        })
        ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, COUNT(*) as count') // Agregar columnas: Mes (formateado) y Conteo
        ->groupBy('month') // Agrupar por mes
        ->orderByRaw('MIN(created_at) asc') // Ordenar por la fecha más temprana del grupo
        ->get(); // Obtienes los datos agrupados
        
        // Extraer etiquetas (labels) y datos para el gráfico desde $chartData
        $chartLabels = $chartData->pluck('month'); // ["Ene 2024", "Feb 2024", ...]
        $chartValues = $chartData->pluck('count'); // [100, 200, ...]
        //

        $pendingCertificates = Certificate::whereHas('certificateStatus', function ($query) {
            $query->where('name', 'pendiente');
        })
            ->orderBy('created_at', 'asc')
            ->get();
        $totalPendingCertificates = $pendingCertificates->count();

        //Para filtrar entre un rango de fechaas puedo usar '->whereBetween('created_at', ['2024-01-01', '2024-12-31'])'

        return view('administrator.index', compact('activeUsers', 'totalActiveUsers', 'validatedGroups', 'totalValidatedGroups', 'validatedCertificates', 'totalValidatedCertificates', 'pendingCertificates', 'totalPendingCertificates','chartLabels', 'chartValues'));
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
