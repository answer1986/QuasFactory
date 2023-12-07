<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenDeTrabajo; 

class TableroProduccionController extends Controller
{
    public function index()
    {
        // Aquí puedes recuperar cualquier dato que necesites para tu vista.
        // Por ejemplo, podrías querer recuperar todas las órdenes de trabajo para mostrarlas en un tablero.
        $ordenes = OrdenDeTrabajo::with(['cliente', 'producto'])->get();

        return view('produccion.tablero', compact('ordenes')); // Asegúrate de tener una vista con este nombre.
    }
}
