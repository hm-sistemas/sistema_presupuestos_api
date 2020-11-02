<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    public $fillable = [
        'appointment_id',
        'doctor_id',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment');
    }
}