<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpotVaccine extends Model
{
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }
}
