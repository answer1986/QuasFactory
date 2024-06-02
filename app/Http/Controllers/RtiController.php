<?php

namespace App\Http\Controllers;

use App\Models\Rti;
use Illuminate\Http\Request;

class RtiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rti');
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
        'planos_tecnicos_productos' => 'required|array',
        'planos_tecnicos_productos.*' => 'required|numeric',
        'total_productos_comercializados' => 'required|array',
        'total_productos_comercializados.*' => 'required|numeric',
        'planos_tecnicos_almacenados' => 'required|array',
        'planos_tecnicos_almacenados.*' => 'required|numeric',
        'total_maquinarias_industrial' => 'required|array',
        'total_maquinarias_industrial.*' => 'required|numeric',
        'planos_tecnicos_maquinaria' => 'required|array',
        'planos_tecnicos_maquinaria.*' => 'required|numeric',
        'planos_tecnicos_almacenados_maquinaria' => 'required|array',
        'planos_tecnicos_almacenados_maquinaria.*' => 'required|numeric',
        'total_maquinaria_existente' => 'required|array',
        'total_maquinaria_existente.*' => 'required|numeric',
        'manuales_maquinaria_productiva' => 'required|array',
        'manuales_maquinaria_productiva.*' => 'required|numeric',
        'total_maquinaria_productiva' => 'required|array',
        'total_maquinaria_productiva.*' => 'required|numeric',
        'usuarios_requerimientos_pendientes' => 'required|array',
        'usuarios_requerimientos_pendientes.*' => 'required|numeric',
        'total_usuarios_red' => 'required|array',
        'total_usuarios_red.*' => 'required|numeric',
        'licencias_activas' => 'required|array',
        'licencias_activas.*' => 'required|numeric',
        'total_softwares_usados' => 'required|array',
        'total_softwares_usados.*' => 'required|numeric',
        'plano_electrico_industrial' => 'required|array',
        'plano_electrico_industrial.*' => 'required|string',
        'plano_circuitos_informaticos' => 'required|array',
        'plano_circuitos_informaticos.*' => 'required|string',
        'planificacion_operaciones' => 'required|array',
        'planificacion_operaciones.*' => 'required|string',
    ]);

    // Procesar y almacenar los datos
    foreach ($data['startDate'] as $index => $startDate) {
        $indicador = new IndicadorTI([
            'start_date' => $startDate,
            'end_date' => $data['endDate'][$index],
            'planos_tecnicos_productos' => $data['planos_tecnicos_productos'][$index],
            'total_productos_comercializados' => $data['total_productos_comercializados'][$index],
            'planos_tecnicos_almacenados' => $data['planos_tecnicos_almacenados'][$index],
            'total_maquinarias_industrial' => $data['total_maquinarias_industrial'][$index],
            'planos_tecnicos_maquinaria' => $data['planos_tecnicos_maquinaria'][$index],
            'planos_tecnicos_almacenados_maquinaria' => $data['planos_tecnicos_almacenados_maquinaria'][$index],
            'total_maquinaria_existente' => $data['total_maquinaria_existente'][$index],
            'manuales_maquinaria_productiva' => $data['manuales_maquinaria_productiva'][$index],
            'total_maquinaria_productiva' => $data['total_maquinaria_productiva'][$index],
            'usuarios_requerimientos_pendientes' => $data['usuarios_requerimientos_pendientes'][$index],
            'total_usuarios_red' => $data['total_usuarios_red'][$index],
            'licencias_activas' => $data['licencias_activas'][$index],
            'total_softwares_usados' => $data['total_softwares_usados'][$index],
            'plano_electrico_industrial' => $data['plano_electrico_industrial'][$index],
            'plano_circuitos_informaticos' => $data['plano_circuitos_informaticos'][$index],
            'planificacion_operaciones' => $data['planificacion_operaciones'][$index],
        ]);
        $indicador->save();
    }

    // Redirigir de vuelta a la página con los datos procesados
    return redirect()->route('rti.index')->with('data', $data);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rti  $rti
     * @return \Illuminate\Http\Response
     */
    public function show(Rti $rti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rti  $rti
     * @return \Illuminate\Http\Response
     */
    public function edit(Rti $rti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rti  $rti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rti $rti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rti  $rti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rti $rti)
    {
        //
    }
}
