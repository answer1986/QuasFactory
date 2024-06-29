<?php

namespace App\Http\Controllers;

use App\Models\Rrrhh;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RrrhhController extends Controller
{
   
    public function index()
    {
        return view('reporteria.rrrhh');
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

        Rrrhh::create([
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
    }

     // Generate charts
     $charts = $this->generateCharts($request);
     $subjectTitle = 'Reporte de Indicadores de Recursos Humanos'; 
     $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'davido@trescastillos.cl' , 'soporte@quas.cl'];
     //$emails = ['arv00316@hotmail.com'];  
     foreach ($emails as $email) {
         Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));

     }
 
     return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
 }

 private function generateCharts($data)
{
    $charts = [
        ['data' => $data['induccion_completa'][0], 'title' => 'Inducción Completa', 'description' => 'Número de inducciones completadas', 'filename' => 'charts/induccion_completa.png'],
        ['data' => $data['rotacion_personal'][0], 'title' => 'Rotación de Personal', 'description' => 'Tasa de rotación de personal en el periodo', 'filename' => 'charts/rotacion_personal.png'],
        ['data' => $data['total_trabajadores_periodo'][0], 'title' => 'Total de Trabajadores en el Periodo', 'description' => 'Número total de trabajadores durante el periodo', 'filename' => 'charts/total_trabajadores_periodo.png'],
        ['data' => $data['clima_laboral'][0], 'title' => 'Clima Laboral', 'description' => 'Índice de clima laboral basado en encuestas', 'filename' => 'charts/clima_laboral.png'],
        ['data' => $data['total_encuestas_clima'][0], 'title' => 'Total Encuestas de Clima', 'description' => 'Total de encuestas de clima laboral realizadas', 'filename' => 'charts/total_encuestas_clima.png'],
        ['data' => $data['escalafon_actualizacion'][0], 'title' => 'Actualización de Escalafón', 'description' => 'Actualizaciones en el escalafón del personal', 'filename' => 'charts/escalafon_actualizacion.png'],
        ['data' => $data['ausentismo_laboral'][0], 'title' => 'Ausentismo Laboral', 'description' => 'Tasa de ausentismo laboral', 'filename' => 'charts/ausentismo_laboral.png'],
        ['data' => $data['dotacion_total_periodo'][0], 'title' => 'Dotación Total del Periodo', 'description' => 'Dotación total de empleados en el periodo', 'filename' => 'charts/dotacion_total_periodo.png'],
        ['data' => $data['horas_extras'][0], 'title' => 'Horas Extras', 'description' => 'Cantidad de horas extras trabajadas', 'filename' => 'charts/horas_extras.png'],
        ['data' => $data['total_horas_norma'][0], 'title' => 'Horas Normales Trabajadas', 'description' => 'Total de horas normales trabajadas', 'filename' => 'charts/total_horas_norma.png'],
        ['data' => $data['atraso_periodo'][0], 'title' => 'Atrasos en el Periodo', 'description' => 'Total de atrasos registrados en el periodo', 'filename' => 'charts/atraso_periodo.png'],
        ['data' => $data['total_horas_trabajadas'][0], 'title' => 'Total Horas Trabajadas', 'description' => 'Total de horas trabajadas por todos los empleados', 'filename' => 'charts/total_horas_trabajadas.png'],
    ];

    $images = [];
    //$nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
    $nodePath='/usr/local/nvm/versions/node/v18.20.3/bin/node';

    foreach ($charts as $chart) {
        $isSignificant = $chart['data'] >= 1000; // Asumiendo un criterio para algo significativo
        $process = new Process([$nodePath, 'generate_charts.js', $chart['data'], $chart['title'], public_path($chart['filename']), $isSignificant ? 'true' : 'false']);
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



  
    public function show(Rrrhh $rrrhh)
    {
        //
    }

    public function edit(Rrrhh $rrrhh)
    {
        //
    }

   
    public function update(Request $request, Rrrhh $rrrhh)
    {
        //
    }
    public function destroy(Rrrhh $rrrhh)
    {
        //
    }
}
