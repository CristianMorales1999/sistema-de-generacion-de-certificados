<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'certificates';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'certification_group_id',
        'certificate_status_id',
        'code',
        'is_validated',
    ];

    /**
     * Relación muchos a uno con Person.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación muchos a uno con CertificationGroup.
     */
    public function certificationGroup(): BelongsTo
    {
        return $this->belongsTo(CertificationGroup::class, 'certification_group_id');
    }

    /**
     * Relación muchos a uno con CertificateStatus.
     */
    public function certificateStatus(): BelongsTo
    {
        return $this->belongsTo(CertificateStatus::class, 'certificate_status_id');
    }
}
