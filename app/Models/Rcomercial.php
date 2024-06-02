<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'variacion_prog_dist',
        'total_prog_dist_solicitadas',
        'clientes_finales',
        'clientes_nuevos',
        'clientes_iniciales',
        'clientes_antiguos',
        'encuestas_satisfaccion',
        'total_encuestas',
        'carpetas_completas',
        'total_clientes',
        'devoluciones_productos',
        'total_entregas',
        'dias_espera',
        'total_reclamos_consultas',
    ];
}
