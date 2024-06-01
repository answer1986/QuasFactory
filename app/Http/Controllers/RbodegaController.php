<?php

namespace App\Http\Controllers;

use App\Models\Rbodega;
use Illuminate\Http\Request;

class RbodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rbodega');
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
            'retiro_produccion' => 'required|array',
            'retiro_produccion.*' => 'required|numeric',
            'envio_inventario' => 'required|array',
            'envio_inventario.*' => 'required|numeric',
            'verificacion_materias_primas' => 'required|array',
            'verificacion_materias_primas.*' => 'required|numeric',
            'verificacion_producto_terminado' => 'required|array',
            'verificacion_producto_terminado.*' => 'required|numeric',
            'cumplimiento_envio_programacion' => 'required|array',
            'cumplimiento_envio_programacion.*' => 'required|numeric',
            'cumplimiento_estandar_embalaje' => 'required|array',
            'cumplimiento_estandar_embalaje.*' => 'required|numeric',
            'cumplimiento_programa_despacho' => 'required|array',
            'cumplimiento_programa_despacho.*' => 'required|numeric',
            'eficiencia_emision_documentos' => 'required|array',
            'eficiencia_emision_documentos.*' => 'required|numeric',
            'gestion_retiro_scrap' => 'required|array',
            'gestion_retiro_scrap.*' => 'required|numeric',
        ]);

        // Redirigir de vuelta a la página con los datos procesados
        return redirect()->route('rbodega.index')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rbodega  $rbodega
     * @return \Illuminate\Http\Response
     */
    public function show(Rbodega $rbodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rbodega  $rbodega
     * @return \Illuminate\Http\Response
     */
    public function edit(Rbodega $rbodega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rbodega  $rbodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rbodega $rbodega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rbodega  $rbodega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rbodega $rbodega)
    {
        //
    }
}
