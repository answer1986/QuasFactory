@extends('layouts/all')
@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <br>
    <div class="row">
        <h3>Seccion superior</h3>
        <p>En la primera parte puedes cargar una foto de forma estática</p>
        <br>
        <br>

        <h3>Seccion Inferior</h3>
        <p>En la segunda parte puedes cargar hasta 10 fotos con un máximo de 5mb</p>
        <br>
        <h3>Seccion Temporizador</h3>
        <p>En la tercera parte debes definir el tiempo de cambio de imagen antes de cargar las imágenes a mostrar</p>
    </div>
</div>
@endsection

@section('banner')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<br>
<h2 style="margin-left:2%">Para cargar una foto</h2>
<form action="{{ route('cargar-imagen') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input style="margin-left:2%" type="file" name="imagen" required>
    <button type="submit">Subir Imagen</button>
</form> 
<br>
<h2 style="margin-left:2%">Para cargar hasta 10 fotos</h2>
<form action="{{ route('cargar-imagenes') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input style="margin-left:2%" type="file" name="imagenes[]" accept="image/*" multiple>
    <button type="submit">Subir Imágenes</button>
</form>
<br>

<h2 style="margin-left:2%">Temporizador</h2>
<form action="{{ route('configurar-tiempo') }}" method="post">
    @csrf
    <input style="margin-left:2%" type="number" name="tiempoCambio" placeholder="Tiempo en minutos" required>
    <button type="submit">Configurar Tiempo</button>
</form>
<br>

<h2 style="margin-left:2%">Imágenes Cargadas</h2>
@if(isset($imagenes) && $imagenes->isNotEmpty())
    <form action="{{ route('eliminar-imagenes-seleccionadas') }}" method="POST" id="eliminarSeleccionadasForm">
        @csrf
        @method('DELETE')
        <div style="margin-left:2%">
            @foreach($imagenes as $imagen)
                <div style="display:inline-block; margin-right:10px; margin-bottom:10px;">
                    <img src="{{ asset('storage/imagenes/' . $imagen->nombre_archivo) }}" alt="Imagen" style="width: 100px; height: 100px;">
                    <div>
                        <input type="checkbox" name="imagenes[]" value="{{ $imagen->id }}"> Seleccionar
                        <br>
                       
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-danger" style="margin-left:2%">Eliminar Seleccionadas</button>
    </form>
@else
    <p style="margin-left:2%">No hay imágenes disponibles para mostrar.</p>
@endif
<br>  
<form id="eliminar-todas-las-imagenes-form" action="{{ route('eliminar-todas-las-imagenes') }}" method="POST" style="margin-left:2%;">
    @csrf
    @method('DELETE')
    <button type="button" onclick="eliminarTodasLasImagenes()">Eliminar Todas las Imágenes</button>
</form>
<br>

<script>
    function eliminarTodasLasImagenes() {
        if(confirm("¿Estás seguro de que quieres eliminar todas las imágenes?")) {
            document.getElementById('eliminar-todas-las-imagenes-form').submit();
        }
    }
</script>

@endsection

@include('essencials/footer')
