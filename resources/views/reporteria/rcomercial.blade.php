@extends('layouts/all')
@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <br>
    <div class="row">
        <h3>Seccion superior</h3>
        <p></p>
        <br>
        <br>
        <h3>Seccion Inferior</h3>
        <p></p>
        <br>
        <h3>Seccion x</h3>
        <p></p>
    </div>
</div>
@endsection

@section('banner')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h2 id="title-oc">Ingreso de indicadores {{$section ?? ''}}</h2>
<form id="dataForm" method="POST" action="{{ route('rcomercial.store') }}" onsubmit="return validateForm()">
    @csrf
    @if(session('error'))
    <div class="alert alert-danger">
            {{ session('error') }}
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

    <div id="formContainer">
        <div class="form-group" data-index="1">
            <div class="row" id="fechas">
                <div class="col-md-6">
                    <label for="startDate" id="fechainicio">
                        Fecha de inicio
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </label>
                    <input type="date" id="startDate-1" name="startDate[]" onchange="calculateDays(this)" value="{{ old('startDate.0') }}">
                </div>
                <div class="col-md-6">
                    <label for="endDate" id="fechainicio">
                        Fecha de fin
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </label>
                    <input type="date" id="endDate-1" name="endDate[]" onchange="calculateDays(this)" value="{{ old('endDate.0') }}">
                    <span class="days-count" id="daysCount-1"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="variacion_prog_dist">N° Variaciones Prog. Dist.</label>
                        <input type="number" id="variacion_prog_dist-1" name="variacion_prog_dist[]" step="any" inputmode="decimal" value="{{ old('variacion_prog_dist.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_prog_dist_solicitadas">N° total de Prog. Distrib solicitadas</label>
                        <input type="number" id="total_prog_dist_solicitadas-1" name="total_prog_dist_solicitadas[]" step="any" inputmode="decimal" value="{{ old('total_prog_dist_solicitadas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="clientes_finales">N° de clientes finales del período</label>
                        <input type="number" id="clientes_finales-1" name="clientes_finales[]" step="any" inputmode="decimal" value="{{ old('clientes_finales.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="clientes_nuevos">N° de clientes nuevos del periodo</label>
                        <input type="number" id="clientes_nuevos-1" name="clientes_nuevos[]" step="any" inputmode="decimal" value="{{ old('clientes_nuevos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="clientes_iniciales">N° clientes iniciales del período</label>
                        <input type="number" id="clientes_iniciales-1" name="clientes_iniciales[]" step="any" inputmode="decimal" value="{{ old('clientes_iniciales.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="clientes_antiguos">N° de clientes antiguos del período</label>
                        <input type="number" id="clientes_antiguos-1" name="clientes_antiguos[]" step="any" inputmode="decimal" value="{{ old('clientes_antiguos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="encuestas_satisfaccion">N° de encuestas con resultados ≥ 80% de satisfacción</label>
                        <input type="number" id="encuestas_satisfaccion-1" name="encuestas_satisfaccion[]" step="any" inputmode="decimal" value="{{ old('encuestas_satisfaccion.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_encuestas">N° total de encuestas del período</label>
                        <input type="number" id="total_encuestas-1" name="total_encuestas[]" step="any" inputmode="decimal" value="{{ old('total_encuestas.0') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="carpetas_completas">N° de carpetas de clientes completas</label>
                        <input type="number" id="carpetas_completas-1" name="carpetas_completas[]" step="any" inputmode="decimal" value="{{ old('carpetas_completas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_clientes">N° total de clientes</label>
                        <input type="number" id="total_clientes-1" name="total_clientes[]" step="any" inputmode="decimal" value="{{ old('total_clientes.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="devoluciones_productos">N° devoluciones de productos del período</label>
                        <input type="number" id="devoluciones_productos-1" name="devoluciones_productos[]" step="any" inputmode="decimal" value="{{ old('devoluciones_productos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_entregas">N° total de entregas del período</label>
                        <input type="number" id="total_entregas-1" name="total_entregas[]" step="any" inputmode="decimal" value="{{ old('total_entregas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="dias_espera">Suma de días en espera por respuesta a reclamos y/o consultas no cerradas</label>
                        <input type="number" id="dias_espera-1" name="dias_espera[]" step="any" inputmode="decimal" value="{{ old('dias_espera.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_reclamos_consultas">N° total reclamos y/o consultas recibidas</label>
                        <input type="number" id="total_reclamos_consultas-1" name="total_reclamos_consultas[]" step="any" inputmode="decimal" value="{{ old('total_reclamos_consultas.0') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="btn-graficos" onclick="generateCharts()">Generar Gráficos</button>
    <button type="submit">Subir métrica semanal</button>
</form>

<div id="chartsContainer" style="display: flex; flex-wrap: wrap; justify-content: center;"></div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
let charts = [];

const metas = {
    'variacion_programa': { max: 10 },
    'retencion_clientes': { min: 90 },
    'incorporacion_clientes': { min: 10 },
    'satisfaccion_clientes': { min: 80 },
    'carpetas_completas': { min: 80 },
    'devolucion_productos': { max: 3 },
    'tiempo_respuesta': { max: 3 }
};

const formulas = {
    'variacion_programa': (variaciones, total) => (variaciones / total) * 100,
    'retencion_clientes': (finales, nuevos, iniciales) => ((finales - nuevos) / iniciales) * 100,
    'incorporacion_clientes': (nuevos, antiguos) => (nuevos / antiguos) * 100,
    'satisfaccion_clientes': (satisfaccion, total) => (satisfaccion / total) * 100,
    'carpetas_completas': (completas, total) => (completas / total) * 100,
    'devolucion_productos': (devoluciones, entregas) => (devoluciones / entregas) * 100,
    'tiempo_respuesta': (dias, total) => dias / total,
};

function validateField(value, field) {
    const meta = metas[field];
    let isValid = false;
    if (meta.max !== undefined) {
        isValid = value <= meta.max;
    } else if (meta.min !== undefined) {
        isValid = value >= meta.min;
    }
    return isValid;
}

function calculateDays(input) {
    const group = input.closest('.form-group');
    const startDateInput = group.querySelector('input[name="startDate[]"]');
    const endDateInput = group.querySelector('input[name="endDate[]"]');
    const daysCountSpan = group.querySelector('.days-count');

    if (startDateInput.value && endDateInput.value) {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        const daysSelected = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        daysCountSpan.textContent = `Días seleccionados: ${daysSelected}`;
    }
}

function generateCharts() {
    // Limpiar los gráficos anteriores
    const chartsContainer = document.getElementById('chartsContainer');
    chartsContainer.innerHTML = '';

    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, groupIndex) => {
        const variacionPrograma = formulas.variacion_programa(
            parseFloat(group.querySelector(`#variacion_prog_dist-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_prog_dist_solicitadas-${groupIndex + 1}`).value) || 0
        );
        const retencionClientes = formulas.retencion_clientes(
            parseFloat(group.querySelector(`#clientes_finales-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#clientes_nuevos-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#clientes_iniciales-${groupIndex + 1}`).value) || 0
        );
        const incorporacionClientes = formulas.incorporacion_clientes(
            parseFloat(group.querySelector(`#clientes_nuevos-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#clientes_antiguos-${groupIndex + 1}`).value) || 0
        );
        const satisfaccionClientes = formulas.satisfaccion_clientes(
            parseFloat(group.querySelector(`#encuestas_satisfaccion-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_encuestas-${groupIndex + 1}`).value) || 0
        );
        const carpetasCompletas = formulas.carpetas_completas(
            parseFloat(group.querySelector(`#carpetas_completas-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_clientes-${groupIndex + 1}`).value) || 0
        );
        const devolucionProductos = formulas.devolucion_productos(
            parseFloat(group.querySelector(`#devoluciones_productos-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_entregas-${groupIndex + 1}`).value) || 0
        );
        const tiempoRespuesta = formulas.tiempo_respuesta(
            parseFloat(group.querySelector(`#dias_espera-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_reclamos_consultas-${groupIndex + 1}`).value) || 0
        );

        const data = [
            {
                label: "Tasa de variación programa distribución",
                value: variacionPrograma.toFixed(2),
                field: 'variacion_programa',
                isValid: validateField(variacionPrograma, 'variacion_programa')
            },
            {
                label: "Tasa retención clientes",
                value: retencionClientes.toFixed(2),
                field: 'retencion_clientes',
                isValid: validateField(retencionClientes, 'retencion_clientes')
            },
            {
                label: "Tasa incorporación clientes",
                value: incorporacionClientes.toFixed(2),
                field: 'incorporacion_clientes',
                isValid: validateField(incorporacionClientes, 'incorporacion_clientes')
            },
            {
                label: "Tasa de satisfacción de clientes",
                value: satisfaccionClientes.toFixed(2),
                field: 'satisfaccion_clientes',
                isValid: validateField(satisfaccionClientes, 'satisfaccion_clientes')
            },
            {
                label: "Tasa de carpetas comerciales completas",
                value: carpetasCompletas.toFixed(2),
                field: 'carpetas_completas',
                isValid: validateField(carpetasCompletas, 'carpetas_completas')
            },
            {
                label: "Tasa devolución de productos",
                value: devolucionProductos.toFixed(2),
                field: 'devolucion_productos',
                isValid: validateField(devolucionProductos, 'devolucion_productos')
            },
            {
                label: "Tiempo promedio respuesta a consultas y/o reclamos de clientes",
                value: tiempoRespuesta.toFixed(2),
                field: 'tiempo_respuesta',
                isValid: validateField(tiempoRespuesta, 'tiempo_respuesta')
            }
        ];

        data.forEach((item) => {
            const canvasContainer = document.createElement('div');
            canvasContainer.style.width = '400px';
            canvasContainer.style.margin = '10px';
            canvasContainer.style.textAlign = 'center';
            canvasContainer.style.position = 'relative';

            const canvas = document.createElement('canvas');
            canvas.width = 400;
            canvas.height = 400;
            canvasContainer.appendChild(canvas);

            const validationIcon = document.createElement('span');
            validationIcon.style.position = 'absolute';
            validationIcon.style.top = '10px';
            validationIcon.style.right = '10px';
            validationIcon.style.fontSize = '24px';
            validationIcon.style.color = item.isValid ? 'green' : 'red';
            validationIcon.textContent = item.isValid ? '✔️' : '❌';
            canvasContainer.appendChild(validationIcon);

            const ctx = canvas.getContext('2d');
            charts.push(new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [item.label, 'Restante'],
                    datasets: [{
                        data: [item.value, 100 - item.value],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            color: '#000',
                            font: {
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                if (context.dataIndex === 0) {
                                    return value + '%';
                                }
                                return '';
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                                }
                            }
                        }
                    },
                    responsive: false,
                    maintainAspectRatio: false
                }
            }));

            chartsContainer.appendChild(canvasContainer);
        });
    });
}

// Validación de formulario
function validateForm() {
    let valid = true;
    const requiredFields = document.querySelectorAll('#dataForm input[required]');
    requiredFields.forEach(field => {
        if (!field.value) {
            valid = false;
            field.classList.add('is-invalid');
            field.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Este campo es obligatorio.</div>');
        }
    });
    return valid;
}

// Limpiar mensajes de error al modificar los campos
document.querySelectorAll('#dataForm input').forEach(input => {
    input.addEventListener('input', function() {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
            const feedback = this.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.remove();
            }
        }
    });
});
</script>
@endsection
@include('essencials/footer')
