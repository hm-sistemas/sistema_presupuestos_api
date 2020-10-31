<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgicalTeam extends Model
{
    public $fillable = [
        'role',
        'comments',
        'surgery_id',
        'doctor_id',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }
}