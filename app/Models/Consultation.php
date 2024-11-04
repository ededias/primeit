<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    public function patient()
    {
        return $this->belongsToMany(Patient::class);
    }
}
