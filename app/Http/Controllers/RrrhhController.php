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
        'total_trabajadores_periodo' => 'required|array',
        'total_trabajadores_periodo.*' => 'required|numeric',
        'clima_laboral' => 'required|array',
        'clima_laboral.*' => 'required|numeric',
        'total_encuestas_clima' => 'required|array',
        'total_encuestas_clima.*' => 'required|numeric',
        'escalafon_actualizacion' => 'required|array',
        'escalafon_actualizacion.*' => 'required|numeric',
        'ausentismo_laboral' => 'required|array',
        'ausentismo_laboral.*' => 'required|numeric',
        'dotacion_total_periodo' => 'required|array',
        'dotacion_total_periodo.*' => 'required|numeric',
        'horas_extras' => 'required|array',
        'horas_extras.*' => 'required|numeric',
        'total_horas_norma' => 'required|array',
        'total_horas_norma.*' => 'required|numeric',
        'atraso_periodo' => 'required|array',
        'atraso_periodo.*' => 'required|numeric',
        'total_horas_trabajadas' => 'required|array',
        'total_horas_trabajadas.*' => 'required|numeric',
    ]);

    // Procesar y almacenar los datos
    foreach ($data['startDate'] as $index => $startDate) {
        $indicador = new IndicadorRRHH([
            'start_date' => $startDate,
            'end_date' => $data['endDate'][$index],
            'induccion_completa' => $data['induccion_completa'][$index],
            'rotacion_personal' => $data['rotacion_personal'][$index],
            'total_trabajadores_periodo' => $data['total_trabajadores_periodo'][$index],
            'clima_laboral' => $data['clima_laboral'][$index],
            'total_encuestas_clima' => $data['total_encuestas_clima'][$index],
            'escalafon_actualizacion' => $data['escalafon_actualizacion'][$index],
            'ausentismo_laboral' => $data['ausentismo_laboral'][$index],
            'dotacion_total_periodo' => $data['dotacion_total_periodo'][$index],
            'horas_extras' => $data['horas_extras'][$index],
            'total_horas_norma' => $data['total_horas_norma'][$index],
            'atraso_periodo' => $data['atraso_periodo'][$index],
            'total_horas_trabajadas' => $data['total_horas_trabajadas'][$index],
        ]);
        $indicador->save();
    }

    // Redirigir de vuelta a la página con los datos procesados
    return redirect()->route('rrrhh.index')->with('data', $data);
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
