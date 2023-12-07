<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeTrabajo extends Model
{
    use HasFactory;

    protected $table = 'orden_trabajo';
    protected $fillable = [
        'numero_oc',
        'tipo_proceso',
        'numero_orden_compra',
        'cliente_id',
        'fecha',
        'producto_id',
        'cantidad',
        'id_foto',
        'fecha_comprometida',
        'status_oc',
        'porcentaje_progreso',
        'observaciones',
        'extrusora',
        'selladora',
        'microperforadora',
        'barcode_value'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function maquinaReservas()
{
    return $this->hasMany(MaquinaReserva::class);
}

    
}


