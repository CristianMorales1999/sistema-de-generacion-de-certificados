<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class FontConfiguration extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'font_configurations';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'font_id',
        'font_size_id',
        'font_style_id',
        'start_color_id',
        'end_color_id',
    ];

    /**
     * Relación muchos a uno con el modelo Font (debes crear este modelo si no existe).
     */
    public function font(): BelongsTo
    {
        return $this->belongsTo(Font::class, 'font_id');
    }

    /**
     * Relación muchos a uno con el modelo FontSize.
     */
    public function fontSize(): BelongsTo
    {
        return $this->belongsTo(FontSize::class, 'font_size_id');
    }

    /**
     * Relación muchos a uno con el modelo FontStyle (debes crear este modelo si no existe).
     */
    public function fontStyle(): BelongsTo
    {
        return $this->belongsTo(FontStyle::class, 'font_style_id');
    }

    /**
     * Relación muchos a uno con el modelo Color para el color inicial.
     */
    public function startColor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'start_color_id');
    }

    /**
     * Relación muchos a uno con el modelo Color para el color final (puede ser nulo).
     */
    public function endColor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'end_color_id');
    }

    /**
     * Obtener los registros de la tabla pivot relacionados con esta instancia de FontConfiguration.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPivotRecordsByFontConfigurationId()
    {
        // Usar el id de la instancia actual (esto se refiere al id de FontConfiguration)
        return CertificationGroup::select(
            'certificate_text_type_certification_group.*'
        )
        ->join(
            'certificate_text_type_certification_group',
            'certification_groups.id',
            '=',
            'certificate_text_type_certification_group.certification_group_id'
        )
        ->where('certificate_text_type_certification_group.font_configuration_id', $this->id) // Usar $this->id aquí
        ->get();
    }

    /**
     * Metodo 02 para Obtener los registros de la tabla pivot relacionados con esta instancia de FontConfiguration.
     *
     * @return stdClass
     */
    public function getPivotRecords()
    {
        // Usar el id de la instancia actual (esto se refiere al id de FontConfiguration)
        return DB::table('certificate_text_type_certification_group')
        ->where('font_configuration_id',$this->id)
        ->get();
    }
}
