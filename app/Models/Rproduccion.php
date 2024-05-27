<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rproduccion extends Model
{
    use HasFactory;
    protected $table = 'rproduccion';


    protected $fillable = [
        'start_date',
        'end_date',
        'kilostotales',
        'kilosscrap',
        'kilosprogramados',
        'kiloproducto',
        'totalkilosxmaquina',
        'numerocambioxprog',
        'kilosprodprog',
        'kilosscrapproce',
        'kiloproducxmaqperiod',
        'machine_type',
        'orden_produccion',
        'kilos_fabricados',
        'kilos_programados',
        'machine_id',
    ];
}


