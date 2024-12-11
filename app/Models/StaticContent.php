<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaticContent extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'static_contents';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'certification_type_id',
        'used_dates_count',
        'content',
    ];

    /**
     * Relación muchos a uno con CertificationType.
     */
    public function certificationType(): BelongsTo
    {
        return $this->belongsTo(CertificationType::class, 'certification_type_id');
    }
}
