<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    protected $table = 'scrap';
    protected $fillable = [
        'numero_oc',
        'kilos',
        'otros',
        'fecha',
        'hora',
    ];
}
