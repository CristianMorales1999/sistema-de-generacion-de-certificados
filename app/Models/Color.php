<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'colors';

    protected $fillable = ['name', 'hexa_code'];

    public function startFontConfigurations():HasMany
    {
        return $this->hasMany(FontConfiguration::class, 'start_color_id');
    }

    public function endFontConfigurations():HasMany
    {
        return $this->hasMany(FontConfiguration::class, 'end_color_id');
    }
}
