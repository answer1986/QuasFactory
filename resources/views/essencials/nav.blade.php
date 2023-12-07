    @section('nav')
    <header>
        <nav class="navbar navbar-expand-lg d-flex justify-content-between" id="nav">
            <div class="container" id="container-nav">
                <!-- Título o logo -->
                <a class="navbar-brand" href="{{url('/dashboard') }}">Quas Factory</a>

                <!-- Enlaces de navegación -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        @foreach(['Usuarios', 'Productos', 'Clientes', 'Produccion', 'Bodega'] as $section)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink{{$section}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$section}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink{{$section}}">
                                    @if($section === 'Usuarios')
                                        <a class="dropdown-item" href="{{url('user/create') }}">Creacion de usuarios</a>
                                        <a class="dropdown-item" href="{{ url('user/edit') }}" class="btn btn-warning">Editar usuarios</a>
                                    @elseif($section === 'Productos')
                                        <a class="dropdown-item" href="{{url('productos/create') }}">Creacion de Productos</a>
                                        <a class="dropdown-item" href="{{ url('productos/edit') }}" class="btn btn-warning">Editar Productos</a>
                                    @elseif($section === 'Clientes')
                                        <a class="dropdown-item" href="{{url('clientes/create') }}">Creacion de Clientes</a>
                                        <a class="dropdown-item" href="{{ url('clientes/edit') }}" class="btn btn-warning">Editar Clientes</a>
                                    @elseif($section === 'Bodega')
                                        <a class="dropdown-item" href="{{url('bodega/materia') }}">Adicion de materia prima</a>
                                        <a class="dropdown-item" href="{{url('bodega/producto-terminado') }}">{{ $section === 'Bodega' ? 'Agregar productos terminado' : 'Edicion de ' . strtolower($section) }}</a>
                                    @endif
                                        @if($section === 'Produccion')
                                        <a class="dropdown-item" href="{{url('produccion/programacion') }}">Programacion Produccion</a>
                                        <a class="dropdown-item" href="{{url('produccion/tablero') }}">Status de Ordenes</a>
                                        <a class="dropdown-item" href="{{url('produccion/ingreso') }}">Ingreso a Produccion</a>
                                        <a class="dropdown-item" href="#">Automatizacion</a>

                                    @endif
                                    @if($section === 'Bodega')
                                        <a class="dropdown-item" href="{{url('bodega/scrap') }}">sumar scrap</a>
                                        <a class="dropdown-item" href="#">Balance</a>
                                        <a class="dropdown-item" href="{{url('bodega/inventario') }}">Inventario</a>
                                        <a class="dropdown-item" href="#">Almacenaje</a>
                                        <a class="dropdown-item" href="#">Despacho</a>
                                        <a class="dropdown-item" href="{{url('bodega/buscador') }}">Buscador codigo barras</a>


                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                
                </div>
                <!-- Botón para versión móvil -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-text ml-auto" id="user">
                 Bienvenido{{ Auth::check() ? ', ' . Auth::user()->name : '' }}
            </div>
        </nav>
    </header>
    @endsection
