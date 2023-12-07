<?php

namespace App\Http\Controllers;

use App\Models\ProductoTerminado;
use App\Models\IngresoMateriaPrima;

class PublicController extends Controller
{
    public function mostrarProductos()
    {
        $productosTerminados = ProductoTerminado::all();
        $materiasPrimas = IngresoMateriaPrima::all();

        return view('status', compact('productosTerminados', 'materiasPrimas'));
    }
}
