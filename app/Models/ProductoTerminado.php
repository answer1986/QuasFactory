<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductoTerminado extends Model
{
     protected $table = 'producto_terminados';

    protected $fillable = [
        'numero_oc',
        'kilos',
        'producto_id',
        'unidades',
        'fecha',
        'hora',
        'codigo_producto',
        'observaciones',
        'porcentaje_avance',
    ];

    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
