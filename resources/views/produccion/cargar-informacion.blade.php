@extends ('layouts/all')
@include('essencials/nav')

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
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<br>
<form action="{{ route('cargar-imagen') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="imagen" required>
    <button type="submit">Subir Imagen</button>
</form> 


@endsection


@include('essencials/footer')
