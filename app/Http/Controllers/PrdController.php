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
            'imagen' => 'required|image', // Asegúrate de que el nombre del input es 'imagen'
        ]);

        $archivo = $request->file('imagen');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $path = $archivo->storeAs('public/imagenes', $nombreArchivo);

        $imagen = new Imagen();
        $imagen->nombre_archivo = $nombreArchivo;
        $imagen->save();

        // Corregido para redirigir a una ruta que se espera esté definida en el archivo de rutas
        return redirect()->route('mostrar-imagen-publica');
    }

    public function mostrarImagenPublica()
    {
        // Obtiene la última imagen subida
        $imagen = Imagen::latest()->first();
        // Obtiene las últimas 10 imágenes subidas
        $imagenes = Imagen::latest()->take(10)->get();

        // Corregido para pasar correctamente ambas variables a la vista
        return view('prd', compact('imagen', 'imagenes'));
    }

    public function mostrarFormularioCarga()
    {
        Log::debug('Mostrando formulario de carga de imagen');
        return view('produccion/cargar-informacion');
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

        // Corregido para redirigir a una ruta que se espera esté definida en el archivo de rutas
        return redirect()->route('mostrar-imagen-publica');
    }

    
}
