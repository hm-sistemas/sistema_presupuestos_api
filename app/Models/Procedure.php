<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    public $fillable = [
        'name',
    ];

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function surgeries()
    {
        return $this->hasMany('App\Models\Surgery');
    }
}