<?php

namespace App\Http\Controllers;

use App\Models\Rcalidad;
use Illuminate\Http\Request;

class RcalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rcalidad');
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
            'informes_calidad_extrusion' => 'required|array',
            'informes_calidad_extrusion.*' => 'required|numeric',
            'informes_calidad_sellado' => 'required|array',
            'informes_calidad_sellado.*' => 'required|numeric',
            'informes_alergenos' => 'required|array',
            'informes_alergenos.*' => 'required|numeric',
            'registros_alergenos_entregados' => 'required|array',
            'registros_alergenos_entregados.*' => 'required|numeric',
            'registros_alergenos_programados' => 'required|array',
            'registros_alergenos_programados.*' => 'required|numeric',
            'inducciones_realizadas' => 'required|array',
            'inducciones_realizadas.*' => 'required|numeric',
            'inducciones_correspondientes' => 'required|array',
            'inducciones_correspondientes.*' => 'required|numeric',
            'validaciones_masa_patron' => 'required|array',
            'validaciones_masa_patron.*' => 'required|numeric',
            'validaciones_correspondientes' => 'required|array',
            'validaciones_correspondientes.*' => 'required|numeric',
            'registros_revision_trampas' => 'required|array',
            'registros_revision_trampas.*' => 'required|numeric',
            'registros_charlas_bpm' => 'required|array',
            'registros_charlas_bpm.*' => 'required|numeric',
            'charlas_bpm_programadas' => 'required|array',
            'charlas_bpm_programadas.*' => 'required|numeric',
            'auditorias_internas' => 'required|array',
            'auditorias_internas.*' => 'required|numeric',
            'auditorias_internas_programadas' => 'required|array',
            'auditorias_internas_programadas.*' => 'required|numeric',
            'funcionarios_capacitados' => 'required|array',
            'funcionarios_capacitados.*' => 'required|numeric',
            'total_funcionarios_empresa' => 'required|array',
            'total_funcionarios_empresa.*' => 'required|numeric',
            'muestreos_calidad_turno' => 'required|array',
            'muestreos_calidad_turno.*' => 'required|numeric',
            'muestreos_calidad_totales' => 'required|array',
            'muestreos_calidad_totales.*' => 'required|numeric',
        ]);
    
        // Procesar y almacenar los datos
        foreach ($data['startDate'] as $index => $startDate) {
            $indicador = new IndicadorCalidad([
                'start_date' => $startDate,
                'end_date' => $data['endDate'][$index],
                'informes_calidad_extrusion' => $data['informes_calidad_extrusion'][$index],
                'informes_calidad_sellado' => $data['informes_calidad_sellado'][$index],
                'informes_alergenos' => $data['informes_alergenos'][$index],
                'registros_alergenos_entregados' => $data['registros_alergenos_entregados'][$index],
                'registros_alergenos_programados' => $data['registros_alergenos_programados'][$index],
                'inducciones_realizadas' => $data['inducciones_realizadas'][$index],
                'inducciones_correspondientes' => $data['inducciones_correspondientes'][$index],
                'validaciones_masa_patron' => $data['validaciones_masa_patron'][$index],
                'validaciones_correspondientes' => $data['validaciones_correspondientes'][$index],
                'registros_revision_trampas' => $data['registros_revision_trampas'][$index],
                'registros_charlas_bpm' => $data['registros_charlas_bpm'][$index],
                'charlas_bpm_programadas' => $data['charlas_bpm_programadas'][$index],
                'auditorias_internas' => $data['auditorias_internas'][$index],
                'auditorias_internas_programadas' => $data['auditorias_internas_programadas'][$index],
                'funcionarios_capacitados' => $data['funcionarios_capacitados'][$index],
                'total_funcionarios_empresa' => $data['total_funcionarios_empresa'][$index],
                'muestreos_calidad_turno' => $data['muestreos_calidad_turno'][$index],
                'muestreos_calidad_totales' => $data['muestreos_calidad_totales'][$index],
            ]);
            $indicador->save();
        }
    
        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rcalidad.index')->with('data', $data);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rcalidad  $rcalidad
     * @return \Illuminate\Http\Response
     */
    public function show(Rcalidad $rcalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rcalidad  $rcalidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Rcalidad $rcalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rcalidad  $rcalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rcalidad $rcalidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rcalidad  $rcalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rcalidad $rcalidad)
    {
        //
    }
}
