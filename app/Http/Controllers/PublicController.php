<?php

namespace App\Http\Controllers;

use App\Models\ProductoTerminado;
use App\Models\IngresoMateriaPrima;

class PublicController extends Controller
{
    public function mostrarProductos()
    {

    $productosTerminados = ProductoTerminado::paginate(15); // Ejemplo para 10 items por página
    $materiasPrimas = IngresoMateriaPrima::paginate(15);


        return view('status', compact('productosTerminados', 'materiasPrimas'));
    }
}
