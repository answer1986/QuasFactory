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
                        <label for="rotacion_personal">N° de trabajadores que se retira</label>
                        <input type="number" id="rotacion_personal-1" name="rotacion_personal[]" step="any" inputmode="decimal" value="{{ old('rotacion_personal.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_trabajadores_periodo">N° total de trabajadores del período</label>
                        <input type="number" id="total_trabajadores_periodo-1" name="total_trabajadores_periodo[]" step="any" inputmode="decimal" value="{{ old('total_trabajadores_periodo.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="clima_laboral">Suma de puntuación del total de encuestas</label>
                        <input type="number" id="clima_laboral-1" name="clima_laboral[]" step="any" inputmode="decimal" value="{{ old('clima_laboral.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_encuestas_clima">N° de encuestas aplicadas</label>
                        <input type="number" id="total_encuestas_clima-1" name="total_encuestas_clima[]" step="any" inputmode="decimal" value="{{ old('total_encuestas_clima.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="escalafon_actualizacion">Actualización Escalafón remuneraciones</label>
                        <input type="number" id="escalafon_actualizacion-1" name="escalafon_actualizacion[]" step="any" inputmode="decimal" value="{{ old('escalafon_actualizacion.0') }}">
                        <span class="validation" id="validation-escalafon_actualizacion-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="ausentismo_laboral">N° de ausencias de trabajadores</label>
                        <input type="number" id="ausentismo_laboral-1" name="ausentismo_laboral[]" step="any" inputmode="decimal" value="{{ old('ausentismo_laboral.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="dotacion_total_periodo">Dotación total de trabajadores del período</label>
                        <input type="number" id="dotacion_total_periodo-1" name="dotacion_total_periodo[]" step="any" inputmode="decimal" value="{{ old('dotacion_total_periodo.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="horas_extras">N° de horas extras trabajadas</label>
                        <input type="number" id="horas_extras-1" name="horas_extras[]" step="any" inputmode="decimal" value="{{ old('horas_extras.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_horas_norma">N° de horas totales jornada laboral norma</label>
                        <input type="number" id="total_horas_norma-1" name="total_horas_norma[]" step="any" inputmode="decimal" value="{{ old('total_horas_norma.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="atraso_periodo">N° de horas totales de atraso</label>
                        <input type="number" id="atraso_periodo-1" name="atraso_periodo[]" step="any" inputmode="decimal" value="{{ old('atraso_periodo.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_horas_trabajadas">N° total de horas trabajadas por dotación completa</label>
                        <input type="number" id="total_horas_trabajadas-1" name="total_horas_trabajadas[]" step="any" inputmode="decimal" value="{{ old('total_horas_trabajadas.0') }}">
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
    'induccion_completa': { min: 100 },
    'rotacion_personal': { max: 5 },
    'clima_laboral': { min: 80 },
    'escalafon_actualizacion': { min: 2 },
    'ausentismo_laboral': { max: 3 },
    'horas_extras': { max: 5 },
    'atraso_periodo': { max: 3 }
};

const formulas = {
    'induccion_completa': (completas, total) => (completas / total) * 100,
    'rotacion_personal': (retirados, total) => (retirados / total) * 100,
    'clima_laboral': (puntuacion, total) => (puntuacion / total),
    'escalafon_actualizacion': (registros) => registros,
    'ausentismo_laboral': (ausencias, dotacion) => (ausencias / dotacion) * 100,
    'horas_extras': (extras, total) => (extras / total) * 100,
    'atraso_periodo': (atrasos, total) => (atrasos / total) * 100
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
        const induccionCompleta = formulas.induccion_completa(
            parseFloat(group.querySelector(`#induccion_completa-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_trabajadores_periodo-${groupIndex + 1}`).value) || 0
        );
        const rotacionPersonal = formulas.rotacion_personal(
            parseFloat(group.querySelector(`#rotacion_personal-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_trabajadores_periodo-${groupIndex + 1}`).value) || 0
        );
        const climaLaboral = formulas.clima_laboral(
            parseFloat(group.querySelector(`#clima_laboral-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_encuestas_clima-${groupIndex + 1}`).value) || 0
        );
        const escalafonActualizacion = formulas.escalafon_actualizacion(
            parseFloat(group.querySelector(`#escalafon_actualizacion-${groupIndex + 1}`).value) || 0
        );
        const ausentismoLaboral = formulas.ausentismo_laboral(
            parseFloat(group.querySelector(`#ausentismo_laboral-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#dotacion_total_periodo-${groupIndex + 1}`).value) || 0
        );
        const horasExtras = formulas.horas_extras(
            parseFloat(group.querySelector(`#horas_extras-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_horas_norma-${groupIndex + 1}`).value) || 0
        );
        const atrasoPeriodo = formulas.atraso_periodo(
            parseFloat(group.querySelector(`#atraso_periodo-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_horas_trabajadas-${groupIndex + 1}`).value) || 0
        );

        const data = [
            {
                label: "% de trabajadores con inducción de ingreso completa",
                value: induccionCompleta.toFixed(2),
                field: 'induccion_completa',
                isValid: validateField(induccionCompleta, 'induccion_completa')
            },
            {
                label: "Tasa de rotación de personal",
                value: rotacionPersonal.toFixed(2),
                field: 'rotacion_personal',
                isValid: validateField(rotacionPersonal, 'rotacion_personal')
            },
            {
                label: "Medición clima laboral (“suceso”)",
                value: climaLaboral.toFixed(2),
                field: 'clima_laboral',
                isValid: validateField(climaLaboral, 'clima_laboral')
            },
            {
                label: "Actualización Escalafón remuneraciones",
                value: escalafonActualizacion.toFixed(2),
                field: 'escalafon_actualizacion',
                isValid: validateField(escalafonActualizacion, 'escalafon_actualizacion')
            },
            {
                label: "Tasa de ausentismo laboral",
                value: ausentismoLaboral.toFixed(2),
                field: 'ausentismo_laboral',
                isValid: validateField(ausentismoLaboral, 'ausentismo_laboral')
            },
            {
                label: "Tasa horas extras por período",
                value: horasExtras.toFixed(2),
                field: 'horas_extras',
                isValid: validateField(horasExtras, 'horas_extras')
            },
            {
                label: "Tasa de atraso por período",
                value: atrasoPeriodo.toFixed(2),
                field: 'atraso_periodo',
                isValid: validateField(atrasoPeriodo, 'atraso_periodo')
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

@include('essencials.footer')
