<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scrap;

class ScrapController extends Controller
{
    public function index()
    {
        $scraps = Scrap::all();
        return view('bodega.scrap', ['scraps' => $scraps]);
    }

    public function create()
    {
        return view('scraps.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'numero_oc' => 'required|string',
            'kilos' => 'required|numeric',
            'otros' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        // Crear un nuevo ingreso de scrap en la base de datos
        Scrap::create($request->all());

        return redirect()->route('bodega.scrap')->with('success', 'Ingreso de scrap registrado exitosamente');
    }

    public function show($id)
    {
        $scrap = Scrap::findOrFail($id);
        return view('bodega.show', ['scrap' => $scrap]);
    }

    public function edit($id)
    {
        $scrap = Scrap::findOrFail($id);
        return view('bodega.edit', ['scrap' => $scrap]);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'numero_oc' => 'required|string',
            'kilos' => 'required|numeric',
            'otros' => 'nullable|string',
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
        ]);
        
        // Buscar el ingreso de scrap por ID
        $scrap = Scrap::findOrFail($id);

        // Actualizar los datos del ingreso de scrap en la base de datos
        $scrap->update($request->all());

        return redirect()->route('bodega.scrap')->with('success', 'Ingreso de scrap actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Buscar el ingreso de scrap por ID y eliminarlo de la base de datos
        $scrap = Scrap::findOrFail($id);
        $scrap->delete();

        return redirect()->route('bodega.scrap')->with('success', 'Ingreso de scrap eliminado exitosamente');
    }
}
