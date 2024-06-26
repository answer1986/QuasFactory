<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PrdController extends Controller
{
    public function cargarImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image', 
        ]);

        $archivo = $request->file('imagen');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $path = $archivo->storeAs('public/imagenes', $nombreArchivo);

        $imagen = new Imagen();
        $imagen->nombre_archivo = $nombreArchivo;
        $imagen->save();

        return redirect()->route('mostrar-imagen-publica');
    }

    public function mostrarImagenPublica()
    {
        $imagen = Imagen::latest()->first();
        $imagenes = Imagen::latest()->take(10)->get();

        return view('prd', compact('imagen', 'imagenes'));
    }

    public function mostrarFormularioCarga()
    {
        $imagenes = Imagen::all();
        Log::debug('Imágenes cargadas: ', ['count' => count($imagenes)]);
        return view('produccion/cargar-informacion', compact('imagenes'));
    }
    

    public function cargarImagenes(Request $request)
    {
        $request->validate([
            'imagenes.*' => 'required|image|max:5000',
            'imagenes' => 'required|array|max:10',
        ]);

        foreach ($request->file('imagenes') as $archivo) {
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $path = $archivo->storeAs('public/imagenes', $nombreArchivo);

            $imagen = new Imagen();
            $imagen->nombre_archivo = $nombreArchivo;
            $imagen->save();
        }

        return redirect()->route('mostrar-imagen-publica');
    }

    public function guardarTiempo(Request $request)
    {
    $tiempoCambioMilisegundos = $request->tiempoCambio * 60000;

    $request->session()->put('tiempoCambio', $tiempoCambioMilisegundos);

    return back()->with('success', 'Tiempo de cambio configurado correctamente.');
    }

    public function eliminarTodasLasImagenes()
{
    Log::debug('Eliminando todas las imágenes...');
    $imagenes = Imagen::all();
    foreach ($imagenes as $imagen) {
        Storage::delete('public/imagenes/' . $imagen->nombre_archivo);
    }
    Imagen::truncate();
    return redirect()->route('mostrar-formulario-carga')->with('success', 'Todas las imágenes fueron eliminadas correctamente.');
}

/* borrar una imagen en particular */

public function eliminarImagen($id)
{
    $imagen = Imagen::find($id);

    if (!$imagen) {
        return back()->with('error', 'La imagen no existe.');
    }

    Storage::delete('public/imagenes/' . $imagen->nombre_archivo);
    $imagen->delete();

    return redirect()->route('mostrar-formulario-carga')->with('success', 'La imagen fue eliminada correctamente.');
}

    

    
}
