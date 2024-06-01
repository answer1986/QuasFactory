@extends('layouts.all')
@include('essencials.nav')

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

<h2 id="title-oc">Ingreso de indicadores de Recursos Humanos</h2>
<form id="dataForm" method="POST" action="{{ route('rrrhh.store') }}" onsubmit="return validateForm()">
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
                        <label for="induccion_completa">% de trabajadores con inducción de ingreso completa</label>
                        <input type="number" id="induccion_completa-1" name="induccion_completa[]" step="any" inputmode="decimal" value="{{ old('induccion_completa.0') }}">
                        <span class="validation" id="validation-induccion_completa-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="rotacion_personal">Tasa de rotación de personal</label>
                        <input type="number" id="rotacion_personal-1" name="rotacion_personal[]" step="any" inputmode="decimal" value="{{ old('rotacion_personal.0') }}">
                        <span class="validation" id="validation-rotacion_personal-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="clima_laboral">Medición clima laboral (“suceso”)</label>
                        <input type="number" id="clima_laboral-1" name="clima_laboral[]" step="any" inputmode="decimal" value="{{ old('clima_laboral.0') }}">
                        <span class="validation" id="validation-clima_laboral-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="escalafon_actualizacion">Actualización Escalafón remuneraciones</label>
                        <input type="number" id="escalafon_actualizacion-1" name="escalafon_actualizacion[]" step="any" inputmode="decimal" value="{{ old('escalafon_actualizacion.0') }}">
                        <span class="validation" id="validation-escalafon_actualizacion-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="ausentismo_laboral">Tasa de ausentismo laboral</label>
                        <input type="number" id="ausentismo_laboral-1" name="ausentismo_laboral[]" step="any" inputmode="decimal" value="{{ old('ausentismo_laboral.0') }}">
                        <span class="validation" id="validation-ausentismo_laboral-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="horas_extras">Tasa horas extras por período</label>
                        <input type="number" id="horas_extras-1" name="horas_extras[]" step="any" inputmode="decimal" value="{{ old('horas_extras.0') }}">
                        <span class="validation" id="validation-horas_extras-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="atraso_periodo">Tasa de atraso por período</label>
                        <input type="number" id="atraso_periodo-1" name="atraso_periodo[]" step="any" inputmode="decimal" value="{{ old('atraso_periodo.0') }}">
                        <span class="validation" id="validation-atraso_periodo-1"></span>
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
    'induccion_completa': { min: 100 },
    'rotacion_personal': { max: 5 },
    'clima_laboral': { min: 80 },
    'escalafon_actualizacion': { min: 2 },
    'ausentismo_laboral': { max: 3 },
    'horas_extras': { max: 5 },
    'atraso_periodo': { max: 3 }
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
        const induccionCompleta = parseFloat(group.querySelector(`#induccion_completa-${groupIndex + 1}`).value) || 0;
        const rotacionPersonal = parseFloat(group.querySelector(`#rotacion_personal-${groupIndex + 1}`).value) || 0;
        const climaLaboral = parseFloat(group.querySelector(`#clima_laboral-${groupIndex + 1}`).value) || 0;
        const escalafonActualizacion = parseFloat(group.querySelector(`#escalafon_actualizacion-${groupIndex + 1}`).value) || 0;
        const ausentismoLaboral = parseFloat(group.querySelector(`#ausentismo_laboral-${groupIndex + 1}`).value) || 0;
        const horasExtras = parseFloat(group.querySelector(`#horas_extras-${groupIndex + 1}`).value) || 0;
        const atrasoPeriodo = parseFloat(group.querySelector(`#atraso_periodo-${groupIndex + 1}`).value) || 0;

        const formulas = [
            {
                label: "% de trabajadores con inducción de ingreso completa",
                description: "(N ° de trabajadores con inducción completa en carpetas / N ° total de trabajadores de la empresa) x 100",
                value: induccionCompleta,
                field: 'induccion_completa'
            },
            {
                label: "Tasa de rotación de personal",
                description: "(N ° de trabajadores que se retira de la empresa por período / N ° de trabajadores de la empresa del período) x 100",
                value: rotacionPersonal,
                field: 'rotacion_personal'
            },
            {
                label: "Medición clima laboral (“suceso”)",
                description: "(Suma de puntuación del total de encuestas / N ° de encuestas aplicadas)",
                value: climaLaboral,
                field: 'clima_laboral'
            },
            {
                label: "Actualización Escalafón remuneraciones",
                description: "Registros de actualización y/o revisiones hechas al escalafón de sueldos de la empresa por período",
                value: escalafonActualizacion,
                field: 'escalafon_actualizacion'
            },
            {
                label: "Tasa de ausentismo laboral",
                description: "(N ° de ausencias de trabajadores por período / Dotación total de trabajadores del período) x 100",
                value: ausentismoLaboral,
                field: 'ausentismo_laboral'
            },
            {
                label: "Tasa horas extras por período",
                description: "(N ° de horas extras trabajadas por período / N ° de horas totales jornada laboral norma por período) x 100",
                value: horasExtras,
                field: 'horas_extras'
            },
            {
                label: "Tasa de atraso por período",
                description: "(N ° de horas totales de atraso de personal por período / N ° total de horas trabajadas por dotación completa por período) x 100",
                value: atrasoPeriodo,
                field: 'atraso_periodo'
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

@include('essencials.footer')

