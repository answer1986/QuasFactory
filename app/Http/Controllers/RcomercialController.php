<?php

namespace App\Http\Controllers;

use App\Models\Rcomercial;
use Illuminate\Http\Request;

class RcomercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rcomercial');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar y almacenar los datos del formulario
        $data = $request->validate([
            'startDate' => 'required|array',
            'startDate.*' => 'required|date',
            'endDate' => 'required|array',
            'endDate.*' => 'required|date',
            'variacion_programa' => 'required|array',
            'variacion_programa.*' => 'required|numeric',
            'retencion_clientes' => 'required|array',
            'retencion_clientes.*' => 'required|numeric',
            'incorporacion_clientes' => 'required|array',
            'incorporacion_clientes.*' => 'required|numeric',
            'satisfaccion_clientes' => 'required|array',
            'satisfaccion_clientes.*' => 'required|numeric',
            'carpetas_completas' => 'required|array',
            'carpetas_completas.*' => 'required|numeric',
            'devolucion_productos' => 'required|array',
            'devolucion_productos.*' => 'required|numeric',
            'tiempo_respuesta' => 'required|array',
            'tiempo_respuesta.*' => 'required|numeric',
            'capacitacion_personal' => 'required|array',
            'capacitacion_personal.*' => 'required|numeric',
        ]);

        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rcomercial.index')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rcomercial  $rcomercial
     * @return \Illuminate\Http\Response
     */
    public function show(Rcomercial $rcomercial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rcomercial  $rcomercial
     * @return \Illuminate\Http\Response
     */
    public function edit(Rcomercial $rcomercial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rcomercial  $rcomercial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rcomercial $rcomercial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rcomercial  $rcomercial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rcomercial $rcomercial)
    {
        //
    }
}
