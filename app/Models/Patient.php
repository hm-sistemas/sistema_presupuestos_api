<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $fillable = [
        'last_name',
        'name',
        'full_name',
        'birth_date',
        'phone_number',
        'gender',
        'email',
    ];

    public function gender()
    {
        switch ($this->gender) {
            case 0:
                return 'Masculino';

                break;
            case 1:
                return 'Femenino';

                break;
            default:
                // code...
                break;
        }
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function surgeries()
    {
        return $this->hasMany('App\Models\Surgery');
    }
}