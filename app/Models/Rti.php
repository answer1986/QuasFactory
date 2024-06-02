<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rti extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'planos_tecnicos_productos',
        'total_productos_comercializados',
        'planos_tecnicos_almacenados',
        'total_maquinarias_industrial',
        'planos_tecnicos_maquinaria',
        'planos_tecnicos_almacenados_maquinaria',
        'total_maquinaria_existente',
        'manuales_maquinaria_productiva',
        'total_maquinaria_productiva',
        'usuarios_requerimientos_pendientes',
        'total_usuarios_red',
        'licencias_activas',
        'total_softwares_usados',
        'plano_electrico_industrial',
        'plano_circuitos_informaticos',
        'planificacion_operaciones'
    ];
}
