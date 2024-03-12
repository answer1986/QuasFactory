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
    
        return redirect()->route('mostrar-imagen');
    }
    
    public function mostrarImagenPublica()
    {
        $imagen = Imagen::latest()->first();
    
        return view('prd', ['imagen' => $imagen]);
    }
    

    public function mostrarFormularioCarga()
    {
        Log::debug('Mostrando formulario de carga de imagen');
        return view('produccion/cargar-informacion');
    }
}
