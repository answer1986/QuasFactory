<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Programacion;
use Illuminate\Http\Request;
use App\Models\OrdenDeTrabajo;

class ProgramacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function showCalendar() {
        $productos = Producto::all();
        return view('produccion.programacion', compact('productos')); 
     }

    public function getEvents() {
        $events = Programacion::all();
        
        $calendarEvents = [];
        foreach ($events as $programacion) {
        $calendarEvents[] = [
            'title' => $programacion->numero_oc, // Puedes cambiar esto por algún campo de tu tabla si es necesario
            'start' => $programacion->fecha,
            'end' => $programacion->fecha_comprometida
        ];
    }
    
        return response()->json($calendarEvents);
    }

    public function mostrarProductos(){
        $productos = Producto::all();
        return view ('produccion.programacion',compact('productos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programacion  $programacion
     * @return \Illuminate\Http\Response
     */
    public function show(Programacion $programacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programacion  $programacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Programacion $programacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programacion  $programacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programacion $programacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programacion  $programacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programacion $programacion)
    {
        //
    }
}
