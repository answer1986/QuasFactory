<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaquinaReserva extends Model
{
    use HasFactory;  

    protected $fillable = [
        'maquina_tipo',
        'maquina_nombre',
        'fecha_reserva',
        'orden_trabajo_id'
    ];


    public function ordenTrabajo()
    {
        return $this->belongsTo('App\Models\OrdenTrabajo', 'orden_trabajo_id');
    }
    
}