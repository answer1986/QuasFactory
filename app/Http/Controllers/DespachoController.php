<?php

namespace App\Http\Controllers;

use App\Models\ProductoTerminado;
use App\Models\Producto; // Importa el modelo de Producto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoTerminadoController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'numero_oc' => 'required|string',
            'producto_id' => 'required|string',
            'unidades' => 'required|integer',
            'fecha' => 'required|date',
            'codigo_producto' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);
        
        // Crea un nuevo producto terminado con los datos del formulario
        $productoTerminado = new ProductoTerminado([
            'numero_oc' => $request->input('numero_oc'),
            'producto_id' => $request->input('producto_id'),
            'unidades' => $request->input('unidades'),
            'fecha' => $request->input('fecha'),
            'codigo_producto' => $request->input('codigo_producto'),
            'observaciones' => $request->input('observaciones'),
        ]);

        // Guarda el producto terminado
        $productoTerminado->save();

        // Ahora, debes descontar las unidades del producto correspondiente en la tabla de Productos
        $producto = Producto::findOrFail($request->input('producto_id')); // Encuentra el producto correspondiente
        $producto->cantidad -= $request->input('unidades'); // Resta las unidades
        $producto->save(); // Guarda el producto actualizado

        // Regresa a la vista de creación con un mensaje de éxito
        return redirect()->route('producto-terminado.create')->with('success', 'Producto Terminado creado exitosamente!');
    }

    // Otros métodos del controlador como edit, update, destroy, etc., si es necesario
}
