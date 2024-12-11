<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CertificateStatus extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'certificate_statuses';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relación uno a muchos con Certificate.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'certificate_status_id');
    }
}
