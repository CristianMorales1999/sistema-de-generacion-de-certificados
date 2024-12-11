<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SignatureImage extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'signature_images';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'position_id',
        'url',
    ];

    /**
     * Relación uno a uno con Person.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación muchos a uno con Position.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Relación muchos a muchos con CertificationGroup.
     */
    public function certificationGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            CertificationGroup::class,
            'certification_group_signature_image',
            'signature_image_id',
            'certification_group_id'
        )->withTimestamps();
    }
}
