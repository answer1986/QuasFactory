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
<div class="row">
    <div class="col">
        <div id="calendar"></div>
    </div>

    <div class="col">
        <div class="container mt-5">
            <h2>Productos Disponibles</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Material Base</th>
                        <th>Pintura</th>
                        <th>Medida</th>
                        <th>Ancho</th>
                        <th>Observaciones</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos ?? [] as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->material_base }}</td>
                            <td>{{ $producto->pintura }}</td>
                            <td>{{ $producto->medida }}</td>
                            <td>{{ $producto->ancho }}</td>
                            <td>{{ $producto->observaciones }}</td>
                            <td>{{ $producto->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    
    </div>

</div>

@endsection 



@include('essencials/footer')