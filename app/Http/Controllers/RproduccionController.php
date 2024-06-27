<?php

namespace App\Http\Controllers;

use App\Models\Rproduccion;
use Illuminate\Http\Request;

use App\Mail\IndicadoresMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;




class RproduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporteria.rproduccion');
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
             \Log::info($request->all());
     
             $validatedData = $request->validate([
                 'startDate.*' => 'required|date',
                 'endDate.*' => 'required|date',
                 'kilostotales.*' => 'required|integer',
                 'kilosscrap.*' => 'required|integer',
                 'kilosprogramados.*' => 'required|integer',
                 'kiloproducto.*' => 'required|integer',
                 'totalkilosxmaquina.*' => 'required|integer',
                 'numerocambioxprog.*' => 'required|integer',
                 'kilosprodprog.*' => 'required|integer',
                 'kilosscrapproce.*' => 'required|integer',
                 'kiloproducxmaqperiod.*' => 'required|integer',
                 'machine_type.*' => 'required|string',
                 'machine_id.*' => 'required|string',
                 'orden_produccion.*' => 'required|string',
                 'kilos_fabricados.*' => 'nullable|integer',
                 'kilos_programados.*' => 'nullable|integer',
             ]);
     
             foreach ($request->startDate as $index => $startDate) {
                 if (empty($request->kilostotales[$index]) || empty($request->kilosscrap[$index]) || empty($request->kilosprogramados[$index])) {
                     return redirect()->back()->withErrors(['error' => 'Todos los campos son obligatorios.']);
                 }
     
                 Rproduccion::create([
                     'start_date' => $startDate,
                     'end_date' => $request->endDate[$index],
                     'kilostotales' => $request->kilostotales[$index],
                     'kilosscrap' => $request->kilosscrap[$index],
                     'kilosprogramados' => $request->kilosprogramados[$index],
                     'kiloproducto' => $request->kiloproducto[$index],
                     'totalkilosxmaquina' => $request->totalkilosxmaquina[$index],
                     'numerocambioxprog' => $request->numerocambioxprog[$index],
                     'kilosprodprog' => $request->kilosprodprog[$index],
                     'kilosscrapproce' => $request->kilosscrapproce[$index],
                     'kiloproducxmaqperiod' => $request->kiloproducxmaqperiod[$index],
                     'machine_type' => $request->machine_type[$index],
                     'machine_id' => $request->machine_id[$index],
                     'orden_produccion' => $request->orden_produccion[$index] ?? null,
                     'kilos_fabricados' => $request->kilos_fabricados[$index] ?? null,
                     'kilos_programados' => $request->kilos_programados[$index] ?? null,
                 ]);
             }
     
             foreach ($request->all() as $key => $value) {
                 if (preg_match('/^orden_produccion_(extrusora|selladora|microperforadora)-\d+$/', $key)) {
                     foreach ($value as $i => $orden) {
                         $machine_id = str_replace('orden_produccion_', '', $key);
                         $machine_type = explode('-', $machine_id)[0];
                         Rproduccion::create([
                             'start_date' => $request->startDate[0],  
                             'end_date' => $request->endDate[0],      
                             'kilostotales' => $request->kilostotales[0], 
                             'kilosscrap' => $request->kilosscrap[0],      
                             'kilosprogramados' => $request->kilosprogramados[0], 
                             'kiloproducto' => $request->kiloproducto[0],  
                             'totalkilosxmaquina' => $request->totalkilosxmaquina[0], 
                             'numerocambioxprog' => $request->numerocambioxprog[0],   
                             'kilosprodprog' => $request->kilosprodprog[0],   // Assuming the same value for simplicity
                             'kilosscrapproce' => $request->kilosscrapproce[0],   // Assuming the same value for simplicity
                             'kiloproducxmaqperiod' => $request->kiloproducxmaqperiod[0],   // Assuming the same value for simplicity
                             'machine_type' => $machine_type,
                             'machine_id' => $machine_id,
                             'orden_produccion' => $orden,
                             'kilos_fabricados' => $request->{'kilos_fabricados_' . $machine_id}[$i] ?? null,
                             'kilos_programados' => $request->{'kilos_programados_' . $machine_id}[$i] ?? null,
                             'kilosscrap' => $request->{'kilosscrap_' . $machine_id}[$i] ?? null,
                         ]);
                     }
                 }
             }
     
            // Generate charts
            $charts = $this->generateCharts($request);
            $subjectTitle = 'Reporte de Indicadores de Producción'; 
            $emails = ['arv00316@hotmail.com', 'irojas@quas.cl'];
            foreach ($emails as $email) {
                Mail::to($email)->send(new IndicadoresMail($charts, $subjectTitle));

            }
        
            return redirect()->back()->with('success', 'Datos guardados y correos enviados exitosamente.');
        }
        
        private function generateCharts($request)
        {
            $charts = [
                [
                    'data' => $request->kilostotales[0],
                    'title' => 'Kilos Totales',
                    'description' => 'Total kilogramos de producidos en período',
                    'filename' => 'charts/kilostotales.png',
                ],
                [
                    'data' => $request->kilosscrap[0],
                    'title' => 'Kilos Scrap',
                    'description' => 'Total kilogramos de scrap del período',
                    'filename' => 'charts/kilosscrap.png',
                ],
                [
                    'data' => $request->kilosprogramados[0],
                    'title' => 'Kilos Programados',
                    'description' => 'Kilogramos totales de producción programados para el período',
                    'filename' => 'charts/kilosprogramados.png',
                ],
                [
                    'data' => $request->kiloproducto[0],
                    'title' => 'Kilos por Producto',
                    'description' => 'Kilogramos totales por producto producidos en el período',
                    'filename' => 'charts/kiloproducto.png',
                ],
                [
                    'data' => $request->totalkilosxmaquina[0],
                    'title' => 'Total Kilos por Máquina',
                    'description' => 'Total de kilogramos producidos por máquina por período',
                    'filename' => 'charts/totalkilosxmaquina.png',
                ],
                [
                    'data' => $request->numerocambioxprog[0],
                    'title' => 'Número de Cambios por Programa',
                    'description' => 'Número de cambios hechos al programa de producción',
                    'filename' => 'charts/numerocambioxprog.png',
                ],
                [
                    'data' => $request->kilosprodprog[0],
                    'title' => 'Kilos Producción por Programa',
                    'description' => 'Kilogramos totales de producción por programa',
                    'filename' => 'charts/kilosprodprog.png',
                ],
                [
                    'data' => $request->kilosscrapproce[0],
                    'title' => 'Kilos Scrap por Proceso',
                    'description' => 'Total kilogramos de scrap por proceso',
                    'filename' => 'charts/kilosscrapproce.png',
                ],
                [
                    'data' => $request->kiloproducxmaqperiod[0],
                    'title' => 'Kilos Producción por Máquina y Periodo',
                    'description' => 'Kilogramos de producción por máquina y periodo',
                    'filename' => 'charts/kiloproducxmaqperiod.png',
                ],
            ];
    
            $images = [];
            $nodePath = '/Users/alvaro/.nvm/versions/node/v18.17.0/bin/node';
    
            foreach ($charts as $chart) {
                $isGreen = $chart['data'] >= 100;
                $process = new Process([$nodePath, 'generate_charts.js', $chart['data'], $chart['title'], $chart['filename'], $isGreen ? 'true' : 'false']);
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
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function show(Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rproduccion $rproduccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rproduccion  $rproduccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rproduccion $rproduccion)
    {
        //
    }
}
