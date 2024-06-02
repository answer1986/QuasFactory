<?php

namespace App\Http\Controllers;

use App\Models\Rcontabilidad;
use Illuminate\Http\Request;

class RcontabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rcontabilidad');
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
            'movimientos_identificados' => 'required|array',
            'movimientos_identificados.*' => 'required|numeric',
            'movimientos_totales' => 'required|array',
            'movimientos_totales.*' => 'required|numeric',
            'activo_circulante' => 'required|array',
            'activo_circulante.*' => 'required|numeric',
            'pasivo_circulante' => 'required|array',
            'pasivo_circulante.*' => 'required|numeric',
            'ventas_netas' => 'required|array',
            'ventas_netas.*' => 'required|numeric',
            'descuentos' => 'required|array',
            'descuentos.*' => 'required|numeric',
            'rebajas_devoluciones' => 'required|array',
            'rebajas_devoluciones.*' => 'required|numeric',
            'saldo_cuentas_cobrar' => 'required|array',
            'saldo_cuentas_cobrar.*' => 'required|numeric',
            'deudas_vencidas' => 'required|array',
            'deudas_vencidas.*' => 'required|numeric',
            'activo_total' => 'required|array',
            'activo_total.*' => 'required|numeric',
            'deuda_largo_plazo' => 'required|array',
            'deuda_largo_plazo.*' => 'required|numeric',
            'deuda_total' => 'required|array',
            'deuda_total.*' => 'required|numeric',
            'capital_total' => 'required|array',
            'capital_total.*' => 'required|numeric',
            'activo_corriente' => 'required|array',
            'activo_corriente.*' => 'required|numeric',
            'inventario' => 'required|array',
            'inventario.*' => 'required|numeric',
            'pasivo_corriente' => 'required|array',
            'pasivo_corriente.*' => 'required|numeric',
        ]);
    
        // Procesar y almacenar los datos
        foreach ($data['startDate'] as $index => $startDate) {
            $indicador = new IndicadorFinanciero([
                'start_date' => $startDate,
                'end_date' => $data['endDate'][$index],
                'movimientos_identificados' => $data['movimientos_identificados'][$index],
                'movimientos_totales' => $data['movimientos_totales'][$index],
                'activo_circulante' => $data['activo_circulante'][$index],
                'pasivo_circulante' => $data['pasivo_circulante'][$index],
                'ventas_netas' => $data['ventas_netas'][$index],
                'descuentos' => $data['descuentos'][$index],
                'rebajas_devoluciones' => $data['rebajas_devoluciones'][$index],
                'saldo_cuentas_cobrar' => $data['saldo_cuentas_cobrar'][$index],
                'deudas_vencidas' => $data['deudas_vencidas'][$index],
                'activo_total' => $data['activo_total'][$index],
                'deuda_largo_plazo' => $data['deuda_largo_plazo'][$index],
                'deuda_total' => $data['deuda_total'][$index],
                'capital_total' => $data['capital_total'][$index],
                'activo_corriente' => $data['activo_corriente'][$index],
                'inventario' => $data['inventario'][$index],
                'pasivo_corriente' => $data['pasivo_corriente'][$index],
            ]);
            $indicador->save();
        }
    
        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rcontabilidad.index')->with('data', $data);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function show(Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rcontabilidad $rcontabilidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rcontabilidad  $rcontabilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rcontabilidad $rcontabilidad)
    {
        //
    }
}
