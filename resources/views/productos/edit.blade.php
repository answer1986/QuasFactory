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

    <h2 id="titulo-edicion-productos">Listado de Productos</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table" id="table-productos">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Material Base</th>
            <th>Pintura</th>
            <th>Medida</th>
            <th>Ancho</th>
            <th>Foto</th>
            <th>Estado</th> <!-- Nuevo encabezado para el select box -->
            <th>Acciones</th> <!-- Nuevo encabezado para los botones -->
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->material_base }}</td>
                <td>{{ $producto->pintura }}</td>
                <td>{{ $producto->medida }}</td>
                <td>{{ $producto->ancho }}</td>
                <td>
                    @if($producto->foto)
                        <img src="{{ asset('storage/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}" style="width:120px; height:80px">
                    @else
                        Sin imagen
                    @endif
                </td>
                <!-- Añadido select box para el estado del producto -->
                <td>
                    <select name="status" class="form-control">
                        <option value="available" {{ $producto->status == 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="unavailable" {{ $producto->status == 'unavailable' ? 'selected' : '' }}>No Disponible</option>
                    </select>
                </td>
                <!-- Añadido botones de actualizar y borrar -->
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Actualizar</a>
                    
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro que deseas borrar este producto?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection

@extends('essencials/footer')
