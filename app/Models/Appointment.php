<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $fillable = [
        'amount',
        'date',
        'comments',
        'patient_id',
        'doctor_id',
        'procedure_id',
        'status',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Cita';

                break;
            case 1:
                return 'Llamada pendiente';

                break;
            case 2:
                return 'Paciente llamara';

                break;
            case 3:
                return 'Otro';

                break;
            default:
                // code...
                break;
        }
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function refferers()
    {
        return $this->hasMany('App\Models\Referrer');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Models\Procedure');
    }
}