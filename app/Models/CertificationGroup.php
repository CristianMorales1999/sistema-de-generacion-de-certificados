<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Relación muchos a uno con CertificationType.
     */
    public function certificationType(): BelongsTo
    {
        return $this->belongsTo(CertificationType::class, 'certification_type_id');
    }

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
     * Relación muchos a uno con Area.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Relación uno a muchos con Certificate.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'certification_group_id');
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

    /**
     * Relación muchos a muchos con Date.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dates(): BelongsToMany
    {
        return $this->belongsToMany(
            Date::class,
            'certification_group_date', // Nombre de la tabla pivot
            'certification_group_id',  // Clave foránea para CertificationGroup en la tabla pivot
            'date_id'                  // Clave foránea para Date en la tabla pivot
        )->withTimestamps();           // Indica que la tabla pivot incluye `created_at` y `updated_at`
    }

    /**
     * Relación muchos a muchos con Image.
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'certification_group_image',  // Tabla pivot
            'certification_group_id',    // Clave foránea de CertificationGroup en la tabla pivot
            'image_id'                   // Clave foránea de Image en la tabla pivot
        )->withTimestamps();              // Incluye `created_at` y `updated_at` de la tabla pivot
    }

    /**
     * Relación muchos a muchos con SignatureImage.
     */
    public function signatureImages(): BelongsToMany
    {
        return $this->belongsToMany(
            SignatureImage::class,
            'certification_group_signature_image',
            'certification_group_id',
            'signature_image_id'
        )->withTimestamps();
    }
}
