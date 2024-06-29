<?php

namespace App\Http\Controllers;

use App\Models\Rcomercial;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
            Rcomercial::create([
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
            
        }
    
     
        //nuevo envio de correo 28-jun 

        $charts = $this->generateCharts($data);
            
        $subjectTitle = 'Reporte Comercial Actualizado'; 

        // Lista de correos a los que enviar
        $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'kathyn@trescastillos.cl' , 'soporte@quas.cl'];
       //$emails = ['arv00316@hotmail.com'];

        foreach ($emails as $email) {
            Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));
        }

        // Redirigir con un mensaje de éxito
            
            return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
        }
    

    

    private function generateCharts($data){
    // Define los gráficos a generar con sus detalles específicos
    $charts = [
        [
            'data' => $data['variacion_prog_dist'][0],
            'title' => 'Variación Programa Distribución',
            'description' => 'Variación en el programa de distribución',
            'filename' => 'charts/variacion_prog_dist.png',
        ],
        [
            'data' => $data['clientes_finales'][0],
            'title' => 'Clientes Finales',
            'description' => 'Número de clientes finales en el periodo',
            'filename' => 'charts/clientes_finales.png',
        ],
        [
            'data' => $data['clientes_nuevos'][0],
            'title' => 'Clientes Nuevos',
            'description' => 'Número de nuevos clientes obtenidos',
            'filename' => 'charts/clientes_nuevos.png',
        ],
        [
            'data' => $data['clientes_iniciales'][0],
            'title' => 'Clientes Iniciales',
            'description' => 'Número de clientes al inicio del periodo',
            'filename' => 'charts/clientes_iniciales.png',
        ],
        [
            'data' => $data['clientes_antiguos'][0],
            'title' => 'Clientes Antiguos',
            'description' => 'Número de clientes antiguos',
            'filename' => 'charts/clientes_antiguos.png',
        ],
        [
            'data' => $data['encuestas_satisfaccion'][0],
            'title' => 'Satisfacción del Cliente',
            'description' => 'Resultados de encuestas de satisfacción del cliente',
            'filename' => 'charts/encuestas_satisfaccion.png',
        ],
        [
            'data' => $data['total_encuestas'][0],
            'title' => 'Total Encuestas Realizadas',
            'description' => 'Total de encuestas realizadas a clientes',
            'filename' => 'charts/total_encuestas.png',
        ],
        [
            'data' => $data['carpetas_completas'][0],
            'title' => 'Carpetas Comerciales Completas',
            'description' => 'Número de carpetas comerciales completadas',
            'filename' => 'charts/carpetas_completas.png',
        ],
        [
            'data' => $data['total_clientes'][0],
            'title' => 'Total Clientes',
            'description' => 'Total de clientes en la base de datos',
            'filename' => 'charts/total_clientes.png',
        ],
        [
            'data' => $data['devoluciones_productos'][0],
            'title' => 'Devoluciones de Productos',
            'description' => 'Número de productos devueltos por clientes',
            'filename' => 'charts/devoluciones_productos.png',
        ],
        [
            'data' => $data['total_entregas'][0],
            'title' => 'Total Entregas',
            'description' => 'Total de productos entregados',
            'filename' => 'charts/total_entregas.png',
        ],
        [
            'data' => $data['dias_espera'][0],
            'title' => 'Días de Espera para Consultas',
            'description' => 'Promedio de días de espera para resolver consultas y reclamos',
            'filename' => 'charts/dias_espera.png',
        ],
        [
            'data' => $data['total_reclamos_consultas'][0],
            'title' => 'Total Reclamos y Consultas',
            'description' => 'Total de reclamos y consultas recibidas',
            'filename' => 'charts/total_reclamos_consultas.png',
        ]
    ];

    $images = [];
        //$nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
        $nodePath='/usr/local/nvm/versions/node/v18.20.3/bin/node';

    foreach ($charts as $chart) {
        $isSignificant = $chart['data'] >= 1000; // Establece un criterio significativo si es necesario
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

        // Guarda la ruta del archivo y el nombre en el array para su posterior uso
        $chart['path'] = public_path($chart['filename']);
        $chart['name'] = basename($chart['filename']);
        $images[] = $chart;
    }

        return $images;
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
