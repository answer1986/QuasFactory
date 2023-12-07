<?php

namespace App\Http\Controllers;

use App\Models\Producto; 
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'material_base' => 'required|string',
            'pintura' => 'required|string',
            'medida' => 'required|string',
            'cantidad' => 'required|integer',
            'foto' => 'nullable|image|max:2048', 
        ]);
    
        $productos = new Producto;
        $productos->nombre = $request->input('nombre');
        $productos->material_base = $request->input('material_base');
        $productos->pintura = $request->input('pintura');
        $productos->cantidad = $request->input('cantidad');

    
        $medidaParts = explode('x', $request->input('medida'));
        if (count($medidaParts) == 2) {
            list($ancho, $alto) = $medidaParts;
            $productos->ancho = $ancho;
            $productos->alto = $alto;
        } else {
            // Manejar el error y detener la ejecución
            return redirect()->back()->withErrors(['medida' => 'El formato de medida no es válido.']);
        }
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('productos', $filename, 'public'); 
            $productos->foto = $filename;
        }

        $productos->save();
        return redirect()->route('productos.create')->with('success', 'Producto creado exitosamente!');
    }
    
    
public function index()
{
    $productos = Producto::all(); // Obtener todos los productos de la BD.
    return view('productos.create', compact('productos'));
}


  //edicion //

  public function edit()
  {
      $productos = Producto::all();
      return view('productos.edit', compact('productos'));
  }
  public function update(Request $request)
  {
      foreach ($request->productos as $id => $productosData) {
          $producto = Producto::findOrFail($id);
          $producto->update($productosData);
      }
  
      return redirect()->route('productos.edit')->with('status', 'Productos actualizados exitosamente!');
  }
    
  public function destroy($id)
{
    try {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.edit')->with('status', 'Producto borrado exitosamente!');
    } catch (\Exception $exception) {
        // Log the error
        Log::error("Error al borrar producto: {$exception->getMessage()}");

        // Redirect back with an error message
        return redirect()->route('productos.edit')->withErrors(['error' => 'Hubo un error al borrar el producto. Por favor intenta nuevamente.']);
    }
}


}