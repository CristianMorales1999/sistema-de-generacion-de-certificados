<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FontSize extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'font_sizes';

    protected $fillable = ['size'];

    public function fontConfigurations():HasMany
    {
        return $this->hasMany(FontConfiguration::class);
    }
}
