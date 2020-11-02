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

    public function rol()
    {
        switch ($this->role) {
            case 0:
                return 'Cirujano';

                break;
            case 1:
                return 'Anestesiologo';

                break;
            default:
                // code...
                break;
        }
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Models\Surgery');
    }
}