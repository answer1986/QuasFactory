<?php

namespace App\Http\Controllers;

use App\Models\Rbodega;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RbodegaController extends Controller
{
    
    public function index()
    {
        return view('reporteria.rbodega');
    }
    
    public function create()
    {
        //
    }

    
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
                
                Rbodega::create([
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
        }
    
       // Generate charts
     $charts = $this->generateCharts($request);
     $subjectTitle = 'Reporte de Indicadores de Bodega'; 
     $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'javierao@trescastillos.cl' , 'soporte@quas.cl'];
     //$emails = ['arv00316@hotmail.com'];  
     foreach ($emails as $email) {
         Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));

     }
 
     return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
 }
 private function generateCharts($data)
 {
     // Define los gráficos a generar con sus detalles específicos
     $charts = [
         [
             'data' => $data['retiro_produccion'][0],
             'title' => 'Retiro de Producción',
             'description' => 'Total de retiros de producción',
             'filename' => 'charts/retiro_produccion.png',
         ],
         [
             'data' => $data['total_pallets_retirados'][0],
             'title' => 'Total Pallets Retirados',
             'description' => 'Total de pallets retirados',
             'filename' => 'charts/total_pallets_retirados.png',
         ],
         [
             'data' => $data['envio_inventario'][0],
             'title' => 'Envío a Inventario',
             'description' => 'Envíos completados al inventario',
             'filename' => 'charts/envio_inventario.png',
         ],
         [
             'data' => $data['total_inventarios_planificados'][0],
             'title' => 'Total Inventarios Planificados',
             'description' => 'Total de inventarios planificados durante el periodo',
             'filename' => 'charts/total_inventarios_planificados.png',
         ],
         [
             'data' => $data['verificacion_materias_primas'][0],
             'title' => 'Verificación de Materias Primas',
             'description' => 'Verificaciones realizadas a materias primas',
             'filename' => 'charts/verificacion_materias_primas.png',
         ],
         [
             'data' => $data['total_verificaciones_planificadas'][0],
             'title' => 'Total Verificaciones Planificadas',
             'description' => 'Total de verificaciones planificadas',
             'filename' => 'charts/total_verificaciones_planificadas.png',
         ],
         [
             'data' => $data['verificacion_producto_terminado'][0],
             'title' => 'Verificación de Producto Terminado',
             'description' => 'Verificaciones realizadas a productos terminados',
             'filename' => 'charts/verificacion_producto_terminado.png',
         ],
         [
             'data' => $data['cumplimiento_envio_programacion'][0],
             'title' => 'Cumplimiento de Envío Según Programación',
             'description' => 'Cumplimiento de los envíos según la programación establecida',
             'filename' => 'charts/cumplimiento_envio_programacion.png',
         ],
         [
             'data' => $data['total_programas_despacho'][0],
             'title' => 'Total Programas de Despacho',
             'description' => 'Total de programas de despacho planificados',
             'filename' => 'charts/total_programas_despacho.png',
         ],
         [
             'data' => $data['cumplimiento_estandar_embalaje'][0],
             'title' => 'Cumplimiento del Estándar de Embalaje',
             'description' => 'Cumplimiento con los estándares de embalaje',
             'filename' => 'charts/cumplimiento_estandar_embalaje.png',
         ],
         [
             'data' => $data['total_pallet_periodo'][0],
             'title' => 'Total Pallets en el Período',
             'description' => 'Total de pallets manejados durante el período',
             'filename' => 'charts/total_pallet_periodo.png',
         ],
         [
             'data' => $data['cumplimiento_programa_despacho'][0],
             'title' => 'Cumplimiento del Programa de Despacho',
             'description' => 'Nivel de cumplimiento del programa de despacho',
             'filename' => 'charts/cumplimiento_programa_despacho.png',
         ],
         [
             'data' => $data['total_despachos_planificados'][0],
             'title' => 'Total Despachos Planificados',
             'description' => 'Total de despachos planificados en el período',
             'filename' => 'charts/total_despachos_planificados.png',
         ],
         [
             'data' => $data['eficiencia_emision_documentos'][0],
             'title' => 'Eficiencia en la Emisión de Documentos',
             'description' => 'Eficiencia en la emisión de documentos para despachos',
             'filename' => 'charts/eficiencia_emision_documentos.png',
         ],
         [
             'data' => $data['total_despachos_ejecutados'][0],
             'title' => 'Total Despachos Ejecutados',
             'description' => 'Total de despachos efectivamente realizados',
             'filename' => 'charts/total_despachos_ejecutados.png',
         ],
         [
             'data' => $data['gestion_retiro_scrap'][0],
             'title' => 'Gestión de Retiro de Scrap',
             'description' => 'Gestión y eficacia en el retiro de scrap',
             'filename' => 'charts/gestion_retiro_scrap.png',
         ],
         [
             'data' => $data['total_retiros_scrap'][0],
             'title' => 'Total Retiros de Scrap',
             'description' => 'Total de retiros de scrap realizados',
             'filename' => 'charts/total_retiros_scrap.png',
         ],
     ];
 
     $images = [];
      //$nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
      $nodePath='/usr/local/nvm/versions/node/v18.20.3/bin/node';
 
      foreach ($charts as $chart) {
        $isSignificant = $chart['data'] >= 1000; // Establece un criterio para la importancia del gráfico
        $process = new Process([
            $nodePath,
            public_path('generate_charts.js'), // Asegúrate de que el path al script JS sea correcto
            $chart['data'],
            $chart['title'],
            public_path($chart['filename']), // Guarda el gráfico generado en el directorio público
            $isSignificant ? 'true' : 'false'
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $chart['path'] = public_path($chart['filename']);
        $chart['name'] = basename($chart['filename']);
        $images[] = $chart;
    }

    return $images;
}
 

   
    public function show(Rbodega $rbodega)
    {
        //
    }

   
    public function edit(Rbodega $rbodega)
    {
        //
    }

   
    public function update(Request $request, Rbodega $rbodega)
    {
        //
    }

    
    public function destroy(Rbodega $rbodega)
    {
        //
    }
}
