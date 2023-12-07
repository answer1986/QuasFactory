<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048',
            'nombre' => 'required|string|max:255|unique:clientes',
            'rut' => 'required|string|max:12|unique:clientes',
            'razon_social' => 'required|string|max:255|unique:clientes',
            'giro' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo_electronico' => 'required|string|email|max:255|unique:clientes',
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'credito' => 'required|boolean',
            'otros' => 'nullable|string',
            'fecha_creacion' => 'required|date|unique:clientes',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('clientes', $filename, 'public');
            $data['foto'] = $filename;
        }

        Cliente::create($data);

        return redirect()->route('clientes.create')->with('success', 'Cliente creado exitosamente!');
    }



    /*edicion */

    public function edit()
    {
        $clientes = Cliente::all();
        return view('clientes.edit', compact('clientes'));
    }

    public function update(Request $request)
    {
        try {
            foreach ($request->clientes as $id => $clienteData) {
                $cliente = Cliente::findOrFail($id);
                $cliente->update($clienteData);
            }

            return redirect()->route('clientes.edit')->with('status', 'Clientes actualizados exitosamente!');
        } catch (\Exception $exception) {
            // Log the error
            Log::error("Error al actualizar cliente: {$exception->getMessage()}");

            // Redirect back with an error message
            return redirect()->route('clientes.edit')->withErrors(['error' => 'Hubo un error al actualizar el cliente. Por favor intenta nuevamente.']);
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('clientes.edit')->with('status', 'Cliente borrado exitosamente!');
        } catch (\Exception $exception) {
            // Log the error
            Log::error("Error al borrar cliente: {$exception->getMessage()}");

            // Redirect back with an error message
            return redirect()->route('clientes.edit')->withErrors(['error' => 'Hubo un error al borrar el cliente. Por favor intenta nuevamente.']);
        }
    }

}
