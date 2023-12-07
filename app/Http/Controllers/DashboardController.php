<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\OrdenDeTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\IngresoMateriaPrima; 
use App\Models\Inventario;
use App\Models\Almacen; 
use App\Models\Despacho; 
use App\Models\ProductoTerminado;


class DashboardController extends Controller
{
    public function index()
{
    $usuariosCount = User::count();
    $clientesCount = Cliente::count();
    $productosCount = Producto::count();
    $ordenesTrabajoCount = OrdenDeTrabajo::count();
    $ordenes = OrdenDeTrabajo::all();
    $productosTerminados = ProductoTerminado::all();
    $ingresosMateriaPrima = IngresoMateriaPrima::all();
    $productos = Producto::all();
    $inventarios = Inventario::all();

    return view('dashboard', [
        'ingresosMateriaPrima' => $ingresosMateriaPrima,
        'productos' => $productos,
        'inventarios' => $inventarios,
    ]);
    

    Log::info('Counts:', [
        'usuarios' => $usuariosCount,
        'clientes' => $clientesCount,
        'productos' => $productosCount
        
    ]);

    return view('dashboard', compact('usuariosCount', 'clientesCount', 'productosCount', 'ordenesTrabajoCount', 'ordenes', 'productosTerminados', 'ingresosMateriaPrima', 'productos', 'inventarios'));
}


    public function showStatus()
{
    $inventarioCount = Inventario::count();
    $almacenesCount = Almacen::count();
    $despachoCount = Despacho::count();

    return view('status_bodega', compact('inventarioCount', 'almacenesCount', 'despachoCount'));
}
}
