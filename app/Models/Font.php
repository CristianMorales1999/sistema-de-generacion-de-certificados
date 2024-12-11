<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Font extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'fonts';

    protected $fillable = ['name'];

    public function fontConfigurations():HasMany
    {
        return $this->hasMany(FontConfiguration::class);
    }
}
