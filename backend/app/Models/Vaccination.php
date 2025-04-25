<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spot_id');
    }
    public function vaccinator()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }
}
