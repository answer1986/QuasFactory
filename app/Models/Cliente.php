<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'foto',
        'nombre',
        'rut',
        'razon_social',
        'giro',
        'telefono',
        'correo_electronico',
        'direccion',
        'pais',
        'credito',
        'otros',
        'fecha_creacion' // Recuerda usar guiones bajos en lugar de espacios para los nombres de columnas
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'fecha_creacion'
    ];

  /*se le agrega para que pueda ser utilizado */
        public function ordenesDeTrabajo()
    {
        return $this->hasMany(OrdenDeTrabajo::class);
    }

}
