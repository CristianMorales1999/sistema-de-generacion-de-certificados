<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'image_type_id',
        'image_status_id',
        'name',
        'url',
    ];

    /**
     * Relación muchos a uno con ImageStatus.
     */
    public function imageStatus(): BelongsTo
    {
        return $this->belongsTo(ImageStatus::class, 'image_status_id');
    }

    /**
     * Relación muchos a uno con ImageType.
     */
    public function imageType(): BelongsTo
    {
        return $this->belongsTo(ImageType::class, 'image_type_id');
    }

    /**
     * Relación muchos a muchos con CertificationGroup.
     */
    public function certificationGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            CertificationGroup::class,
            'certification_group_image', // Tabla pivot
            'image_id',                  // Clave foránea de Image en la tabla pivot
            'certification_group_id'     // Clave foránea de CertificationGroup en la tabla pivot
        )->withTimestamps();             // Incluye `created_at` y `updated_at` de la tabla pivot
    }
}
