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
                        <label for="retiro_produccion">N° de pallets que cumplen con especificaciones</label>
                        <input type="number" id="retiro_produccion-1" name="retiro_produccion[]" step="any" inputmode="decimal" value="{{ old('retiro_produccion.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_pallets_retirados">N° total de pallets retirados</label>
                        <input type="number" id="total_pallets_retirados-1" name="total_pallets_retirados[]" step="any" inputmode="decimal" value="{{ old('total_pallets_retirados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="envio_inventario">N° de inventarios enviados</label>
                        <input type="number" id="envio_inventario-1" name="envio_inventario[]" step="any" inputmode="decimal" value="{{ old('envio_inventario.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_inventarios_planificados">N° total de inventarios planificados</label>
                        <input type="number" id="total_inventarios_planificados-1" name="total_inventarios_planificados[]" step="any" inputmode="decimal" value="{{ old('total_inventarios_planificados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="verificacion_materias_primas">N° de comparaciones concordantes entre existencia física materia prima v/s inventario</label>
                        <input type="number" id="verificacion_materias_primas-1" name="verificacion_materias_primas[]" step="any" inputmode="decimal" value="{{ old('verificacion_materias_primas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_verificaciones_planificadas">N° total de verificaciones planificadas</label>
                        <input type="number" id="total_verificaciones_planificadas-1" name="total_verificaciones_planificadas[]" step="any" inputmode="decimal" value="{{ old('total_verificaciones_planificadas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="verificacion_producto_terminado">N° de comparaciones concordantes entre existencia física de producto terminado v/s inventario</label>
                        <input type="number" id="verificacion_producto_terminado-1" name="verificacion_producto_terminado[]" step="any" inputmode="decimal" value="{{ old('verificacion_producto_terminado.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="cumplimiento_envio_programacion">N° de programas de despacho de productos enviados dentro del plazo</label>
                        <input type="number" id="cumplimiento_envio_programacion-1" name="cumplimiento_envio_programacion[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_envio_programacion.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_programas_despacho">N° total de programas de despacho de productos planificadas</label>
                        <input type="number" id="total_programas_despacho-1" name="total_programas_despacho[]" step="any" inputmode="decimal" value="{{ old('total_programas_despacho.0') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="cumplimiento_estandar_embalaje">N° total de pallets que cumplen con estándar de embalaje</label>
                        <input type="number" id="cumplimiento_estandar_embalaje-1" name="cumplimiento_estandar_embalaje[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_estandar_embalaje.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_pallet_periodo">N° total de pallets por período</label>
                        <input type="number" id="total_pallet_periodo-1" name="total_pallet_periodo[]" step="any" inputmode="decimal" value="{{ old('total_pallet_periodo.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="cumplimiento_programa_despacho">N° total de despachos ejecutados</label>
                        <input type="number" id="cumplimiento_programa_despacho-1" name="cumplimiento_programa_despacho[]" step="any" inputmode="decimal" value="{{ old('cumplimiento_programa_despacho.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_despachos_planificados">N° total de despachos planificadas</label>
                        <input type="number" id="total_despachos_planificados-1" name="total_despachos_planificados[]" step="any" inputmode="decimal" value="{{ old('total_despachos_planificados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="eficiencia_emision_documentos">N° total de facturas emitidas</label>
                        <input type="number" id="eficiencia_emision_documentos-1" name="eficiencia_emision_documentos[]" step="any" inputmode="decimal" value="{{ old('eficiencia_emision_documentos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_despachos_ejecutados">N° total de despachos ejecutados</label>
                        <input type="number" id="total_despachos_ejecutados-1" name="total_despachos_ejecutados[]" step="any" inputmode="decimal" value="{{ old('total_despachos_ejecutados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="gestion_retiro_scrap">N° de retiros de scrap realizados</label>
                        <input type="number" id="gestion_retiro_scrap-1" name="gestion_retiro_scrap[]" step="any" inputmode="decimal" value="{{ old('gestion_retiro_scrap.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_retiros_scrap">N° total de retiros de scrap planificados</label>
                        <input type="number" id="total_retiros_scrap-1" name="total_retiros_scrap[]" step="any" inputmode="decimal" value="{{ old('total_retiros_scrap.0') }}">
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

const formulas = {
    'retiro_produccion': (cumplen, total) => (cumplen / total) * 100,
    'envio_inventario': (enviados, planificados) => (enviados / planificados) * 100,
    'verificacion_materias_primas': (concordantes, total) => (concordantes / total) * 100,
    'verificacion_producto_terminado': (concordantes, total) => (concordantes / total) * 100,
    'cumplimiento_envio_programacion': (enviados, planificados) => (enviados / planificados) * 100,
    'cumplimiento_estandar_embalaje': (cumplen, total) => (cumplen / total) * 100,
    'cumplimiento_programa_despacho': (ejecutados, planificados) => (ejecutados / planificados) * 100,
    'eficiencia_emision_documentos': (facturas, despachos) => (facturas / despachos) * 100,
    'gestion_retiro_scrap': (realizados, planificados) => (realizados / planificados) * 100
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
        const retiroProduccion = formulas.retiro_produccion(
            parseFloat(group.querySelector(`#retiro_produccion-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_pallets_retirados-${groupIndex + 1}`).value) || 0
        );
        const envioInventario = formulas.envio_inventario(
            parseFloat(group.querySelector(`#envio_inventario-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_inventarios_planificados-${groupIndex + 1}`).value) || 0
        );
        const verificacionMateriasPrimas = formulas.verificacion_materias_primas(
            parseFloat(group.querySelector(`#verificacion_materias_primas-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_verificaciones_planificadas-${groupIndex + 1}`).value) || 0
        );
        const verificacionProductoTerminado = formulas.verificacion_producto_terminado(
            parseFloat(group.querySelector(`#verificacion_producto_terminado-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_verificaciones_planificadas-${groupIndex + 1}`).value) || 0
        );
        const cumplimientoEnvioProgramacion = formulas.cumplimiento_envio_programacion(
            parseFloat(group.querySelector(`#cumplimiento_envio_programacion-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_programas_despacho-${groupIndex + 1}`).value) || 0
        );
        const cumplimientoEstandarEmbalaje = formulas.cumplimiento_estandar_embalaje(
            parseFloat(group.querySelector(`#cumplimiento_estandar_embalaje-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_pallet_periodo-${groupIndex + 1}`).value) || 0
        );
        const cumplimientoProgramaDespacho = formulas.cumplimiento_programa_despacho(
            parseFloat(group.querySelector(`#cumplimiento_programa_despacho-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_despachos_planificados-${groupIndex + 1}`).value) || 0
        );
        const eficienciaEmisionDocumentos = formulas.eficiencia_emision_documentos(
            parseFloat(group.querySelector(`#eficiencia_emision_documentos-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_despachos_ejecutados-${groupIndex + 1}`).value) || 0
        );
        const gestionRetiroScrap = formulas.gestion_retiro_scrap(
            parseFloat(group.querySelector(`#gestion_retiro_scrap-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_retiros_scrap-${groupIndex + 1}`).value) || 0
        );

        const data = [
            {
                label: "Retiro de producción interna",
                value: retiroProduccion.toFixed(2),
                field: 'retiro_produccion',
                isValid: validateField(retiroProduccion, 'retiro_produccion')
            },
            {
                label: "Envío de inventario",
                value: envioInventario.toFixed(2),
                field: 'envio_inventario',
                isValid: validateField(envioInventario, 'envio_inventario')
            },
            {
                label: "Verificación materias primas",
                value: verificacionMateriasPrimas.toFixed(2),
                field: 'verificacion_materias_primas',
                isValid: validateField(verificacionMateriasPrimas, 'verificacion_materias_primas')
            },
            {
                label: "Verificación producto terminado",
                value: verificacionProductoTerminado.toFixed(2),
                field: 'verificacion_producto_terminado',
                isValid: validateField(verificacionProductoTerminado, 'verificacion_producto_terminado')
            },
            {
                label: "Tasa cumplimiento envío programación de despacho",
                value: cumplimientoEnvioProgramacion.toFixed(2),
                field: 'cumplimiento_envio_programacion',
                isValid: validateField(cumplimientoEnvioProgramacion, 'cumplimiento_envio_programacion')
            },
            {
                label: "Tasa cumplimiento estándar de embalaje",
                value: cumplimientoEstandarEmbalaje.toFixed(2),
                field: 'cumplimiento_estandar_embalaje',
                isValid: validateField(cumplimientoEstandarEmbalaje, 'cumplimiento_estandar_embalaje')
            },
            {
                label: "Tasa de cumplimiento de programa de despacho de productos",
                value: cumplimientoProgramaDespacho.toFixed(2),
                field: 'cumplimiento_programa_despacho',
                isValid: validateField(cumplimientoProgramaDespacho, 'cumplimiento_programa_despacho')
            },
            {
                label: "Tasa de eficiencia emisión documentos mercantiles",
                value: eficienciaEmisionDocumentos.toFixed(2),
                field: 'eficiencia_emision_documentos',
                isValid: validateField(eficienciaEmisionDocumentos, 'eficiencia_emision_documentos')
            },
            {
                label: "Tasa gestión retiro de scrap",
                value: gestionRetiroScrap.toFixed(2),
                field: 'gestion_retiro_scrap',
                isValid: validateField(gestionRetiroScrap, 'gestion_retiro_scrap')
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
