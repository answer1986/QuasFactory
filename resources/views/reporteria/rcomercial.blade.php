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
                        <label for="variacion_programa">Tasa de variación programa distribución</label>
                        <input type="number" id="variacion_programa-1" name="variacion_programa[]" step="any" inputmode="decimal" value="{{ old('variacion_programa.0') }}">
                        <span class="validation" id="validation-variacion_programa-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="retencion_clientes">Tasa retención clientes</label>
                        <input type="number" id="retencion_clientes-1" name="retencion_clientes[]" step="any" inputmode="decimal" value="{{ old('retencion_clientes.0') }}">
                        <span class="validation" id="validation-retencion_clientes-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="incorporacion_clientes">Tasa incorporación clientes</label>
                        <input type="number" id="incorporacion_clientes-1" name="incorporacion_clientes[]" step="any" inputmode="decimal" value="{{ old('incorporacion_clientes.0') }}">
                        <span class="validation" id="validation-incorporacion_clientes-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="satisfaccion_clientes">Tasa de satisfacción de clientes</label>
                        <input type="number" id="satisfaccion_clientes-1" name="satisfaccion_clientes[]" step="any" inputmode="decimal" value="{{ old('satisfaccion_clientes.0') }}">
                        <span class="validation" id="validation-satisfaccion_clientes-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="carpetas_completas">Tasa de carpetas comerciales completas</label>
                        <input type="number" id="carpetas_completas-1" name="carpetas_completas[]" step="any" inputmode="decimal" value="{{ old('carpetas_completas.0') }}">
                        <span class="validation" id="validation-carpetas_completas-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="devolucion_productos">Tasa devolución de productos</label>
                        <input type="number" id="devolucion_productos-1" name="devolucion_productos[]" step="any" inputmode="decimal" value="{{ old('devolucion_productos.0') }}">
                        <span class="validation" id="validation-devolucion_productos-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="tiempo_respuesta">Tiempo promedio respuesta a consultas y/o reclamos de clientes</label>
                        <input type="number" id="tiempo_respuesta-1" name="tiempo_respuesta[]" step="any" inputmode="decimal" value="{{ old('tiempo_respuesta.0') }}">
                        <span class="validation" id="validation-tiempo_respuesta-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="capacitacion_personal">Tasa de capacitación personal</label>
                        <input type="number" id="capacitacion_personal-1" name="capacitacion_personal[]" step="any" inputmode="decimal" value="{{ old('capacitacion_personal.0') }}">
                        <span class="validation" id="validation-capacitacion_personal-1"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="btn-graficos" onclick="generateCharts()">Generar Gráficos</button>
    <button type="submit">Subir metrica semanal</button>
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
        const variacionPrograma = parseFloat(group.querySelector(`#variacion_programa-${groupIndex + 1}`).value) || 0;
        const retencionClientes = parseFloat(group.querySelector(`#retencion_clientes-${groupIndex + 1}`).value) || 0;
        const incorporacionClientes = parseFloat(group.querySelector(`#incorporacion_clientes-${groupIndex + 1}`).value) || 0;
        const satisfaccionClientes = parseFloat(group.querySelector(`#satisfaccion_clientes-${groupIndex + 1}`).value) || 0;
        const carpetasCompletas = parseFloat(group.querySelector(`#carpetas_completas-${groupIndex + 1}`).value) || 0;
        const devolucionProductos = parseFloat(group.querySelector(`#devolucion_productos-${groupIndex + 1}`).value) || 0;
        const tiempoRespuesta = parseFloat(group.querySelector(`#tiempo_respuesta-${groupIndex + 1}`).value) || 0;
        const capacitacionPersonal = parseFloat(group.querySelector(`#capacitacion_personal-${groupIndex + 1}`).value) || 0;

        const formulas = [
            {
                label: "Tasa de variación programa distribución",
                description: "(N ° Variaciones Prog. Dist. /N° total de Prog. Distrib solicitadas) x100",
                value: variacionPrograma,
                field: 'variacion_programa'
            },
            {
                label: "Tasa retención clientes",
                description: "((N ° de clientes finales del período – N° de clientes nuevos del periodo) /N ° clientes iniciales del período) x100",
                value: retencionClientes,
                field: 'retencion_clientes'
            },
            {
                label: "Tasa incorporación clientes",
                description: "(N ° de clientes nuevos del período / N ° de clientes antiguos del período) x 100",
                value: incorporacionClientes,
                field: 'incorporacion_clientes'
            },
            {
                label: "Tasa de satisfacción de clientes",
                description: "(N ° de encuestas con resultados iguales o superiores al 80% de satisfacción / N ° total de encuestas del período) x 100",
                value: satisfaccionClientes,
                field: 'satisfaccion_clientes'
            },
            {
                label: "Tasa de carpetas comerciales completas",
                description: "(N ° de carpetas de clientes completas / N ° total de clientes) x 100",
                value: carpetasCompletas,
                field: 'carpetas_completas'
            },
            {
                label: "Tasa devolución de productos",
                description: "(N ° devoluciones de productos del período / N ° total de entregas del período) x 100",
                value: devolucionProductos,
                field: 'devolucion_productos'
            },
            {
                label: "Tiempo promedio respuesta a consultas y/o reclamos de clientes",
                description: "(Suma de días en espera por respuesta a reclamos y/o consultas no cerradas en el período / N ° total reclamos y/o consultas recibidas en el período)",
                value: tiempoRespuesta,
                field: 'tiempo_respuesta'
            },
            {
                label: "Tasa de capacitación personal",
                description: "Tasa de capacitación personal",
                value: capacitacionPersonal,
                field: 'capacitacion_personal'
            },
        ];

        formulas.forEach((formula, formulaIndex) => {
            const isValid = validateField(formula.value, formula.field);
            const difference = 100 - formula.value;

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
            validationIcon.style.color = isValid ? 'green' : 'red';
            validationIcon.textContent = isValid ? '✔️' : '❌';
            canvasContainer.appendChild(validationIcon);

            const ctx = canvas.getContext('2d');
            charts.push(new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [formula.label, 'Restante'],
                    datasets: [{
                        label: formula.description,
                        data: [formula.value.toFixed(2), difference.toFixed(2)],
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
                                    return value.toFixed(2) + '%';
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
