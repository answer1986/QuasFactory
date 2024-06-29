<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRRHH extends Model
{
 
    use HasFactory;
    protected $table = 'rrhh';

    protected $fillable = [
        'start_date',
        'end_date',
        'induccion_completa',
        'rotacion_personal',
        'total_trabajadores_periodo',
        'clima_laboral',
        'total_encuestas_clima',
        'escalafon_actualizacion',
        'ausentismo_laboral',
        'dotacion_total_periodo',
        'horas_extras',
        'total_horas_norma',
        'atraso_periodo',
        'total_horas_trabajadas',
    ];
}

