@extends ('layouts/all')
@extends('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

@endsection


@section('banner')

@section('banner')
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
<br>
<h2 id="titulo">Agregar Nuevo Producto</h2>
<form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data" id="product-form">
    @csrf <!-- Protección contra CSRF -->
    <label for="nombre" id="nombre-label">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>
    
    <label for="material_base" id="material-label">Material Base:</label>
    <input type="text" id="material_base" name="material_base" required><br><br>
    
    <label for="pintura" id="pintura-label">Pintura:</label>
    <input type="text" id="pintura" name="pintura" required><br><br>
    
    <label for="medida" id="medida-label">Medida:</label>
    <input type="text" id="medida" name="medida" required><br><br>
    
    <label for="ancho" id="ancho-label">Ancho:</label>
    <input type="text" id="ancho" name="ancho" required><br><br>

    <label for="cantidad" id="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" required><br><br>
    
    <label for="observaciones" id="observaciones-label">Observaciones:</label>
    <textarea id="observaciones" name="observaciones"></textarea><br><br>
    
    <label for="foto" id="foto-label">Foto del Producto:</label>
    <input type="file" id="foto" name="foto"><br><br>
    
    <input type="submit" value="Agregar Producto" id="submit-button">
</form>
@endsection


@extends('essencials/footer')