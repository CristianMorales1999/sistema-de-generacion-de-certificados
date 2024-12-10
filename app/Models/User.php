<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'user_status_id',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'is_validated',
        'profile_image_url',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_validated' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación inversa con el modelo Person.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación muchos a muchos con el modelo Role.
     */
    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
                    ->withTimestamps();
    }

    /**
     * Relación uno a muchos con el modelo UserStatus.
     */
    public function userStatus():BelongsTo
    {
        return $this->belongsTo(UserStatus::class);
    }

    /**
     * Relación uno a muchos con el modelo CertificationGroup.
     */
    public function certificationGroupsCreated():HasMany
    {
        return $this->hasMany(CertificationGroup::class, 'created_by_user_id');
    }

    public function certificationGroupsCertified():HasMany
    {
        return $this->hasMany(CertificationGroup::class, 'certified_by_user_id');
    }
}
