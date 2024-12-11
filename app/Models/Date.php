<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Date extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'dates';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'date',
    ];

    /**
     * Relación muchos a muchos con CertificationGroup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function certificationGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            CertificationGroup::class,
            'certification_group_date',  // Nombre de la tabla pivot
            'date_id',                  // Clave foránea para Date en la tabla pivot
            'certification_group_id'    // Clave foránea para CertificationGroup en la tabla pivot
        )->withTimestamps();            // Indica que la tabla pivot incluye `created_at` y `updated_at`
    }
}
