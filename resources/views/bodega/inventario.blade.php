@extends('layouts/all')

@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <h3> Instrucciones </h3>
        <p style= margin-left:0.5%>1.-Pistolea con el lector de barra el codigo del producto a incorporar.</p>
        <p>2.- Agrega una foto referencial. </p>
        <p>3.-Completa los campos que continuan.</p>
        <p>4.- Imprime el codigo que te arroga el sistema  para llevar el control interno.</p>
    </div>- Imprime el codigo que te arroga el sistema  para llevar el control interno.</p>
</div>
@endsection

@section('banner')
<br>
<div class="container">
    
    @include('partials.flash_messages')
    
    <!-- Botón para iniciar el inventario -->
    @if(!session('fecha_inicio_inventario'))
    <form action="{{ route('inventario.iniciar') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-info">Iniciar Inventario</button>
    </form>
    @endif

    <!-- Formulario para procesar los elementos del inventario -->
    @if(session('fecha_inicio_inventario'))
    <div class="card">
        <div class="card-header">
            <h3>Inventariar</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="codigo_barra">Lee código de Barras:</label>
                <input type="text" class="form-control" id="codigo_barra" required>
            </div>
            <div class="form-group">
                <label for="cantidad_sacos">Cantidad de Sacos:</label>
                <input type="number" class="form-control" id="cantidad_sacos" required>
            </div>
            <button type="button" id="agregar-inventario" class="btn btn-primary">Agregar a Inventario</button>
        </div>
    </div>
    @endif

    <!-- Resumen del inventario -->
    <div id="inventario-resumen">
        @if(session('fecha_inicio_inventario'))
        <h4>Inventario iniciado el: {{ session('fecha_inicio_inventario') }}</h4>
        <ul id="lista-inventario">
            <!-- Los ítems agregados al inventario se mostrarán aquí -->
        </ul>
        @endif
    </div>

    <!-- Botón para finalizar el inventario -->
    @if(session('fecha_inicio_inventario'))
    <form id="formulario-finalizar" action="{{ route('inventario.finalizar') }}" method="POST">
        @csrf
        <input type="hidden" id="datos-inventario" name="datos_inventario">
        <button type="button" id="finalizar-inventario" class="btn btn-success">Finalizar Inventario</button>
    </form>
    @endif

    <!-- Sección para mostrar e imprimir el código de barras generado -->
    @if(session('barcode'))
    <div class="barcode-container">
        <!-- Contenido para el código de barras -->
    </div>
    @endif

</div>
@endsection

@include('essencials/footer')










