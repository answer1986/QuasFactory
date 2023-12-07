@extends('layouts.all')
@include('essencials.nav')


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
<div class="d-flex justify-content-center mb-4">
    <div class="col-md-4">
        <form action="{{ route('tablero.index') }}" method="GET" class="p-3 rounded shadow-sm bg-white">
            <div class="input-group">
                <input type="text" class="form-control border-right-0 rounded-left" name="numero_oc" placeholder="Número de OC" value="{{ request('numero_oc') }}">
                <div class="input-group-append">
                    <button class="btn custom-search-button text-white" type="submit">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container mt-5">
    <h2 class="mb-4" id="producto-terminado">Tablero de Control de Producción</h2>
  

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Orden</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Tipo de Proceso</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Fecha Comprometida</th>
                <th>Estado</th>
                <th>Progreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenes as $orden)
            <tr>
                <td>{{ $orden->numero_oc }}</td>
                <td>{{ $orden->producto->nombre }}</td>
                <td>{{ $orden->cliente->nombre }}</td>
                <td>{{ $orden->tipo_proceso }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>{{ $orden->cantidad }}</td>
                <td>{{ $orden->fecha_comprometida }}</td>
                <td>{{ $orden->status_oc }}</td>
                <td>
                    <canvas id="progressChart{{ $orden->id }}" width="60" height="60"></canvas>
                    <script>
                        var ctx = document.getElementById('progressChart{{ $orden->id }}').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Completado', 'Restante'],
                                datasets: [{
                                    data: [{{ $orden->porcentaje_progreso }}, {{ 100 - $orden->porcentaje_progreso }}],
                                    backgroundColor: ['#007bff', '#e9ecef'],
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 80
                            }
                        });
                    </script>
                </td>

            </tr>
            @endforeach
            <script>
                // Calcular el progreso promedio
                var totalProgreso = 0;
                var totalOrdenes = {{ count($ordenes) }};

                @foreach($ordenes as $orden)
                    totalProgreso += {{ $orden->porcentaje_progreso }};
                @endforeach

                var promedioProgreso = totalProgreso / totalOrdenes;
                var restante = 100 - promedioProgreso;
            </script>

        </tbody>
    </table>
</div>

@endsection

@section('casos')
<div class="row" id="progress">
    <div class="col">
            <div class="col" id="barras-progreso">
                <h2>Progreso de Producción</h2>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="promedioEstruccion" aria-valuemin="0" aria-valuemax="100" style="width: promedioEstruccion%">
                        Estruccion - <span id="estrPercentage">0</span>% Complete
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="promedioSellado" aria-valuemin="0" aria-valuemax="100" style="width: promedioSellado%">
                        Sellado - <span id="sellPercentage">0</span>% Complete
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="promedioMicroperforado" aria-valuemin="0" aria-valuemax="100" style="width: promedioMicroperforado%">
                         Microperforado - <span id="microPercentage">0</span>% Complete
                    </div>
                </div>
             </div>
    </div>
    <div class="col" id="contenedor-torta">
        <canvas id="overallProgressChart" width="200" height="200"></canvas>
          
    </div>
</div>


@endsection




@include('essencials.footer')