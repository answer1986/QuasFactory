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

<h2 id="title-oc">Ingreso de indicadores de Reportería TI</h2>
<form id="dataForm" method="POST" action="{{ route('rti.store') }}" onsubmit="return validateForm()">
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
                        <label for="planos_tecnicos_productos">N° de planos técnicos de productos comercializados actualmente</label>
                        <input type="number" id="planos_tecnicos_productos-1" name="planos_tecnicos_productos[]" step="any" inputmode="decimal" value="{{ old('planos_tecnicos_productos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_productos_comercializados">N° de productos comercializados en la actualidad</label>
                        <input type="number" id="total_productos_comercializados-1" name="total_productos_comercializados[]" step="any" inputmode="decimal" value="{{ old('total_productos_comercializados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="planos_tecnicos_almacenados">N° de planos técnicos almacenados de acuerdo con estándar de seguridad de la información</label>
                        <input type="number" id="planos_tecnicos_almacenados-1" name="planos_tecnicos_almacenados[]" step="any" inputmode="decimal" value="{{ old('planos_tecnicos_almacenados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_maquinarias_industrial">N° total de maquinarias industrial existente</label>
                        <input type="number" id="total_maquinarias_industrial-1" name="total_maquinarias_industrial[]" step="any" inputmode="decimal" value="{{ old('total_maquinarias_industrial.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="planos_tecnicos_maquinaria">N° de planos técnicos de maquinaria industrial</label>
                        <input type="number" id="planos_tecnicos_maquinaria-1" name="planos_tecnicos_maquinaria[]" step="any" inputmode="decimal" value="{{ old('planos_tecnicos_maquinaria.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="planos_tecnicos_almacenados_maquinaria">N° de planos técnicos de maquinaria industrial almacenados de acuerdo con estándar de seguridad de la información</label>
                        <input type="number" id="planos_tecnicos_almacenados_maquinaria-1" name="planos_tecnicos_almacenados_maquinaria[]" step="any" inputmode="decimal" value="{{ old('planos_tecnicos_almacenados_maquinaria.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_maquinaria_existente">N° total de maquinaria existente en planta</label>
                        <input type="number" id="total_maquinaria_existente-1" name="total_maquinaria_existente[]" step="any" inputmode="decimal" value="{{ old('total_maquinaria_existente.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="manuales_maquinaria_productiva">N° de manuales de funcionamiento de maquinaria productiva</label>
                        <input type="number" id="manuales_maquinaria_productiva-1" name="manuales_maquinaria_productiva[]" step="any" inputmode="decimal" value="{{ old('manuales_maquinaria_productiva.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_maquinaria_productiva">N° de maquinaria productiva</label>
                        <input type="number" id="total_maquinaria_productiva-1" name="total_maquinaria_productiva[]" step="any" inputmode="decimal" value="{{ old('total_maquinaria_productiva.0') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="usuarios_requerimientos_pendientes">N° de usuarios con requerimientos TI pendientes</label>
                        <input type="number" id="usuarios_requerimientos_pendientes-1" name="usuarios_requerimientos_pendientes[]" step="any" inputmode="decimal" value="{{ old('usuarios_requerimientos_pendientes.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_usuarios_red">N° total de Usuarios Red TI de la empresa</label>
                        <input type="number" id="total_usuarios_red-1" name="total_usuarios_red[]" step="any" inputmode="decimal" value="{{ old('total_usuarios_red.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="licencias_activas">N° de licencias activas para operación de softwares</label>
                        <input type="number" id="licencias_activas-1" name="licencias_activas[]" step="any" inputmode="decimal" value="{{ old('licencias_activas.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="total_softwares_usados">N° total de softwares o aplicaciones en uso en la empresa</label>
                        <input type="number" id="total_softwares_usados-1" name="total_softwares_usados[]" step="any" inputmode="decimal" value="{{ old('total_softwares_usados.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="plano_electrico_industrial">Plano actualizado circuito eléctrico industrial planta</label>
                        <input type="text" id="plano_electrico_industrial-1" name="plano_electrico_industrial[]" value="{{ old('plano_electrico_industrial.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="plano_circuitos_informaticos">Plano actualizado red y circuitos informáticos de planta</label>
                        <input type="text" id="plano_circuitos_informaticos-1" name="plano_circuitos_informaticos[]" value="{{ old('plano_circuitos_informaticos.0') }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="planificacion_operaciones">Planificación actualizada de operaciones de la unidad</label>
                        <input type="text" id="planificacion_operaciones-1" name="planificacion_operaciones[]" value="{{ old('planificacion_operaciones.0') }}">
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
    'planos_tecnicos_productos': { min: 100 },
    'planos_tecnicos_almacenados': { min: 100 },
    'planos_tecnicos_maquinaria': { min: 100 },
    'planos_tecnicos_almacenados_maquinaria': { min: 100 },
    'manuales_maquinaria_productiva': { min: 100 },
    'usuarios_requerimientos_pendientes': { max: 5 },
    'licencias_activas': { min: 100 }
};

const formulas = {
    'planos_tecnicos_productos': (planos, productos) => (planos / productos) * 100,
    'planos_tecnicos_almacenados': (planos, productos) => (planos / productos) * 100,
    'planos_tecnicos_maquinaria': (planos, maquinaria) => (planos / maquinaria) * 100,
    'planos_tecnicos_almacenados_maquinaria': (planos, maquinaria) => (planos / maquinaria) * 100,
    'manuales_maquinaria_productiva': (manuales, maquinaria) => (manuales / maquinaria) * 100,
    'usuarios_requerimientos_pendientes': (pendientes, total) => (pendientes / total) * 100,
    'licencias_activas': (licencias, softwares) => (licencias / softwares) * 100
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
        const planosTecnicosProductos = formulas.planos_tecnicos_productos(
            parseFloat(group.querySelector(`#planos_tecnicos_productos-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_productos_comercializados-${groupIndex + 1}`).value) || 0
        );
        const planosTecnicosAlmacenados = formulas.planos_tecnicos_almacenados(
            parseFloat(group.querySelector(`#planos_tecnicos_almacenados-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_productos_comercializados-${groupIndex + 1}`).value) || 0
        );
        const planosTecnicosMaquinaria = formulas.planos_tecnicos_maquinaria(
            parseFloat(group.querySelector(`#planos_tecnicos_maquinaria-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_maquinarias_industrial-${groupIndex + 1}`).value) || 0
        );
        const planosTecnicosAlmacenadosMaquinaria = formulas.planos_tecnicos_almacenados_maquinaria(
            parseFloat(group.querySelector(`#planos_tecnicos_almacenados_maquinaria-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_maquinaria_existente-${groupIndex + 1}`).value) || 0
        );
        const manualesMaquinariaProductiva = formulas.manuales_maquinaria_productiva(
            parseFloat(group.querySelector(`#manuales_maquinaria_productiva-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_maquinaria_productiva-${groupIndex + 1}`).value) || 0
        );
        const usuariosRequerimientosPendientes = formulas.usuarios_requerimientos_pendientes(
            parseFloat(group.querySelector(`#usuarios_requerimientos_pendientes-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_usuarios_red-${groupIndex + 1}`).value) || 0
        );
        const licenciasActivas = formulas.licencias_activas(
            parseFloat(group.querySelector(`#licencias_activas-${groupIndex + 1}`).value) || 0,
            parseFloat(group.querySelector(`#total_softwares_usados-${groupIndex + 1}`).value) || 0
        );

        const data = [
            {
                label: "Planos técnicos de productos comercializados actualmente",
                value: planosTecnicosProductos.toFixed(2),
                field: 'planos_tecnicos_productos',
                isValid: validateField(planosTecnicosProductos, 'planos_tecnicos_productos')
            },
            {
                label: "Planos técnicos de productos almacenados de acuerdo con estándar de seguridad de la información",
                value: planosTecnicosAlmacenados.toFixed(2),
                field: 'planos_tecnicos_almacenados',
                isValid: validateField(planosTecnicosAlmacenados, 'planos_tecnicos_almacenados')
            },
            {
                label: "Planos técnicos de maquinaria industrial",
                value: planosTecnicosMaquinaria.toFixed(2),
                field: 'planos_tecnicos_maquinaria',
                isValid: validateField(planosTecnicosMaquinaria, 'planos_tecnicos_maquinaria')
            },
            {
                label: "Planos técnicos de maquinaria industrial almacenados de acuerdo con estándar de seguridad de la información",
                value: planosTecnicosAlmacenadosMaquinaria.toFixed(2),
                field: 'planos_tecnicos_almacenados_maquinaria',
                isValid: validateField(planosTecnicosAlmacenadosMaquinaria, 'planos_tecnicos_almacenados_maquinaria')
            },
            {
                label: "Manuales de funcionamiento de maquinaria productiva",
                value: manualesMaquinariaProductiva.toFixed(2),
                field: 'manuales_maquinaria_productiva',
                isValid: validateField(manualesMaquinariaProductiva, 'manuales_maquinaria_productiva')
            },
            {
                label: "Usuarios con requerimientos TI pendientes",
                value: usuariosRequerimientosPendientes.toFixed(2),
                field: 'usuarios_requerimientos_pendientes',
                isValid: validateField(usuariosRequerimientosPendientes, 'usuarios_requerimientos_pendientes')
            },
            {
                label: "Licencias activas para operación de softwares",
                value: licenciasActivas.toFixed(2),
                field: 'licencias_activas',
                isValid: validateField(licenciasActivas, 'licencias_activas')
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
