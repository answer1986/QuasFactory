<?php

namespace App\Http\Controllers;

use App\Models\Rti;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RtiController extends Controller
{
    
    public function index()
    {
        return view('reporteria.rti');
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
        'planos_tecnicos_productos' => 'required|array',
        'planos_tecnicos_productos.*' => 'required|numeric',
        'total_productos_comercializados' => 'required|array',
        'total_productos_comercializados.*' => 'required|numeric',
        'planos_tecnicos_almacenados' => 'required|array',
        'planos_tecnicos_almacenados.*' => 'required|numeric',
        'total_maquinarias_industrial' => 'required|array',
        'total_maquinarias_industrial.*' => 'required|numeric',
        'planos_tecnicos_maquinaria' => 'required|array',
        'planos_tecnicos_maquinaria.*' => 'required|numeric',
        'planos_tecnicos_almacenados_maquinaria' => 'required|array',
        'planos_tecnicos_almacenados_maquinaria.*' => 'required|numeric',
        'total_maquinaria_existente' => 'required|array',
        'total_maquinaria_existente.*' => 'required|numeric',
        'manuales_maquinaria_productiva' => 'required|array',
        'manuales_maquinaria_productiva.*' => 'required|numeric',
        'total_maquinaria_productiva' => 'required|array',
        'total_maquinaria_productiva.*' => 'required|numeric',
        'usuarios_requerimientos_pendientes' => 'required|array',
        'usuarios_requerimientos_pendientes.*' => 'required|numeric',
        'total_usuarios_red' => 'required|array',
        'total_usuarios_red.*' => 'required|numeric',
        'licencias_activas' => 'required|array',
        'licencias_activas.*' => 'required|numeric',
        'total_softwares_usados' => 'required|array',
        'total_softwares_usados.*' => 'required|numeric',
        'plano_electrico_industrial' => 'required|array',
        'plano_electrico_industrial.*' => 'required|string',
        'plano_circuitos_informaticos' => 'required|array',
        'plano_circuitos_informaticos.*' => 'required|string',
        'planificacion_operaciones' => 'required|array',
        'planificacion_operaciones.*' => 'required|string',
    ]);

    // Procesar y almacenar los datos
    foreach ($data['startDate'] as $index => $startDate) {
        Rti::create([
            'start_date' => $startDate,
            'end_date' => $data['endDate'][$index],
            'planos_tecnicos_productos' => $data['planos_tecnicos_productos'][$index],
            'total_productos_comercializados' => $data['total_productos_comercializados'][$index],
            'planos_tecnicos_almacenados' => $data['planos_tecnicos_almacenados'][$index],
            'total_maquinarias_industrial' => $data['total_maquinarias_industrial'][$index],
            'planos_tecnicos_maquinaria' => $data['planos_tecnicos_maquinaria'][$index],
            'planos_tecnicos_almacenados_maquinaria' => $data['planos_tecnicos_almacenados_maquinaria'][$index],
            'total_maquinaria_existente' => $data['total_maquinaria_existente'][$index],
            'manuales_maquinaria_productiva' => $data['manuales_maquinaria_productiva'][$index],
            'total_maquinaria_productiva' => $data['total_maquinaria_productiva'][$index],
            'usuarios_requerimientos_pendientes' => $data['usuarios_requerimientos_pendientes'][$index],
            'total_usuarios_red' => $data['total_usuarios_red'][$index],
            'licencias_activas' => $data['licencias_activas'][$index],
            'total_softwares_usados' => $data['total_softwares_usados'][$index],
            'plano_electrico_industrial' => $data['plano_electrico_industrial'][$index],
            'plano_circuitos_informaticos' => $data['plano_circuitos_informaticos'][$index],
            'planificacion_operaciones' => $data['planificacion_operaciones'][$index],
        ]);
    }

        // Generate charts
        $charts = $this->generateCharts($request);
        $subjectTitle = 'Reporte de Indicadores de TI'; 
        $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'javier@trescastillos.cl' , 'soporte@quas.cl'];
        //$emails = ['arv00316@hotmail.com'];  
        foreach ($emails as $email) {
            Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));

        }
    
        return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
    }

    private function generateCharts($data)
{
    // Define the charts with their specific details
    $charts = [
        [
            'data' => $data['planos_tecnicos_productos'][0],
            'title' => 'Planos Técnicos de Productos',
            'description' => 'Número de planos técnicos de productos disponibles.',
            'filename' => 'charts/planos_tecnicos_productos.png'
        ],
        [
            'data' => $data['total_productos_comercializados'][0],
            'title' => 'Total de Productos Comercializados',
            'description' => 'Número total de productos comercializados.',
            'filename' => 'charts/total_productos_comercializados.png'
        ],
        [
            'data' => $data['planos_tecnicos_almacenados'][0],
            'title' => 'Planos Técnicos Almacenados',
            'description' => 'Número de planos técnicos almacenados.',
            'filename' => 'charts/planos_tecnicos_almacenados.png'
        ],
        [
            'data' => $data['total_maquinarias_industrial'][0],
            'title' => 'Total de Maquinarias Industrial',
            'description' => 'Número total de maquinarias en el sector industrial.',
            'filename' => 'charts/total_maquinarias_industrial.png'
        ],
        [
            'data' => $data['planos_tecnicos_maquinaria'][0],
            'title' => 'Planos Técnicos de Maquinaria',
            'description' => 'Número de planos técnicos específicos para maquinaria.',
            'filename' => 'charts/planos_tecnicos_maquinaria.png'
        ],
        [
            'data' => $data['planos_tecnicos_almacenados_maquinaria'][0],
            'title' => 'Planos Técnicos Almacenados de Maquinaria',
            'description' => 'Número de planos técnicos de maquinaria almacenados.',
            'filename' => 'charts/planos_tecnicos_almacenados_maquinaria.png'
        ],
        [
            'data' => $data['total_maquinaria_existente'][0],
            'title' => 'Total de Maquinaria Existente',
            'description' => 'Total de maquinaria existente en la planta.',
            'filename' => 'charts/total_maquinaria_existente.png'
        ],
        [
            'data' => $data['manuales_maquinaria_productiva'][0],
            'title' => 'Manuales de Maquinaria Productiva',
            'description' => 'Número de manuales disponibles para maquinaria productiva.',
            'filename' => 'charts/manuales_maquinaria_productiva.png'
        ],
        [
            'data' => $data['total_maquinaria_productiva'][0],
            'title' => 'Total de Maquinaria Productiva',
            'description' => 'Total de maquinaria productiva en operación.',
            'filename' => 'charts/total_maquinaria_productiva.png'
        ],
        [
            'data' => $data['usuarios_requerimientos_pendientes'][0],
            'title' => 'Usuarios con Requerimientos Pendientes',
            'description' => 'Número de usuarios con requerimientos pendientes en TI.',
            'filename' => 'charts/usuarios_requerimientos_pendientes.png'
        ],
        [
            'data' => $data['total_usuarios_red'][0],
            'title' => 'Total de Usuarios en la Red',
            'description' => 'Total de usuarios activos en la red de la empresa.',
            'filename' => 'charts/total_usuarios_red.png'
        ],
        [
            'data' => $data['licencias_activas'][0],
            'title' => 'Licencias Activas',
            'description' => 'Número total de licencias activas para software.',
            'filename' => 'charts/licencias_activas.png'
        ],
        [
            'data' => $data['total_softwares_usados'][0],
            'title' => 'Total de Softwares Usados',
            'description' => 'Total de softwares en uso en la empresa.',
            'filename' => 'charts/total_softwares_usados.png'
        ],
        [
            'data' => $data['plano_electrico_industrial'][0],
            'title' => 'Plano Eléctrico Industrial',
            'description' => 'Detalles del plano eléctrico del sector industrial.',
            'filename' => 'charts/plano_electrico_industrial.png'
        ],
        [
            'data' => $data['plano_circuitos_informaticos'][0],
            'title' => 'Plano de Circuitos Informáticos',
            'description' => 'Detalles del plano de circuitos informáticos de la empresa.',
            'filename' => 'charts/plano_circuitos_informaticos.png'
        ],
        [
            'data' => $data['planificacion_operaciones'][0],
            'title' => 'Planificación de Operaciones',
            'description' => 'Detalle de la planificación de operaciones de TI.',
            'filename' => 'charts/planificacion_operaciones.png'
        ],
    ];

    $images = [];
    //$nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
    $nodePath='/usr/local/nvm/versions/node/v18.20.3/bin/node';

    foreach ($charts as $chart) {
        $isSignificant = $chart['data'] >= 1000; // Asumiendo un criterio para algo significativo
        $process = new Process([
            $nodePath, 
            'generate_charts.js', 
            $chart['data'], 
            $chart['title'], 
            $chart['filename'], 
            $isSignificant ? 'true' : 'false'
        ]);

        $process->run();

        // Verificar si el proceso fue exitoso, y manejar errores
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Almacenar detalles del gráfico para uso posterior
        $chart['path'] = public_path($chart['filename']);
        $chart['name'] = basename($chart['filename']);
        $images[] = $chart;
    }

    return $images;
}



   
    public function show(Rti $rti)
    {
        //
    }

    public function edit(Rti $rti)
    {
        //
    }

    public function update(Request $request, Rti $rti)
    {
        //
    }

    public function destroy(Rti $rti)
    {
        //
    }
}
