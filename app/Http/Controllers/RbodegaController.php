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
            'total_pallets_retirados' => 'required|array',
            'total_pallets_retirados.*' => 'required|numeric',
            'envio_inventario' => 'required|array',
            'envio_inventario.*' => 'required|numeric',
            'total_inventarios_planificados' => 'required|array',
            'total_inventarios_planificados.*' => 'required|numeric',
            'verificacion_materias_primas' => 'required|array',
            'verificacion_materias_primas.*' => 'required|numeric',
            'total_verificaciones_planificadas' => 'required|array',
            'total_verificaciones_planificadas.*' => 'required|numeric',
            'verificacion_producto_terminado' => 'required|array',
            'verificacion_producto_terminado.*' => 'required|numeric',
            'cumplimiento_envio_programacion' => 'required|array',
            'cumplimiento_envio_programacion.*' => 'required|numeric',
            'total_programas_despacho' => 'required|array',
            'total_programas_despacho.*' => 'required|numeric',
            'cumplimiento_estandar_embalaje' => 'required|array',
            'cumplimiento_estandar_embalaje.*' => 'required|numeric',
            'total_pallet_periodo' => 'required|array',
            'total_pallet_periodo.*' => 'required|numeric',
            'cumplimiento_programa_despacho' => 'required|array',
            'cumplimiento_programa_despacho.*' => 'required|numeric',
            'total_despachos_planificados' => 'required|array',
            'total_despachos_planificados.*' => 'required|numeric',
            'eficiencia_emision_documentos' => 'required|array',
            'eficiencia_emision_documentos.*' => 'required|numeric',
            'total_despachos_ejecutados' => 'required|array',
            'total_despachos_ejecutados.*' => 'required|numeric',
            'gestion_retiro_scrap' => 'required|array',
            'gestion_retiro_scrap.*' => 'required|numeric',
            'total_retiros_scrap' => 'required|array',
            'total_retiros_scrap.*' => 'required|numeric',
        ]);
    
        // Procesar y almacenar los datos
        foreach ($data['startDate'] as $index => $startDate) {
            $indicador = new IndicadorBodega([
                'start_date' => $startDate,
                'end_date' => $data['endDate'][$index],
                'retiro_produccion' => $data['retiro_produccion'][$index],
                'total_pallets_retirados' => $data['total_pallets_retirados'][$index],
                'envio_inventario' => $data['envio_inventario'][$index],
                'total_inventarios_planificados' => $data['total_inventarios_planificados'][$index],
                'verificacion_materias_primas' => $data['verificacion_materias_primas'][$index],
                'total_verificaciones_planificadas' => $data['total_verificaciones_planificadas'][$index],
                'verificacion_producto_terminado' => $data['verificacion_producto_terminado'][$index],
                'cumplimiento_envio_programacion' => $data['cumplimiento_envio_programacion'][$index],
                'total_programas_despacho' => $data['total_programas_despacho'][$index],
                'cumplimiento_estandar_embalaje' => $data['cumplimiento_estandar_embalaje'][$index],
                'total_pallet_periodo' => $data['total_pallet_periodo'][$index],
                'cumplimiento_programa_despacho' => $data['cumplimiento_programa_despacho'][$index],
                'total_despachos_planificados' => $data['total_despachos_planificados'][$index],
                'eficiencia_emision_documentos' => $data['eficiencia_emision_documentos'][$index],
                'total_despachos_ejecutados' => $data['total_despachos_ejecutados'][$index],
                'gestion_retiro_scrap' => $data['gestion_retiro_scrap'][$index],
                'total_retiros_scrap' => $data['total_retiros_scrap'][$index],
            ]);
            $indicador->save();
        }
    
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
