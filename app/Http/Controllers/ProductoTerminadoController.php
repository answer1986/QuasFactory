<?php

namespace App\Http\Controllers;

use App\Models\ProductoTerminado;
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
        
        /* -- quitado javiera -->
        /**   'hora' => 'date_format:H:i',
         *    'porcentaje_avance' => 'numeric',
         *    'kilos' => 'numeric',
         */

        // Crea un nuevo producto terminado con los datos del formulario
        $productoTerminado = new ProductoTerminado([
            'numero_oc' => $request->input('numero_oc'),
            'producto_id' => $request->input('producto_id'),
            'unidades' => $request->input('unidades'),
            'fecha' => $request->input('fecha'),
            'codigo_producto' => $request->input('codigo_producto'),
            'observaciones' => $request->input('observaciones'),
        ]);

        $productoTerminado->save();

        // Regresa a la vista de creación con un mensaje de éxito
        return redirect()->route('producto-terminado.store')->with('success', 'Producto Terminado creado exitosamente!');
    }

    /* modificaciones javiera */

    /* 'hora' => $request->input('hora'),
       'kilos' => $request->input('kilos'),
       'porcentaje_avance' => $request->input('porcentaje_avance'),








    public function show($id)
    {
        $productoTerminado = ProductoTerminado::findOrFail($id);
        return view('producto-terminado.show', compact('productoTerminado'));
    }

    public function edit($id)
    {
        $productoTerminado = ProductoTerminado::findOrFail($id);
        return view('producto-terminado.edit', compact('productoTerminado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_oc' => 'required|string',
            'kilos' => 'required|numeric',
            'producto_id' => 'required|exists:productos,id',
            'unidades' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'codigo_producto' => 'required|string',
            'observaciones' => 'nullable|string',
            'porcentaje_avance' => 'required|numeric',
        ]);

        $productoTerminado = ProductoTerminado::findOrFail($id);
        $productoTerminado->update([
            'numero_oc' => $request->input('numero_oc'),
            'kilos' => $request->input('kilos'),
            'producto_id' => $request->input('producto_id'),
            'unidades' => $request->input('unidades'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'codigo_producto' => $request->input('codigo_producto'),
            'observaciones' => $request->input('observaciones'),
            'porcentaje_avance' => $request->input('porcentaje_avance'),
        ]);

        return redirect()->route('producto-terminado.edit', $id)->with('success', 'Producto Terminado actualizado exitosamente!');
    }

    public function destroy($id)
    {
        try {
            // Encuentra y elimina el producto terminado con el ID proporcionado
            $productoTerminado = ProductoTerminado::findOrFail($id);
            $productoTerminado->delete();

            // Redirige a la vista de edición con un mensaje de éxito
            return redirect()->route('producto-terminado.edit')->with('status', 'Producto Terminado borrado exitosamente!');
        } catch (\Exception $exception) {
            // Registra el error en el log
            Log::error("Error al borrar producto terminado: {$exception->getMessage()}");

            // Redirige de nuevo con un mensaje de error
            return redirect()->route('producto-terminado.edit')->withErrors(['error' => 'Hubo un error al borrar el producto terminado. Por favor intenta nuevamente.']);
        }
    }
    public function index()
    {
        $productoTerminados = ProductoTerminado::all();
        return view('producto-terminado.index', compact('productoTerminados'));
    }

    public function create()
    {
        return view('producto-terminado.create');
    }*/
}
