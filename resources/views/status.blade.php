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
            background-color: #f4f7f6; /* Un fondo más suave */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            margin-top: 20px;
            border: none; /* Eliminar bordes predeterminados */
            border-radius: 10px; /* Bordes redondeados para las tarjetas */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra suave para profundidad */
            overflow: hidden; /* Asegurar que el contenido no desborde */
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: 600; /* Negrita para el encabezado */
            background-color: #007bff; /* Color de fondo para el encabezado de la tarjeta */
            color: white; /* Color de texto para el encabezado de la tarjeta */
        }
        .card-body {
            padding: 20px;
            height: calc(100vh - 210px); /* Altura para mantener todo en una vista sin desplazamiento */
            overflow-y: auto; /* Habilitar el desplazamiento vertical si el contenido es demasiado largo */
        }
        .list-group-item {
            border: none; /* Eliminar bordes de los items */
            padding: 15px 20px; /* Espaciado interno más amplio */
        }
        .list-group-item:not(:last-child) {
            border-bottom: 1px solid #ececec; /* Línea divisoria suave entre items */
        }
        .pagination {
            justify-content: center; /* Centrar los enlaces de paginación */
        }
        /* Personalización de la paginación para que se integre mejor */
        .pagination .page-link {
            color: #007bff; /* Color del texto de los enlaces */
            background-color: #fff; /* Fondo de los enlaces */
            border: 1px solid #dee2e6; /* Borde de los enlaces */
        }
        .pagination .active .page-link {
            color: #fff; /* Color del texto para el item activo */
            background-color: #007bff; /* Fondo para el item activo */
            border-color: #007bff; /* Borde para el item activo */
        }
        .pagination > li > a .fa, 
        .pagination > li > a .fas, 
        .pagination > li > span .fa, 
        .pagination > li > span .fas {
        font-size: 0.5rem; /* Puedes ajustar esto según sea necesario */
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
                            <li class="list-group-item">{{ $producto->producto_id }} - Observaciones: {{ $producto->observaciones }} - Unidades: {{ $producto->unidades }}
                            </li>
                        @empty
                            <li class="list-group-item">No hay productos terminados para mostrar.</li>
                        @endforelse
                    </ul> 
                    {{ $productosTerminados->links() }}                   
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
                    {{ $materiasPrimas->links() }}
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
