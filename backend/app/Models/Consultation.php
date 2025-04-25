<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
