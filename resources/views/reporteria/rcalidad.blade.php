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

<h2 id="title-oc">Ingreso de indicadores de Reportería Calidad</h2>
<form id="dataForm" method="POST" action="{{ route('rcalidad.store') }}" onsubmit="return validateForm()">
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
                        <label for="informes_calidad_extrusion">N° de informes de calidad extrusión entregados durante el período</label>
                        <input type="number" id="informes_calidad_extrusion-1" name="informes_calidad_extrusion[]" step="any" inputmode="decimal" value="{{ old('informes_calidad_extrusion.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="informes_calidad_sellado">N° de informes de calidad sellado entregados durante el período</label>
                        <input type="number" id="informes_calidad_sellado-1" name="informes_calidad_sellado[]" step="any" inputmode="decimal" value="{{ old('informes_calidad_sellado.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="informes_alergenos">N° de informes de alérgenos entregados durante el período</label>
                        <input type="number" id="informes_alergenos-1" name="informes_alergenos[]" step="any" inputmode="decimal" value="{{ old('informes_alergenos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="registros_alergenos_entregados">N° de registros de alérgenos entregados durante el período</label>
                        <input type="number" id="registros_alergenos_entregados-1" name="registros_alergenos_entregados[]" step="any" inputmode="decimal" value="{{ old('registros_alergenos_entregados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="registros_alergenos_programados">N° de registros de alérgenos programados para el período</label>
                        <input type="number" id="registros_alergenos_programados-1" name="registros_alergenos_programados[]" step="any" inputmode="decimal" value="{{ old('registros_alergenos_programados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="inducciones_realizadas">N° de inducciones realizadas al personal durante el período</label>
                        <input type="number" id="inducciones_realizadas-1" name="inducciones_realizadas[]" step="any" inputmode="decimal" value="{{ old('inducciones_realizadas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="inducciones_correspondientes">N° de inducciones correspondientes al período</label>
                        <input type="number" id="inducciones_correspondientes-1" name="inducciones_correspondientes[]" step="any" inputmode="decimal" value="{{ old('inducciones_correspondientes.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="validaciones_masa_patron">N° de validaciones masa patrón ejecutadas por período</label>
                        <input type="number" id="validaciones_masa_patron-1" name="validaciones_masa_patron[]" step="any" inputmode="decimal" value="{{ old('validaciones_masa_patron.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="validaciones_correspondientes">N° de validaciones de masa patrón correspondientes al período</label>
                        <input type="number" id="validaciones_correspondientes-1" name="validaciones_correspondientes[]" step="any" inputmode="decimal" value="{{ old('validaciones_correspondientes.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="registros_revision_trampas">N° de registros de revisión trampas de roedores entregados durante el período</label>
                        <input type="number" id="registros_revision_trampas-1" name="registros_revision_trampas[]" step="any" inputmode="decimal" value="{{ old('registros_revision_trampas.0') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="registros_charlas_bpm">N° de registros de charlas de BPM realizados durante el período</label>
                        <input type="number" id="registros_charlas_bpm-1" name="registros_charlas_bpm[]" step="any" inputmode="decimal" value="{{ old('registros_charlas_bpm.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="charlas_bpm_programadas">N° de charlas de BPM programadas para el período</label>
                        <input type="number" id="charlas_bpm_programadas-1" name="charlas_bpm_programadas[]" step="any" inputmode="decimal" value="{{ old('charlas_bpm_programadas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="auditorias_internas">N° de auditorías internas ejecutadas durante el período</label>
                        <input type="number" id="auditorias_internas-1" name="auditorias_internas[]" step="any" inputmode="decimal" value="{{ old('auditorias_internas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="auditorias_internas_programadas">N° de auditorías internas programadas para el período</label>
                        <input type="number" id="auditorias_internas_programadas-1" name="auditorias_internas_programadas[]" step="any" inputmode="decimal" value="{{ old('auditorias_internas_programadas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="funcionarios_capacitados">N° de funcionarios capacitados en SGI y Calidad por período</label>
                        <input type="number" id="funcionarios_capacitados-1" name="funcionarios_capacitados[]" step="any" inputmode="decimal" value="{{ old('funcionarios_capacitados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_funcionarios_empresa">N° total de funcionarios de la empresa del período</label>
                        <input type="number" id="total_funcionarios_empresa-1" name="total_funcionarios_empresa[]" step="any" inputmode="decimal" value="{{ old('total_funcionarios_empresa.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="muestreos_calidad_turno">N° de muestreos de calidad ejecutados por turno</label>
                        <input type="number" id="muestreos_calidad_turno-1" name="muestreos_calidad_turno[]" step="any" inputmode="decimal" value="{{ old('muestreos_calidad_turno.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="muestreos_calidad_totales">N° de muestreos de calidad totales ejecutados por período</label>
                        <input type="number" id="muestreos_calidad_totales-1" name="muestreos_calidad_totales[]" step="any" inputmode="decimal" value="{{ old('muestreos_calidad_totales.0') }}">
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
    'registros_alergenos_entregados': { min: 100 },
    'inducciones_realizadas': { min: 100 },
    'validaciones_masa_patron': { min: 100 },
    'registros_charlas_bpm': { min: 100 },
    'auditorias_internas': { min: 100 },
    'funcionarios_capacitados': { min: 100 }
};

const formulas = {
    'registros_alergenos_entregados': (entregados, programados) => (entregados / programados) * 100,
    'inducciones_realizadas': (realizadas, correspondientes) => (realizadas / correspondientes) * 100,
    'validaciones_masa_patron': (ejecutadas, correspondientes) => (ejecutadas / correspondientes) * 100,
    'registros_charlas_bpm': (realizados, programadas) => (realizados / programadas) * 100,
    'auditorias_internas': (ejecutadas, programadas) => (ejecutadas / programadas) * 100,
    'funcionarios_capacitados': (capacitados, total) => (capacitados / total) * 100
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
        const registrosAlergenosEntregados = formulas.registros_alergenos_entregados(
            parseFloat(group.querySelector(`#registros_alergenos_entregados-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#registros_alergenos_programados-${groupIndex + 1}`).value) || 0
        );
        const induccionesRealizadas = formulas.inducciones_realizadas(
            parseFloat(group.querySelector(`#inducciones_realizadas-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#inducciones_correspondientes-${groupIndex + 1}`).value) || 0
        );
        const validacionesMasaPatron = formulas.validaciones_masa_patron(
            parseFloat(group.querySelector(`#validaciones_masa_patron-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#validaciones_correspondientes-${groupIndex + 1}`).value) || 0
        );
        const registrosCharlasBPM = formulas.registros_charlas_bpm(
            parseFloat(group.querySelector(`#registros_charlas_bpm-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#charlas_bpm_programadas-${groupIndex + 1}`).value) || 0
        );
        const auditoriasInternas = formulas.auditorias_internas(
            parseFloat(group.querySelector(`#auditorias_internas-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#auditorias_internas_programadas-${groupIndex + 1}`).value) || 0
        );
        const funcionariosCapacitados = formulas.funcionarios_capacitados(
            parseFloat(group.querySelector(`#funcionarios_capacitados-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_funcionarios_empresa-${groupIndex + 1}`).value) || 0
        );

        const data = [
            {
                label: "Registros de alérgenos entregados durante el período",
                value: registrosAlergenosEntregados.toFixed(2),
                field: 'registros_alergenos_entregados',
                isValid: validateField(registrosAlergenosEntregados, 'registros_alergenos_entregados')
            },
            {
                label: "Inducciones realizadas al personal durante el período",
                value: induccionesRealizadas.toFixed(2),
                field: 'inducciones_realizadas',
                isValid: validateField(induccionesRealizadas, 'inducciones_realizadas')
            },
            {
                label: "Validaciones masa patrón ejecutadas por período",
                value: validacionesMasaPatron.toFixed(2),
                field: 'validaciones_masa_patron',
                isValid: validateField(validacionesMasaPatron, 'validaciones_masa_patron')
            },
            {
                label: "Registros de charlas de BPM realizados durante el período",
                value: registrosCharlasBPM.toFixed(2),
                field: 'registros_charlas_bpm',
                isValid: validateField(registrosCharlasBPM, 'registros_charlas_bpm')
            },
            {
                label: "Auditorías internas ejecutadas durante el período",
                value: auditoriasInternas.toFixed(2),
                field: 'auditorias_internas',
                isValid: validateField(auditoriasInternas, 'auditorias_internas')
            },
            {
                label: "Funcionarios capacitados en SGI y Calidad por período",
                value: funcionariosCapacitados.toFixed(2),
                field: 'funcionarios_capacitados',
                isValid: validateField(funcionariosCapacitados, 'funcionarios_capacitados')
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
