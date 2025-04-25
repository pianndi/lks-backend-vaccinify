<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    public function spotVaccine()
    {
        return $this->hasMany(SpotVaccine::class, 'spot_id');
    }
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'spot_id');
    }
    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id');
    }
}
