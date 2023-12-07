<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoMateriaPrima extends Model
{
    use HasFactory;  

    protected $table = 'ingreso_materia_prima';

    protected $fillable = [
        'tipo_materia',
        'cantidad',
        'proveedor',
        'fecha_ingreso',
        'descripcion',
        'barcode_path', 
        'barcode_value',
        'imagen_referencia',
    ];
}