<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'positions';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_internal_position'
    ];

    /**
     * Relación uno a muchos con SignatureImage.
     */
    public function signatureImages(): HasMany
    {
        return $this->hasMany(SignatureImage::class, 'position_id');
    }
}
