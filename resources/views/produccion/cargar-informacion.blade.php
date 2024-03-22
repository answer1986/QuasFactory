@extends ('layouts/all')
@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <br>
    <div class="row">
        <h3>Seccion superior</h3>
        <p>En la primera parte puedes cargar una foto de forma estatica</p>
        <br>
        <br>

        <h3>Seccion Inferior</h3>
        <p>En la segunda parte puedes cargar hasta 10 fotos con un maximo de 5mb</p>
    </div>
</div>
@endsection

@section('banner')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
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
<br>
<br>
<br>
<h2 style="margin-left:2%">Para cargar hasta 10 fotos</h2>

 <form action="{{ route('cargar-imagenes') }}" method="post" enctype="multipart/form-data">
   @csrf
   <input style="margin-left:2%" type="file" name="imagenes[]" accept="image/*" multiple>
   <button type="submit">Subir Imágenes</button>
 </form>
 


 

</body>


@endsection


@include('essencials/footer')
