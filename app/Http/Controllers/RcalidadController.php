<?php

namespace App\Http\Controllers;

use App\Models\Rcalidad;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RcalidadController extends Controller
{
   
    public function index()
    {
        return view('reporteria.rcalidad');
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
            Rcalidad::create([
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
        }
    
                // Generate charts
            $charts = $this->generateCharts($request);
            $subjectTitle = 'Reporte de Indicadores de Calidad'; 
            $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'alejandrom@trescastillos.cl' , 'soporte@quas.cl'];
            //$emails = ['arv00316@hotmail.com'];  
            foreach ($emails as $email) {
                Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));

            }
        
            return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
        }

        private function generateCharts($data)
{
    // Define the charts with their details based on the validated data
    $charts = [
        ['data' => $data['informes_calidad_extrusion'][0], 'title' => 'Informes de Calidad Extrusión', 'description' => 'Cantidad de informes de calidad en extrusión.', 'filename' => 'charts/informes_calidad_extrusion.png'],
        ['data' => $data['informes_calidad_sellado'][0], 'title' => 'Informes de Calidad Sellado', 'description' => 'Cantidad de informes de calidad en sellado.', 'filename' => 'charts/informes_calidad_sellado.png'],
        ['data' => $data['informes_alergenos'][0], 'title' => 'Informes de Alergenos', 'description' => 'Informes generados sobre alergenos.', 'filename' => 'charts/informes_alergenos.png'],
        ['data' => $data['registros_alergenos_entregados'][0], 'title' => 'Registros de Alergenos Entregados', 'description' => 'Registros entregados de control de alergenos.', 'filename' => 'charts/registros_alergenos_entregados.png'],
        ['data' => $data['registros_alergenos_programados'][0], 'title' => 'Registros de Alergenos Programados', 'description' => 'Registros programados para control de alergenos.', 'filename' => 'charts/registros_alergenos_programados.png'],
        ['data' => $data['inducciones_realizadas'][0], 'title' => 'Inducciones Realizadas', 'description' => 'Total de inducciones realizadas.', 'filename' => 'charts/inducciones_realizadas.png'],
        ['data' => $data['inducciones_correspondientes'][0], 'title' => 'Inducciones Correspondientes', 'description' => 'Inducciones correspondientes a normativas.', 'filename' => 'charts/inducciones_correspondientes.png'],
        ['data' => $data['validaciones_masa_patron'][0], 'title' => 'Validaciones de Masa Patrón', 'description' => 'Validaciones realizadas usando masa patrón.', 'filename' => 'charts/validaciones_masa_patron.png'],
        ['data' => $data['validaciones_correspondientes'][0], 'title' => 'Validaciones Correspondientes', 'description' => 'Validaciones correspondientes realizadas.', 'filename' => 'charts/validaciones_correspondientes.png'],
        ['data' => $data['registros_revision_trampas'][0], 'title' => 'Registros de Revisión de Trampas', 'description' => 'Registros de revisiones de trampas para plagas.', 'filename' => 'charts/registros_revision_trampas.png'],
        ['data' => $data['registros_charlas_bpm'][0], 'title' => 'Registros de Charlas BPM', 'description' => 'Registros de charlas de Buenas Prácticas de Manufactura.', 'filename' => 'charts/registros_charlas_bpm.png'],
        ['data' => $data['charlas_bpm_programadas'][0], 'title' => 'Charlas BPM Programadas', 'description' => 'Charlas de BPM que fueron programadas.', 'filename' => 'charts/charlas_bpm_programadas.png'],
        ['data' => $data['auditorias_internas'][0], 'title' => 'Auditorías Internas', 'description' => 'Cantidad de auditorías internas realizadas.', 'filename' => 'charts/auditorias_internas.png'],
        ['data' => $data['auditorias_internas_programadas'][0], 'title' => 'Auditorías Internas Programadas', 'description' => 'Cantidad de auditorías internas programadas.', 'filename' => 'charts/auditorias_internas_programadas.png'],
        ['data' => $data['funcionarios_capacitados'][0], 'title' => 'Funcionarios Capacitados', 'description' => 'Número de funcionarios capacitados en el período.', 'filename' => 'charts/funcionarios_capacitados.png'],
        ['data' => $data['total_funcionarios_empresa'][0], 'title' => 'Total de Funcionarios en la Empresa', 'description' => 'Total de funcionarios en la empresa.', 'filename' => 'charts/total_funcionarios_empresa.png'],
        ['data' => $data['muestreos_calidad_turno'][0], 'title' => 'Muestreos de Calidad por Turno', 'description' => 'Muestreos de calidad realizados por turno.', 'filename' => 'charts/muestreos_calidad_turno.png'],
        ['data' => $data['muestreos_calidad_totales'][0], 'title' => 'Muestreos de Calidad Totales', 'description' => 'Total de muestreos de calidad realizados.', 'filename' => 'charts/muestreos_calidad_totales.png'],
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
