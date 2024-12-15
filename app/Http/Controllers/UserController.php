<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        -ID
        -profile_image_url
        -first_name
        -last_name
        -email
        -is_validated
        -roles
        -user_status_id
        */
        // Obtener todos los usuarios con las relaciones necesarias
        $filtered_users = User::with([
            'person', // Relación con la tabla people
            'userStatus', // Relación con la tabla user_statuses
            'roles' => function ($query) {
                $query->where('role_user.is_active', true); // Filtrar roles activos
            }
        ])->get();

        // Mapear los datos a la estructura requerida
        $users = $filtered_users->map(function ($users) {
            return [
                'id' => $users->id,
                'profile_image'=>$users->profile_image_url,
                'first_name' => $users->person->first_name,
                'last_name' => $users->person->last_name,
                'email' => $users->email,
                'is_validated'=>$users->is_validated,
                'status' => $users->userStatus->name,
                'roles' => $users->roles->pluck('name'),
            ];
        });
        //Obtener registros del modelo person
        // Pasar los datos mapeados a la vista
        return view('administrator.users.index', compact('users'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
