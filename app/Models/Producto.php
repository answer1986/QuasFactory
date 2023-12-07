<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    
    const PROCESO_ESTRUCCION = 'estruccion';
    const PROCESO_SELLADO = 'sellado';
    const PROCESO_MICRO_PERFORADO = 'micro perforado';

    public static $tiposDeProceso = [
        self::PROCESO_ESTRUCCION,
        self::PROCESO_SELLADO,
        self::PROCESO_MICRO_PERFORADO,
    ];
    
    protected $fillable = [
        'nombre',
        'material_base',
        'pintura',
        'medida',
        'ancho',
        'observaciones',
        'foto',
    ];
}
