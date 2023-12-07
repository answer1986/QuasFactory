@extends ('layouts/all')
@extends('essencials/nav')




@section('banner')
<div class="container mt-5">
    <h2 id="titulo-clientes">Crear Cliente</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST"  id="formulario-creacion-cliente"enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto">
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>

        <div class="mb-3">
            <label for="rut" class="form-label">RUT</label>
            <input type="text" class="form-control" name="rut" id="rut" required>
        </div>

        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control" name="razon_social" id="razon_social" required>
        </div>

        <div class="mb-3">
            <label for="giro" class="form-label">Giro</label>
            <input type="text" class="form-control" name="giro" id="giro" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" required>
        </div>

        <div class="mb-3">
            <label for="correo_electronico" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control" name="pais" id="pais" required>
        </div>

        <div class="mb-3">
            <label for="credito" class="form-label">Crédito</label>
            <select class="form-control" name="credito" id="credito" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="otros" class="form-label">Otros</label>
            <textarea class="form-control" name="otros" id="otros"></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_creacion" class="form-label">Fecha Creación</label>
            <input type="date" class="form-control" name="fecha_creacion" id="fecha_creacion" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Cliente</button>
    </form>
</div>
<br>
@endsection




@extends('essencials/footer')
