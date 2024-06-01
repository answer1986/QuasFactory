<?php

namespace App\Http\Controllers;

use App\Models\Rrrhh;
use Illuminate\Http\Request;

class RrrhhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rrrhh');
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
            'induccion_completa' => 'required|array',
            'induccion_completa.*' => 'required|numeric',
            'rotacion_personal' => 'required|array',
            'rotacion_personal.*' => 'required|numeric',
            'clima_laboral' => 'required|array',
            'clima_laboral.*' => 'required|numeric',
            'escalafon_actualizacion' => 'required|array',
            'escalafon_actualizacion.*' => 'required|numeric',
            'ausentismo_laboral' => 'required|array',
            'ausentismo_laboral.*' => 'required|numeric',
            'horas_extras' => 'required|array',
            'horas_extras.*' => 'required|numeric',
            'atraso_periodo' => 'required|array',
            'atraso_periodo.*' => 'required|numeric',
        ]);

        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rh.index')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rrrhh  $rrrhh
     * @return \Illuminate\Http\Response
     */
    public function show(Rrrhh $rrrhh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rrrhh  $rrrhh
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrrhh $rrrhh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rrrhh  $rrrhh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrrhh $rrrhh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rrrhh  $rrrhh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrrhh $rrrhh)
    {
        //
    }
}
