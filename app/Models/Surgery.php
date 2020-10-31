<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    public $fillable = [
        'date',
        'comments',
        'patient_id',
        'procedure_id',
        'status',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Pendiente';

                break;
            case 1:
                return 'Realizada';

                break;
            case 2:
                return 'Cancelada';

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
        return $this->belongsTo('App\Patient');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }

    public function doctors()
    {
        return $this->hasManyThrough('App\Doctor', 'App\SurgicalTeam');
    }
}