@extends ('layouts/all')
@extends('essencials/nav')

<!-- resources/views/sidebar.blade.php -->
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
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-5" id="adduser">
    <h3 id="adduser-title">Formulario de Creación de Usuarios</h3>
    <form  action="{{ route('user.store') }}" method="post">
    @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" placeholder="Ingrese nombre" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Contraseña:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Ingrese contraseña" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPwd">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="confirmPwd" placeholder="Confirme contraseña" name="password_confirmation" required>

        </div>
        <div class="form-group">
            <label for="role">Rol:</label>
            <select class="form-control" id="role" name="role">
                <option value="super admin">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="consultor">Consultor</option>
                <option value="gerente">Gerente</option>
                <option value="supervisor">Supervisor</option>
                <option value="operador">Operador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>


@endsection

@extends('essencials/footer')