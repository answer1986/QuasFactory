<?php

namespace App\Http\Controllers;

use App\Models\Rcontabilidad;
use Illuminate\Http\Request;
use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
            Rcontabilidad::create([
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
        }
        
        
        //nuevo envio de correo 28-jun 

        $charts = $this->generateCharts($data);
            
        $subjectTitle = 'Reporte Contabilidad Actualizado'; 

        // Lista de correos a los que enviar
        $emails = ['Michel@trescastillos.cl', 'irojas@quas.cl', 'soledad@trescastillos.cl' ,'soporte@quas.cl'];

        foreach ($emails as $email) {
            Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));
        }

        // Redirigir con un mensaje de éxito
            
            return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
        }


        private function generateCharts($data)
{
    // Define los gráficos a generar con sus detalles específicos
    $charts = [
        [
            'data' => $data['activo_total'][0],
            'title' => 'Activo Total',
            'description' => 'Descripción del activo total',
            'filename' => 'charts/activo_total.png',
        ],
        [
            'data' => $data['pasivo_corriente'][0],
            'title' => 'Pasivo Corriente',
            'description' => 'Descripción del pasivo corriente',
            'filename' => 'charts/pasivo_corriente.png',
        ],
        [
            'data' => $data['ventas_netas'][0],
            'title' => 'Ventas Netas',
            'description' => 'Descripción de las ventas netas',
            'filename' => 'charts/ventas_netas.png',
        ],
        [
            'data' => $data['activo_circulante'][0],
            'title' => 'Activo Circulante',
            'description' => 'Descripción del activo circulante',
            'filename' => 'charts/activo_circulante.png',
        ],
        [
            'data' => $data['deuda_total'][0],
            'title' => 'Deuda Total',
            'description' => 'Descripción de la deuda total',
            'filename' => 'charts/deuda_total.png',
        ]
    ];

    $images = [];
    //$nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
    $nodePath='/usr/local/nvm/versions/node/v18.20.3/bin/node';


    // Iterar sobre cada definición de gráfico para generarlos
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
