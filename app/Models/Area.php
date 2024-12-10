<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'areas';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Los atributos que deberían ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación muchos a muchos con el modelo Person.
     *
     * Incluye atributos adicionales desde la tabla pivot.
     */
    public function people():BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'area_person', 'area_id', 'person_id')
                    ->withPivot(['start_date', 'end_date', 'is_activated'])
                    ->withTimestamps();
    }
}

