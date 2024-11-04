<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;
class Patient extends Model
{
    //

    protected $fillable = [
        "name",
        "email",
        "patient_name",
        "age",
        "type",
        "symptoms",
        "date",
        "reception"
    ];

    

    public function users()
    {
        return $this->belongsToMany(User::class, 'patient_user');
    }

}
