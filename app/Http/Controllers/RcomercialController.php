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
            'variacion_prog_dist' => 'required|array',
            'variacion_prog_dist.*' => 'required|numeric',
            'total_prog_dist_solicitadas' => 'required|array',
            'total_prog_dist_solicitadas.*' => 'required|numeric',
            'clientes_finales' => 'required|array',
            'clientes_finales.*' => 'required|numeric',
            'clientes_nuevos' => 'required|array',
            'clientes_nuevos.*' => 'required|numeric',
            'clientes_iniciales' => 'required|array',
            'clientes_iniciales.*' => 'required|numeric',
            'clientes_antiguos' => 'required|array',
            'clientes_antiguos.*' => 'required|numeric',
            'encuestas_satisfaccion' => 'required|array',
            'encuestas_satisfaccion.*' => 'required|numeric',
            'total_encuestas' => 'required|array',
            'total_encuestas.*' => 'required|numeric',
            'carpetas_completas' => 'required|array',
            'carpetas_completas.*' => 'required|numeric',
            'total_clientes' => 'required|array',
            'total_clientes.*' => 'required|numeric',
            'devoluciones_productos' => 'required|array',
            'devoluciones_productos.*' => 'required|numeric',
            'total_entregas' => 'required|array',
            'total_entregas.*' => 'required|numeric',
            'dias_espera' => 'required|array',
            'dias_espera.*' => 'required|numeric',
            'total_reclamos_consultas' => 'required|array',
            'total_reclamos_consultas.*' => 'required|numeric',
        ]);
    
        // Procesar y almacenar los datos
        foreach ($data['startDate'] as $index => $startDate) {
            $indicador = new Indicador([
                'start_date' => $startDate,
                'end_date' => $data['endDate'][$index],
                'variacion_prog_dist' => $data['variacion_prog_dist'][$index],
                'total_prog_dist_solicitadas' => $data['total_prog_dist_solicitadas'][$index],
                'clientes_finales' => $data['clientes_finales'][$index],
                'clientes_nuevos' => $data['clientes_nuevos'][$index],
                'clientes_iniciales' => $data['clientes_iniciales'][$index],
                'clientes_antiguos' => $data['clientes_antiguos'][$index],
                'encuestas_satisfaccion' => $data['encuestas_satisfaccion'][$index],
                'total_encuestas' => $data['total_encuestas'][$index],
                'carpetas_completas' => $data['carpetas_completas'][$index],
                'total_clientes' => $data['total_clientes'][$index],
                'devoluciones_productos' => $data['devoluciones_productos'][$index],
                'total_entregas' => $data['total_entregas'][$index],
                'dias_espera' => $data['dias_espera'][$index],
                'total_reclamos_consultas' => $data['total_reclamos_consultas'][$index],
            ]);
            $indicador->save();
        }
    
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
