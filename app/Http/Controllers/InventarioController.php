<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\IngresoMateriaPrima;
use App\Models\ProductoTerminado;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Carbon\Carbon;

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
        Log::info('Datos recibidos:', $request->all()); // Agregar esto

        $barcode = $request->input('codigo_barra');

        try {
            $inventario = $this->crearOActualizarInventario($barcode, $request->input('cantidad_sacos'));
            $this->agregarAlResumen($inventario);
            return back()->with('success', 'Inventario actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            Log::error('Error de validación: Código de barras no encontrado.', ['barcode' => $barcode]);
            return back()->with('error', 'El código de barras no coincide con materias primas ni productos terminados.');
        } catch (Exception $e) {
            Log::error('Error al procesar el inventario.', ['error' => $e->getMessage()]);
            return back()->with('error', 'Se produjo un error al procesar el inventario. Por favor, inténtalo de nuevo.');
        }
    }

    private function crearOActualizarInventario($barcode, $cantidadSacos)
    {
        $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $barcode)->first();
        $productoTerminado = ProductoTerminado::where('codigo_producto', $barcode)->first();

        if ($ingresoMateriaPrima || $productoTerminado) {
            $inventario = new Inventario();
            if ($ingresoMateriaPrima) {
                $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id;
            }
            if ($productoTerminado) {
                $inventario->producto_terminado_id = $productoTerminado->id;
            }
            $inventario->cantidad_sacos = $cantidadSacos;
            $inventario->fecha_inicio = Session::get('fecha_inicio_inventario', now()->toDateString());
            $inventario->save();
            return $inventario;
        } else {
            throw new ModelNotFoundException('Código de barras no encontrado.');
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
        // Recupera la fecha de inicio del inventario y la fecha actual
        $fechaInicio = Session::get('fecha_inicio_inventario');
        $fechaFin = now()->toDateString();
    
        // Decodifica los datos del inventario enviados desde el formulario
        $datosInventario = json_decode($request->input('datos_inventario'), true);
    
        // Itera sobre cada ítem del inventario
        foreach ($datosInventario as $item) {
            // Busca el ingreso de materia prima y el producto terminado correspondiente al código
            $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $item['codigo'])->first();
            $productoTerminado = ProductoTerminado::where('codigo_producto', $item['codigo'])->first();
    
            // Crea una nueva instancia del modelo Inventario
            $inventario = new Inventario();
    
            if ($ingresoMateriaPrima) {
                // Asigna el ID de la materia prima y asegúrate de que el ID del producto terminado sea null
                $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id;
                $inventario->producto_terminado_id = null;
            } elseif ($productoTerminado) {
                // Asigna el ID del producto terminado y asegúrate de que el ID de la materia prima sea null
                $inventario->producto_terminado_id = $productoTerminado->id;
                $inventario->ingreso_materia_prima_id = null;
    
                // Asigna los campos adicionales solo para productos terminados
                $inventario->turno = $item['turno'] ?? null;
                $inventario->num_maquina = $item['num_maquina'] ?? null;
                $inventario->operario = $item['operario'] ?? null;
                $inventario->nueva_fecha = $this->convertirFecha($item['nueva_fecha'] ?? null);
            }
    
            // Asigna los campos comunes a todos los ítems del inventario
            $inventario->cantidad_sacos = $item['cantidad'];
            $inventario->fecha_inicio = $fechaInicio;
            $inventario->fecha_fin = $fechaFin;
    
            // Guarda el ítem del inventario en la base de datos
            if (!$inventario->save()) {
                Log::error("Error al guardar el inventario para el código: {$item['codigo']}");
            } else {
                Log::info("Inventario guardado con ID: {$inventario->id}");
            }
        }
    
        // Limpia los datos de la sesión relacionados con el inventario
        Session::forget('fecha_inicio_inventario');
        Session::forget('inventario_resumen');
    
        // Redirige de vuelta con un mensaje de éxito
        return back()->with('success', 'Inventario finalizado correctamente.');
    }
    
    

    public function validarCodigoBarra(Request $request)
    {
        $barcodeCompleto = $request->query('codigo_barra');
        $barcode = explode(';', $barcodeCompleto)[0];

        $existeMateriaPrima = IngresoMateriaPrima::where('barcode_value', $barcode)->exists();
        $existeProductoTerminado = ProductoTerminado::where('codigo_producto', $barcode)->exists();

        return response()->json([
            'existeMateriaPrima' => $existeMateriaPrima,
            'existeProductoTerminado' => $existeProductoTerminado
        ]);
    }


    public function procesarCadena(Request $request)
    {
        $cadena = $request->input('cadena');
        Log::info("Procesando cadena: {$cadena}");

        try {
            $partes = explode(';', $cadena);
            Log::info("Partes de la cadena: ", $partes);

            $barcode = $partes[0];
            $productoTerminado = ProductoTerminado::where('codigo_producto', $barcode)->first();

            if (!$productoTerminado) {
                Log::warning("Producto terminado no encontrado para el código: {$barcode}");
                return response()->json(['error' => 'Producto terminado no encontrado.'], 404);
            }

            $inventario = new Inventario();
            $inventario->producto_terminado_id = $productoTerminado->id;
            $inventario->turno = $partes[1] ?? null;
            $inventario->num_maquina = $partes[2] ?? null;
            $inventario->operario = $partes[3] ?? null;
            $inventario->nueva_fecha = $this->convertirFecha($partes[4] ?? null);

            $inventario->save();
            Debugbar::info($inventario->save());
            Log::info("Inventario guardado con ID: {$inventario->id}");

            return response()->json(['success' => 'Inventario procesado y guardado correctamente.']);
        } catch (Exception $e) {
            Log::error("Error al procesar la cadena de inventario: {$e->getMessage()}");
            return response()->json(['error' => 'Error al procesar la cadena de inventario.'], 500);
        }
    }

    private function convertirFecha($fecha)
    {
        return $fecha ? Carbon::createFromFormat('Y-m-d', $fecha)->format('Y-m-d') : null;
    }
}
