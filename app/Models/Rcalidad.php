<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rcalidad extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'informes_calidad_extrusion',
        'informes_calidad_sellado',
        'informes_alergenos',
        'registros_alergenos_entregados',
        'registros_alergenos_programados',
        'inducciones_realizadas',
        'inducciones_correspondientes',
        'validaciones_masa_patron',
        'validaciones_correspondientes',
        'registros_revision_trampas',
        'registros_charlas_bpm',
        'charlas_bpm_programadas',
        'auditorias_internas',
        'auditorias_internas_programadas',
        'funcionarios_capacitados',
        'total_funcionarios_empresa',
        'muestreos_calidad_turno',
        'muestreos_calidad_totales'
    ];
}
