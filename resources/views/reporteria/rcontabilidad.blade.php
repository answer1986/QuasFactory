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

<h2 id="title-oc">Ingreso de indicadores financieros</h2>
<form id="dataForm" method="POST" action="{{ route('rcontabilidad.store') }}" onsubmit="return validateForm()">
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
                        <label for="conciliacion_bancaria">Tasa asertividad conciliación bancaria del período</label>
                        <input type="number" id="conciliacion_bancaria-1" name="conciliacion_bancaria[]" step="any" inputmode="decimal" value="{{ old('conciliacion_bancaria.0') }}">
                        <span class="validation" id="validation-conciliacion_bancaria-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="liquidez_corriente">Tasa liquidez corriente</label>
                        <input type="number" id="liquidez_corriente-1" name="liquidez_corriente[]" step="any" inputmode="decimal" value="{{ old('liquidez_corriente.0') }}">
                        <span class="validation" id="validation-liquidez_corriente-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="ventas_netas">Ventas netas del período</label>
                        <input type="number" id="ventas_netas-1" name="ventas_netas[]" step="any" inputmode="decimal" value="{{ old('ventas_netas.0') }}">
                        <span class="validation" id="validation-ventas_netas-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="ventas_netas_tasa">Tasa de ventas netas por período</label>
                        <input type="number" id="ventas_netas_tasa-1" name="ventas_netas_tasa[]" step="any" inputmode="decimal" value="{{ old('ventas_netas_tasa.0') }}">
                        <span class="validation" id="validation-ventas_netas_tasa-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="rotacion_cuentas">Rotación cuentas por cobrar</label>
                        <input type="number" id="rotacion_cuentas-1" name="rotacion_cuentas[]" step="any" inputmode="decimal" value="{{ old('rotacion_cuentas.0') }}">
                        <span class="validation" id="validation-rotacion_cuentas-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="deudas_vencidas">% deudas vencidas</label>
                        <input type="number" id="deudas_vencidas-1" name="deudas_vencidas[]" step="any" inputmode="decimal" value="{{ old('deudas_vencidas.0') }}">
                        <span class="validation" id="validation-deudas_vencidas-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="solvencia_largo_plazo">Solvencia a largo plazo</label>
                        <input type="number" id="solvencia_largo_plazo-1" name="solvencia_largo_plazo[]" step="any" inputmode="decimal" value="{{ old('solvencia_largo_plazo.0') }}">
                        <span class="validation" id="validation-solvencia_largo_plazo-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="razon_endeudamiento">Razón de endeudamiento</label>
                        <input type="number" id="razon_endeudamiento-1" name="razon_endeudamiento[]" step="any" inputmode="decimal" value="{{ old('razon_endeudamiento.0') }}">
                        <span class="validation" id="validation-razon_endeudamiento-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="liquidez_corto_plazo">Razón liquidez corto plazo</label>
                        <input type="number" id="liquidez_corto_plazo-1" name="liquidez_corto_plazo[]" step="any" inputmode="decimal" value="{{ old('liquidez_corto_plazo.0') }}">
                        <span class="validation" id="validation-liquidez_corto_plazo-1"></span>
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
    'conciliacion_bancaria': { min: 100 },
    'liquidez_corriente': { min: 1.2 },
    'ventas_netas_tasa': { max: 5 },
    'deudas_vencidas': { max: 10 },
    'solvencia_largo_plazo': { min: 1 },
    'razon_endeudamiento': { max: 0.8 },
    'liquidez_corto_plazo': { min: 100 }
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
        const conciliacionBancaria = parseFloat(group.querySelector(`#conciliacion_bancaria-${groupIndex + 1}`).value) || 0;
        const liquidezCorriente = parseFloat(group.querySelector(`#liquidez_corriente-${groupIndex + 1}`).value) || 0;
        const ventasNetasTasa = parseFloat(group.querySelector(`#ventas_netas_tasa-${groupIndex + 1}`).value) || 0;
        const deudasVencidas = parseFloat(group.querySelector(`#deudas_vencidas-${groupIndex + 1}`).value) || 0;
        const solvenciaLargoPlazo = parseFloat(group.querySelector(`#solvencia_largo_plazo-${groupIndex + 1}`).value) || 0;
        const razonEndeudamiento = parseFloat(group.querySelector(`#razon_endeudamiento-${groupIndex + 1}`).value) || 0;
        const liquidezCortoPlazo = parseFloat(group.querySelector(`#liquidez_corto_plazo-${groupIndex + 1}`).value) || 0;

        const formulas = [
            {
                label: "Tasa asertividad conciliación bancaria del período",
                description: "(N ° de movimientos en cuentas bancarias identificados por período / N ° de movimientos totales en cuentas bancarias por período) x 100",
                value: conciliacionBancaria,
                field: 'conciliacion_bancaria'
            },
            {
                label: "Tasa liquidez corriente",
                description: "(Total activo circulante / total pasivo circulante)",
                value: liquidezCorriente,
                field: 'liquidez_corriente'
            },
            {
                label: "Tasa de ventas netas por período",
                description: "(Valor total de descuento en $ / Valor total de ventas en $) x 100",
                value: ventasNetasTasa,
                field: 'ventas_netas_tasa'
            },
            {
                label: "% deudas vencidas",
                description: "(Valor total $ cuentas por cobrar con retraso por período / Valor total $ cuentas por cobrar por período) x 100",
                value: deudasVencidas,
                field: 'deudas_vencidas'
            },
            {
                label: "Solvencia a largo plazo",
                description: "(Activos totales $ / Deuda total Largo plazo $) x 100",
                value: solvenciaLargoPlazo,
                field: 'solvencia_largo_plazo'
            },
            {
                label: "Razón de endeudamiento",
                description: "(Deuda total $ del período / capital total $ del período)",
                value: razonEndeudamiento,
                field: 'razon_endeudamiento'
            },
            {
                label: "Razón liquidez corto plazo",
                description: "((Total valor $ activo corriente - Total valor $ inventario) / Total $ pasivo corriente) x 100",
                value: liquidezCortoPlazo,
                field: 'liquidez_corto_plazo'
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

