<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingreso_materia_prima_id',
        'cantidad_sacos',
        'fecha_inicio',
        'fecha_fin',
        'turno',
        'num_maquina',
        'operario',
        'nueva_fecha',
    ];

    public function ingresoMateriaPrima()
    {
        return $this->belongsTo(IngresoMateriaPrima::class);
    }
}
