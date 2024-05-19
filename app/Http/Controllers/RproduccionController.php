<?php

namespace App\Http\Controllers;

use App\Models\Rproduccion;
use Illuminate\Http\Request;



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
        //
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
