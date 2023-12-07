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

<div class="container" id="codigo">
        <h3>Búsqueda por Código de Barras</h3>

        <form action="{{ route('buscador.searchByBarcode') }}" method="get">
            @csrf

            <div class="form-group">
                <label for="barcode">Pistolea el codigo de Barras:</label>
                <input type="text" name="barcode" id="barcode" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Aquí puedes mostrar los resultados de la búsqueda si lo deseas -->
    </div>


@endsection




@include('essencials/footer')

