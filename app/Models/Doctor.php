<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $fillable = [
        'last_name',
        'name',
        'full_name',
        'birth_date',
        'phone_number',
        'gender',
        'email',
        'titles',
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
}