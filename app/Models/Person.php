<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'people';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'dni',
        'first_name',
        'last_name',
        'personal_email',
        'institutional_email',
        'phone_number',
        'gender',
    ];

    /**
     * Los atributos que deberían ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'gender' => 'string', // Para el ENUM 'masculino', 'femenino'
    ];

    /**
     * Relación uno a uno con el modelo User.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'person_id');
    }

    /**
     * Relación uno a uno con el modelo SignatureImage.
     */
    public function signatureImage(): HasOne
    {
        return $this->hasOne(SignatureImage::class, 'person_id');
    }

    /**
     * Relación uno a muchos con el modelo Certificate.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'person_id');
    }

    /**
     * Relación muchos a muchos con el modelo Area.
     *
     * Incluye atributos adicionales desde la tabla pivot.
     */
    public function areas():BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'area_person', 'person_id', 'area_id')
                    ->withPivot(['start_date', 'end_date', 'is_activated'])
                    ->withTimestamps();
    }
}
