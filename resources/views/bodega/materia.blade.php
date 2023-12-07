@extends ('layouts/all')
@extends('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <h3> Instrucciones </h3>
        <p style= margin-left:0.5%>1.-Pistolea con el lector de barra el codigo del producto a incorporar.</p>
        <p>2.- Agrega una foto referencial. </p>
        <p>3.-Completa los campos que continuan.</p>
        <p>4.- Imprime el codigo que te arroga el sistema  para llevar el control interno.</p>
    </div>
</div>

@endsection

@section ('banner')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('ingreso') ?? false)
<img src="{{ asset('storage/' . session('ingreso')->imagen_referencia) }}" alt="Imagen de Referencia" style="width:150px; height:150px;">
@endif




<h3 id="materia-prima">Ingreso de Materias Primas</h3>

<form action="{{ route('materia.store') }}" method="post" enctype="multipart/form-data" id="formulario-materia">
    @csrf
        <label for="tipo_materia"><h4>Tipo de Materia Prima:</h4></label>
       <br>
        <label for="codigo_barra">Código de Barras:</label>
        <input type="text" id="codigo_barra" name="codigo_barra" required>
        <br>
            <label for="imagen_referencia">Imagen de Referencia:</label>
            <input type="file" id="imagen_referencia" name="imagen_referencia">
        <br>
        <br>
        <select id="tipo_materia" name="tipo_materia">
            <option value="polietileno_hdpe">Polietileno de Alta Densidad (HDPE)</option>
            <option value="polipropileno_pp">Polipropileno (PP)</option>
            <option value="pvc">Policloruro de Vinilo (PVC)</option>
            <!-- Agrega más opciones según tus necesidades -->
        </select>

        <label for="cantidad" id="titulo-cantidad">Cantidad (en kilogramos):</label>
        <input type="number" id="cantidad" name="cantidad" required value="25">

        <label for="sacos" id="titulo-sacos">Cantidad (Sacos):</label>
        <input type="number" id="sacos" name="sacos" required>

        <label for="proveedor" id="titulo-proveedor">Proveedor:</label>
        <input type="text" id="proveedor" name="proveedor" required>

        <label for="fecha_ingreso" id="titulo-fecha-ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

        <label for="descripcion" id="titulo-descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4"></textarea>
        <br>
        <input type="submit" value="Registrar Ingreso" id="boton materia prima">
    </form>

    @if(session('barcode'))
   <div class="barcode-container" id="codigo-barra">
       <h3>Código de barras para el ingreso:</h3>
       <img src="{{ asset('storage/barcodes/' . basename(session('barcode'))) }}" alt="Código de Barras">
       <button onclick="printBarcode()">Imprimir Código de Barras</button>
   </div>
@endif

@endsection






@extends('essencials/footer')