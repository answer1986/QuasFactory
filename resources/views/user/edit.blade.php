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
<div class="container mt-5" id="container-edit">
    <h2 id ="editar-usuario">Editar Usuarios</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('user.edit') }}" method="POST">
        @csrf
        
        <table class="table" id="table-productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th> <!-- Asegúrate de añadir una columna para las acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><input type="text" name="users[{{ $user->id }}][name]" value="{{ $user->name }}"></td>
                    <td><input type="email" name="users[{{ $user->id }}][email]" value="{{ $user->email }}"></td>
                    <td><input type="text" name="users[{{ $user->id }}][role]" value="{{ $user->role }}"></td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas borrar este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      
        <button type="submit" class="btn btn-primary">Actualizar Usuarios</button>
    </form>
</div>

@endsection

@include('essencials/footer')
