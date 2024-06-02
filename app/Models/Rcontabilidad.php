<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rcontabilidad extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'movimientos_identificados',
        'movimientos_totales',
        'activo_circulante',
        'pasivo_circulante',
        'ventas_netas',
        'descuentos',
        'rebajas_devoluciones',
        'saldo_cuentas_cobrar',
        'deudas_vencidas',
        'activo_total',
        'deuda_largo_plazo',
        'deuda_total',
        'capital_total',
        'activo_corriente',
        'inventario',
        'pasivo_corriente',
    ];
}
