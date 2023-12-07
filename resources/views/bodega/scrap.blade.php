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

    @section ('banner')
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <title>Formulario de Ingreso de Scrap</title>
        <h2 id="titulo-ingreso-scrap">Ingreso de Scrap</h2>
        <form action="{{ route('scraps.store') }}" method="post" id="materia-scrap">
            @csrf

            <label for="numero_oc">Número de OC:</label>
            <input type="text" id="numero_oc" name="numero_oc" required><br><br>

            <label for="kilos">Kilos:</label>
            <input type="number" id="kilos" name="kilos" required><br><br>

            <label for="otros">Otros:</label>
            <textarea id="otros" name="otros" rows="4"></textarea><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br><br>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required><br><br>

            <input type="submit" value="Registrar Ingreso de Scrap">
        </form>


    @endsection





@extends('essencials/footer')