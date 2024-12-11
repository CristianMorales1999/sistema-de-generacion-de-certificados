<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CertificationType extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'certification_types';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relación uno a muchos con StaticContent.
     */
    public function staticContents(): HasMany
    {
        return $this->hasMany(StaticContent::class, 'certification_type_id');
    }

    /**
     * Relación uno a muchos con CertificationGroup.
     */
    public function certificationGroups(): HasMany
    {
        return $this->hasMany(CertificationGroup::class, 'certification_type_id');
    }
}
