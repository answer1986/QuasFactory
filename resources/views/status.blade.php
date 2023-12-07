<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de Control</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('ruta-a-tu-imagen-de-fondo') no-repeat center center fixed; 
            background-size: cover;
            overflow-x: hidden; 
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); 
            margin-top: 20px;
        }
        .card-header {
            font-weight: bold;
        }
        .metric-card {
            min-height: 150px; 
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-white mt-4 mb-4">Tablero de Información Bodega</h1>
        </div>
    </div>

    <!-- Productos Terminados -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mb-4">
            <div class="card metric-card">
                <div class="card-header bg-primary text-white">Productos Terminados</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($productosTerminados as $producto)
                            <li class="list-group-item">{{ $producto->codigo }} - {{ $producto->descripcion }} - Cantidad: {{ $producto->cantidad }}</li>
                        @empty
                            <li class="list-group-item">No hay productos terminados para mostrar.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Materias Primas -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card metric-card">
                <div class="card-header bg-warning text-dark">Materias Primas</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($materiasPrimas as $materia)
                            <li class="list-group-item">{{ $materia->codigo }} - {{ $materia->descripcion }} - Cantidad: {{ $materia->cantidad }}</li>
                        @empty
                            <li class="list-group-item">No hay materias primas para mostrar.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
