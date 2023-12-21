<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\IngresoMateriaPrima;
use App\Models\ProductoTerminado;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;


use Session;

class InventarioController extends Controller
{
    public function index()
    {
        $fechaInicio = Session::get('fecha_inicio_inventario', null);
        return view('bodega.inventario');
    }

    public function iniciarInventario()
    {
        Session::put('fecha_inicio_inventario', now()->toDateString());
        return redirect()->route('inventario.index')->with('success', 'Inventario iniciado.');
    }
    public function procesar(Request $request)
    {
        $barcode = $request->input('codigo_barra');

        try {
            $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $barcode)->firstOrFail();

            $productoTerminados = ProductoTerminados::where('codigo_producto', $barcode)->first(); // nuevo

            if ($ingresoMateriaPrima) {

                $inventario = new Inventario();
                $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id;
                $inventario->cantidad_sacos = $request->input('cantidad_sacos');
                $inventario->fecha_inicio = Session::get('fecha_inicio_inventario', $request->input('fecha_inicio'));
                $inventario->save();

                $this->agregarAlResumen($inventario);

                return back()->with('success', 'Inventario actualizado correctamente.');
            
            } elseif ($productoTerminado) {
                // Lógica para manejar producto terminado
                $inventario = new Inventario();
                $inventario->producto_terminado_id = $productoTerminado->id; // Asegúrate de que esta columna exista en tu tabla de Inventario
                $inventario->cantidad_sacos = $request->input('cantidad_sacos');
                $inventario->fecha_inicio = Session::get('fecha_inicio_inventario', now()->toDateString());
                $inventario->save();
    
                $this->agregarAlResumen($inventario);
    
                return back()->with('success', 'Inventario actualizado correctamente para producto terminado.');
            } else {
                throw new ModelNotFoundException('El código de barras no coincide con materias primas ni productos terminados.');
            }
    
        } catch (ModelNotFoundException $e) {
            Log::error('Error de validación: Código de barras no encontrado.', ['barcode' => $barcode]);
            return back()->with('error', 'El código de barras no coincide con materias primas ni productos terminados.');
        } catch (Exception $e) {
            Log::error('Error al procesar el inventario.', ['error' => $e->getMessage()]);
            return back()->with('error', 'Se produjo un error al procesar el inventario. Por favor, inténtalo de nuevo.');
        }
    }

   

    private function agregarAlResumen(Inventario $inventario)
    {
        $resumen = Session::get('inventario_resumen', []);
        array_push($resumen, $inventario->toArray());
        Session::put('inventario_resumen', $resumen);
    }

        public function finalizarInventario(Request $request)
    {
        $fechaInicio = Session::get('fecha_inicio_inventario');
        $fechaFin = now()->toDateString();

        $datosInventario = json_decode($request->input('datos_inventario'), true);

        foreach ($datosInventario as $item) {
            $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $item['codigo'])->first();
            if ($ingresoMateriaPrima) {
                $inventario = new Inventario();
                $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id; 
                $inventario->cantidad_sacos = $item['cantidad'];
                $inventario->fecha_inicio = $fechaInicio;
                $inventario->fecha_fin = $fechaFin;
                $inventario->save();
            } else {
                
            }

        // Clear the session data
        Session::forget('fecha_inicio_inventario');
        Session::forget('inventario_resumen');

    }
    return back()->with('success', 'Inventario finalizado correctamente.');

    }
   /* public function validarCodigoBarra(Request $request)
    {
        $barcode = $request->query('codigo_barra');
        $existe = IngresoMateriaPrima::where('barcode_value', $barcode)->exists();    
        return response()->json(['existe' => $existe]);
    }*/

    public function validarCodigoBarra(Request $request)
{
    $barcode = $request->query('codigo_barra');
    $existeMateriaPrima = IngresoMateriaPrima::where('barcode_value', $barcode)->exists();
    $existeProductoTerminado = ProductoTerminado::where('codigo_producto', $barcode)->exists();

    return response()->json([
        'existeMateriaPrima' => $existeMateriaPrima,
        'existeProductoTerminado' => $existeProductoTerminado
    ]);
}


}