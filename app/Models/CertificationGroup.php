<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CertificationGroup extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'certification_groups';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'certification_type_id',
        'created_by_user_id',
        'certified_by_user_id',
        'area_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'is_validated',
    ];

    /**
     * Relación muchos a uno con el modelo User (creador).
     */
    public function createdBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Relación muchos a uno con el modelo User (certificador).
     */
    public function certifiedBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'certified_by_user_id');
    }

    /**
     * Relación muchos a muchos con el modelo CertificateTextType.
     */
    public function certificateTextTypes():BelongsToMany
    {
        return $this->belongsToMany(
            CertificateTextType::class,
            'certificate_text_type_certification_group',//nombre de la tabla pivot 
            'certification_group_id',// Clave foránea en la tabla pivot para CertificationGroup
            'certificate_text_type_id'// Clave foránea en la tabla pivot para CertificateTextType
        )->withPivot(['font_configuration_id'])// Incluye los campos adicionales de la tabla pivot
        ->withTimestamps();
    }
}