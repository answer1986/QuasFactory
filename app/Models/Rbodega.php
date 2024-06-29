<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rbodega extends Model
{
    use HasFactory;
    protected $table = 'rbodega';

    protected $fillable = [
        'start_date',
        'end_date',
        'retiro_produccion',
        'total_pallets_retirados',
        'envio_inventario',
        'total_inventarios_planificados',
        'verificacion_materias_primas',
        'total_verificaciones_planificadas',
        'verificacion_producto_terminado',
        'cumplimiento_envio_programacion',
        'total_programas_despacho',
        'cumplimiento_estandar_embalaje',
        'total_pallet_periodo',
        'cumplimiento_programa_despacho',
        'total_despachos_planificados',
        'eficiencia_emision_documentos',
        'total_despachos_ejecutados',
        'gestion_retiro_scrap',
        'total_retiros_scrap',
    ];
}

