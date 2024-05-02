<?php

namespace App\Http\Controllers;

use App\Models\ProductoTerminado;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DespachoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'orden_trabajo_id' => 'required',
            'venta_id' => 'required',
            'producto_terminado_id' => 'required',
            'cantidad_rebajada' => 'required|numeric',
        ]);
    
        // Asumiendo que 'producto_terminado_id' se refiere a 'codigo_producto' para encontrar el Producto Terminado
        $productoTerminado = ProductoTerminado::where('codigo_producto', $validated['producto_terminado_id'])->first();
        $materiaPrima = IngresoMateriaPrima::where('id', $validated['orden_trabajo_id'])->first(); // Asumiendo la relación por 'orden_trabajo_id'
    
        if ($productoTerminado && $materiaPrima) {
            $productoTerminado->unidades -= $validated['cantidad_rebajada'];
            $materiaPrima->cantidad -= $validated['cantidad_rebajada']; // Asumiendo que 'cantidad' es el campo a reducir
    
            $productoTerminado->save();
            $materiaPrima->save();
    
            return redirect()->back()->with('success', 'Producto y materia prima rebajados correctamente.');
        }
    
        return redirect()->back()->with('error', 'No se pudo encontrar el producto o la materia prima especificada.');
    }
}    