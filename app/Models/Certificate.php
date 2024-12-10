<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    //

    /**
     * Relación inversa con el modelo Person.
     */
    public function person():BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
