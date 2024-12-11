<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CertificateTextType extends Model
{
    use HasFactory;
    
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'certificate_text_types';

    protected $fillable = ['name'];

    public function certificationGroups():BelongsToMany
    {
        return $this->belongsToMany(
            CertificationGroup::class,
            'certificate_text_type_certification_group',
            'certificate_text_type_id',
            'certification_group_id'
        )->withPivot(['font_configuration_id'])
        ->withTimestamps();
    }
}
