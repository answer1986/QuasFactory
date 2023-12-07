@extends ('layouts/all')
@extends('essencials/nav')


@section('banner')
<div class="extra" id="contenedor-clientes">
    <h2 id="editar-cliente">Editar Clientes</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('clientes.update') }}" method="POST" >
        @csrf
        @method('PATCH')

        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Razón Social</th>
                    <th>Giro</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Dirección</th>
                    <th>País</th>
                    <th>Crédito</th>
                    <th>Otros</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td><img src="{{ asset('storage/clientes/' . $cliente->foto) }}" alt="{{ $cliente->nombre }}" width="100"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][nombre]" value="{{ $cliente->nombre }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][rut]" value="{{ $cliente->rut }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][razon_social]" value="{{ $cliente->razon_social }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][giro]" value="{{ $cliente->giro }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][telefono]" value="{{ $cliente->telefono }}"></td>
                        <td><input type="email" name="clientes[{{ $cliente->id }}][correo_electronico]" value="{{ $cliente->correo_electronico }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][direccion]" value="{{ $cliente->direccion }}"></td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][pais]" value="{{ $cliente->pais }}"></td>
                        <td>
                            <select name="clientes[{{ $cliente->id }}][credito]">
                                <option value="1" {{ $cliente->credito ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$cliente->credito ? 'selected' : '' }}>No</option>
                            </select>
                        </td>
                        <td><input type="text" name="clientes[{{ $cliente->id }}][otros]" value="{{ $cliente->otros }}"></td>
                        <td><input type="date" name="clientes[{{ $cliente->id }}][fecha_creacion]" value="{{ $cliente->fecha_creacion->format('Y-m-d') }}"></td>
                        <td>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas borrar este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Actualizar Clientes</button>
    </form>
</div>
@endsection






@extends('essencials/footer')
