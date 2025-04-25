<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Society extends Model
{
    use HasApiTokens;

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id');
    }
}
