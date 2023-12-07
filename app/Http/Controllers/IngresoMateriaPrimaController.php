<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoMateriaPrima;
use Milon\Barcode\DNS1D;
use Intervention\Image\Facades\Image;




class IngresoMateriaPrimaController extends Controller
{
  

    public function create()
    {
        return view('bodega.materia.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'tipo_materia' => 'required|string',
            'cantidad' => 'required|numeric',
            'sacos' => 'required|numeric',
            'proveedor' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'descripcion' => 'nullable|string',
            'imagen_referencia' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
    
        // Crear el registro
        $ingreso = IngresoMateriaPrima::create($request->all());
        $ingreso->sacos = $request->input('sacos'); 

        $barcodeValue = $ingreso->id . now()->timestamp;  
        $barcodeData = DNS1D::getBarcodePNG($barcodeValue, "C128", 3, 33);
        $path = storage_path('app/public/barcodes/') . $barcodeValue . '.png';
        
        $decodedImage = base64_decode($barcodeData);
        file_put_contents($path, $decodedImage);
        $ingreso->barcode_path = 'barcodes/' . $barcodeValue . '.png';
        $ingreso->barcode_value = $barcodeValue; 
        
        if ($request->hasFile('imagen_referencia')) {
            $imagenPath = $request->file('imagen_referencia')->store('imagenes_referencia', 'public');
            $ingreso->imagen_referencia = $imagenPath;
        }
    
        
        
        
        $ingreso->save();
    
        session(['barcode' => $path]);
        session(['ingreso' => $ingreso]);
    
        return redirect()->route('bodega.materia')->with('success', 'Ingreso de materia prima registrado exitosamente');
    }
    
    

    public function show($id)
    {
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        return view('bodega.materia.show', ['ingreso' => $ingreso]);
    }

    public function edit($id)
    {
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        return view('bodega.materia.edit', ['ingreso' => $ingreso]);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'tipo_materia' => 'required|string',
            'cantidad' => 'required|numeric',
            'sacos' => 'required|numeric',    
            'proveedor' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        // Buscar el ingreso de materia prima por ID
        $ingreso = IngresoMateriaPrima::findOrFail($id);

        // Actualizar los datos del ingreso de materia prima en la base de datos
        $ingreso->tipo_materia = $request->input('tipo_materia');
        $ingreso->cantidad = $request->input('cantidad');
        $ingreso->sacos = $request->input('sacos'); 
        $ingreso->proveedor = $request->input('proveedor');
        $ingreso->fecha_ingreso = $request->input('fecha_ingreso');
        $ingreso->descripcion = $request->input('descripcion');
        $ingreso->save();

        return redirect()->route('materia.index')->with('success', 'Ingreso de materia prima actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Buscar el ingreso de materia prima por ID y eliminarlo de la base de datos
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        $ingreso->delete();

        return redirect()->route('materia.index')->with('success', 'Ingreso de materia prima eliminado exitosamente');
    }

        public function searchByBarcode($barcodeValue)
    {
        $ingreso = IngresoMateriaPrima::where('barcode_value', $barcodeValue)->first();

        if ($ingreso) {
            return view('bodega.materia.show', ['ingreso' => $ingreso]);
        } else {
            // Retornar un mensaje indicando que no se encontró el código de barras
        }
    }
    

}
