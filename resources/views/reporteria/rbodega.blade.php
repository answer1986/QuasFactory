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

<h2 id="title-oc">Ingreso de indicadores de Bodega</h2>
<form id="dataForm" method="POST" action="{{ route('rbodega.store') }}" onsubmit="return validateForm()">
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
                        <label for="retiro_produccion">Retiro de producción interna</label>
                        <input type="number" id="retiro_produccion-1" name="retiro_produccion[]" step="any" inputmode="decimal" value="{{ old('retiro_produccion.0') }}">
                        <span class="validation" id="validation-retiro_produccion-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="envio_inventario">Envío de inventario</label>
                        <input type="number" id="envio_inventario-1" name="envio_inventario[]" step="any" inputmode="decimal" value="{{ old('envio_inventario.0') }}">
                        <span class="validation" id="validation-envio_inventario-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="verificacion_materias_primas">Verificación materias primas</label>
                        <input type="number" id="verificacion_materias_primas-1" name="verificacion_materias_primas[]" step="any" inputmode="decimal" value="{{ old('verificacion_materias_primas.0') }}">
                        <span class="validation" id="validation-verificacion_materias_primas-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="verificacion_producto_terminado">Verificación producto terminado</label>
                        <input type="number" id="verificacion_producto_terminado-1" name="verificacion_producto_terminado[]" step="any" inputmode="decimal" value="{{ old('verificacion_producto_terminado.0') }}">
                        <span class="validation" id="validation-verificacion_producto_terminado-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="cumplimiento_envio_programacion">Tasa cumplimiento envío programación de despacho</label>
                        <input type="number" id="cumplimiento_envio_programacion-1" name="cumplimiento_envio_programacion[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_envio_programacion.0') }}">
                        <span class="validation" id="validation-cumplimiento_envio_programacion-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="cumplimiento_estandar_embalaje">Tasa cumplimiento estándar de embalaje</label>
                        <input type="number" id="cumplimiento_estandar_embalaje-1" name="cumplimiento_estandar_embalaje[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_estandar_embalaje.0') }}">
                        <span class="validation" id="validation-cumplimiento_estandar_embalaje-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="cumplimiento_programa_despacho">Tasa de cumplimiento de programa de despacho de productos</label>
                        <input type="number" id="cumplimiento_programa_despacho-1" name="cumplimiento_programa_despacho[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_programa_despacho.0') }}">
                        <span class="validation" id="validation-cumplimiento_programa_despacho-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="eficiencia_emision_documentos">Tasa de eficiencia emisión documentos mercantiles</label>
                        <input type="number" id="eficiencia_emision_documentos-1" name="eficiencia_emision_documentos[]" step="any" inputmode="decimal" value="{{ old('eficiencia_emision_documentos.0') }}">
                        <span class="validation" id="validation-eficiencia_emision_documentos-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="gestion_retiro_scrap">Tasa gestión retiro de scrap</label>
                        <input type="number" id="gestion_retiro_scrap-1" name="gestion_retiro_scrap[]" step="any" inputmode="decimal" value="{{ old('gestion_retiro_scrap.0') }}">
                        <span class="validation" id="validation-gestion_retiro_scrap-1"></span>
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
    'retiro_produccion': { min: 100 },
    'envio_inventario': { min: 80 },
    'verificacion_materias_primas': { min: 100 },
    'verificacion_producto_terminado': { min: 100 },
    'cumplimiento_envio_programacion': { min: 100 },
    'cumplimiento_estandar_embalaje': { min: 90 },
    'cumplimiento_programa_despacho': { min: 100 },
    'eficiencia_emision_documentos': { min: 100 },
    'gestion_retiro_scrap': { min: 100 }
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
        const retiroProduccion = parseFloat(group.querySelector(`#retiro_produccion-${groupIndex + 1}`).value) || 0;
        const envioInventario = parseFloat(group.querySelector(`#envio_inventario-${groupIndex + 1}`).value) || 0;
        const verificacionMateriasPrimas = parseFloat(group.querySelector(`#verificacion_materias_primas-${groupIndex + 1}`).value) || 0;
        const verificacionProductoTerminado = parseFloat(group.querySelector(`#verificacion_producto_terminado-${groupIndex + 1}`).value) || 0;
        const cumplimientoEnvioProgramacion = parseFloat(group.querySelector(`#cumplimiento_envio_programacion-${groupIndex + 1}`).value) || 0;
        const cumplimientoEstandarEmbalaje = parseFloat(group.querySelector(`#cumplimiento_estandar_embalaje-${groupIndex + 1}`).value) || 0;
        const cumplimientoProgramaDespacho = parseFloat(group.querySelector(`#cumplimiento_programa_despacho-${groupIndex + 1}`).value) || 0;
        const eficienciaEmisionDocumentos = parseFloat(group.querySelector(`#eficiencia_emision_documentos-${groupIndex + 1}`).value) || 0;
        const gestionRetiroScrap = parseFloat(group.querySelector(`#gestion_retiro_scrap-${groupIndex + 1}`).value) || 0;

        const formulas = [
            {
                label: "Retiro de producción interna",
                description: "(N ° de pallets que cumplen con las especificaciones de la orden de producción/ N ° total de pallets retirados desde sellado) x 100",
                value: retiroProduccion,
                field: 'retiro_produccion'
            },
            {
                label: "Envío de inventario",
                description: "(N ° de inventarios enviados por período / N ° total de inventarios planificados para el período) x 100",
                value: envioInventario,
                field: 'envio_inventario'
            },
            {
                label: "Verificación materias primas",
                description: "(N ° de comparaciones concordantes entre existencia física materia prima v/s inventario / N ° total de verificaciones planificadas para el período) x 100",
                value: verificacionMateriasPrimas,
                field: 'verificacion_materias_primas'
            },
            {
                label: "Verificación producto terminado",
                description: "(N ° de comparaciones concordantes entre existencia física de producto terminado v/s inventario / N ° total de verificaciones planificadas para el período) x 100",
                value: verificacionProductoTerminado,
                field: 'verificacion_producto_terminado'
            },
            {
                label: "Tasa cumplimiento envío programación de despacho",
                description: "(N ° de programas de despacho de productos enviados dentro del plazo por período / N ° total de programas de despacho de productos planificadas para el período) x 100",
                value: cumplimientoEnvioProgramacion,
                field: 'cumplimiento_envio_programacion'
            },
            {
                label: "Tasa cumplimiento estándar de embalaje",
                description: "(N ° total de pallets que cumplen con estándar de embalaje por período / N ° total de pallet por período) x 100",
                value: cumplimientoEstandarEmbalaje,
                field: 'cumplimiento_estandar_embalaje'
            },
            {
                label: "Tasa de cumplimiento de programa de despacho de productos",
                description: "(N ° total de despachos ejecutados por período / N ° total de despachos planificadas para el período) x 100",
                value: cumplimientoProgramaDespacho,
                field: 'cumplimiento_programa_despacho'
            },
            {
                label: "Tasa de eficiencia emisión documentos mercantiles",
                description: "(N ° total de facturas emitidas por período de tiempo / N ° total de despachos ejecutados por período) x 100",
                value: eficienciaEmisionDocumentos,
                field: 'eficiencia_emision_documentos'
            },
            {
                label: "Tasa gestión retiro de scrap",
                description: "(N ° de retiros de scrap realizados por período / N ° total de retiros de scrap planificados para el período) x 100",
                value: gestionRetiroScrap,
                field: 'gestion_retiro_scrap'
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
