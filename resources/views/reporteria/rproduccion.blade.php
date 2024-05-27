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

<h2 id="title-oc">Ingreso de indicadores{{$section ?? ''}}</h2>
<form id="dataForm" method="POST" action="{{ route('rproduccion.store') }}" onsubmit="return validateForm()">
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
                        <label for="kilostotales">Total kilogramos de producidos en período</label>
                        <input type="number" id="kilostotales-1" name="kilostotales[]" step="any" inputmode="decimal" value="{{ old('kilostotales.0') }}">
                        <span class="validation" id="validation-kilostotales-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="kilosscrap">Total kilogramos de scrap del período</label>
                        <input type="number" id="kilosscrap-1" name="kilosscrap[]" step="any" inputmode="decimal" value="{{ old('kilosscrap.0') }}">
                        <span class="validation" id="validation-kilosscrap-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="kilosprogramados">Kilogramos totales de producción programados para el período</label>
                        <input type="number" id="kilosprogramados-1" name="kilosprogramados[]" step="any" inputmode="decimal" value="{{ old('kilosprogramados.0') }}">
                        <span class="validation" id="validation-kilosprogramados-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="kiloproducto">Kilogramos totales por producto producidos en el período</label>
                        <input type="number" id="kiloproducto-1" name="kiloproducto[]" step="any" inputmode="decimal" value="{{ old('kiloproducto.0') }}">
                        <span class="validation" id="validation-kiloproducto-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="totalkilosxmaquina">Total de kilogramos producidos por máquina por período</label>
                        <input type="number" id="totalkilosxmaquina-1" name="totalkilosxmaquina[]" step="any" inputmode="decimal" value="{{ old('totalkilosxmaquina.0') }}">
                        <span class="validation" id="validation-totalkilosxmaquina-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="numerocambioxprog">N° de cambios hechos al programa de producción</label>
                        <input type="number" id="numerocambioxprog-1" name="numerocambioxprog[]" step="any" inputmode="decimal" value="{{ old('numerocambioxprog.0') }}">
                        <span class="validation" id="validation-numerocambioxprog-1"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-inline">
                        <label for="kilosprodprog">kilogramos totales de producción por producto programados para el período</label>
                        <input type="number" id="kilosprodprog-1" name="kilosprodprog[]" step="any" inputmode="decimal" value="{{ old('kilosprodprog.0') }}">
                        <span class="validation" id="validation-kilosprodprog-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="kilosscrapproce">Total kilogramos scrap por proceso por período</label>
                        <input type="number" id="kilosscrapproce-1" name="kilosscrapproce[]" step="any" inputmode="decimal" value="{{ old('kilosscrapproce.0') }}">
                        <span class="validation" id="validation-kilosscrapproce-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="kiloproducxmaqperiod">Total de kilogramos de producción por proceso por período</label>
                        <input type="number" id="kiloproducxmaqperiod-1" name="kiloproducxmaqperiod[]" step="any" inputmode="decimal" value="{{ old('kiloproducxmaqperiod.0') }}">
                        <span class="validation" id="validation-kiloproducxmaqperiod-1"></span>
                    </div>
                    <div class="form-group-inline">
                        <label for="totalkilosxmaquina">Kilogramos programados para producción por máquina por período</label>
                        <input type="number" id="totalkilosxmaquina-1" name="totalkilosxmaquina[]" step="any" inputmode="decimal" value="{{ old('totalkilosxmaquina.1') }}">
                        <span class="validation" id="validation-totalkilosxmaquina-1"></span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="machine_type[]" value="general">
        </div>

        <!-- Extrusoras -->
        <h3>Extrusoras</h3>
        <div class="row">
            <!-- Extrusora 1 -->
            <div class="col-md-2">
                <div class="machine-group" id="extrusora-1">
                    <i class="fa fa-industry"></i> Extrusora 1
                    <input type="hidden" name="machine_type[]" value="extrusora">
                    <input type="hidden" name="machine_id[]" value="extrusora-1">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.0') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.0') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.0') }}">
                    <input type="number" name="kilosscrap[]" placeholder="Kilos scrap" class="kilos-scrap" value="{{ old('kilosscrap.0') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addExtrusoraLine('extrusora-1')"></i>
                    <i class="fa fa-minus-circle" onclick="removeExtrusoraLine('extrusora-1')"></i>
                </div>
            </div>
            <!-- Extrusora 2 -->
            <div class="col-md-2">
                <div class="machine-group" id="extrusora-2">
                    <i class="fa fa-industry"></i> Extrusora 2
                    <input type="hidden" name="machine_type[]" value="extrusora">
                    <input type="hidden" name="machine_id[]" value="extrusora-2">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.1') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.1') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.1') }}">
                    <input type="number" name="kilosscrap[]" placeholder="Kilos scrap" class="kilos-scrap" value="{{ old('kilosscrap.1') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addExtrusoraLine('extrusora-2')"></i>
                    <i class="fa fa-minus-circle" onclick="removeExtrusoraLine('extrusora-2')"></i>
                </div>
            </div>
            <!-- Extrusora 3 -->
            <div class="col-md-2">
                <div class="machine-group" id="extrusora-3">
                    <i class="fa fa-industry"></i> Extrusora 3
                    <input type="hidden" name="machine_type[]" value="extrusora">
                    <input type="hidden" name="machine_id[]" value="extrusora-3">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.2') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.2') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.2') }}">
                    <input type="number" name="kilosscrap[]" placeholder="Kilos scrap" class="kilos-scrap" value="{{ old('kilosscrap.2') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addExtrusoraLine('extrusora-3')"></i>
                    <i class="fa fa-minus-circle" onclick="removeExtrusoraLine('extrusora-3')"></i>
                </div>
            </div>
        </div>

        <!-- Selladoras -->
        <h3>Selladoras</h3>
        <div class="row">
            <!-- Selladora 1 -->
            <div class="col-md-2">
                <div class="machine-group" id="selladora-1">
                    <i class="fa fa-cog"></i> Selladora 1
                    <input type="hidden" name="machine_type[]" value="selladora">
                    <input type="hidden" name="machine_id[]" value="selladora-1">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.3') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.3') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.3') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addSelladoraLine('selladora-1')"></i>
                    <i class="fa fa-minus-circle" onclick="removeSelladoraLine('selladora-1')"></i>
                </div>
            </div>
            <!-- Selladora 2 -->
            <div class="col-md-2">
                <div class="machine-group" id="selladora-2">
                    <i class="fa fa-cog"></i> Selladora 2
                    <input type="hidden" name="machine_type[]" value="selladora">
                    <input type="hidden" name="machine_id[]" value="selladora-2">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.4') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.4') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.4') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addSelladoraLine('selladora-2')"></i>
                    <i class="fa fa-minus-circle" onclick="removeSelladoraLine('selladora-2')"></i>
                </div>
            </div>
            <!-- Selladora 3 -->
            <div class="col-md-2">
                <div class="machine-group" id="selladora-3">
                    <i class="fa fa-cog"></i> Selladora 3
                    <input type="hidden" name="machine_type[]" value="selladora">
                    <input type="hidden" name="machine_id[]" value="selladora-3">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.5') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.5') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.5') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addSelladoraLine('selladora-3')"></i>
                    <i class="fa fa-minus-circle" onclick="removeSelladoraLine('selladora-3')"></i>
                </div>
            </div>
            <!-- Selladora 4 -->
            <div class="col-md-2">
                <div class="machine-group" id="selladora-4">
                    <i class="fa fa-cog"></i> Selladora 4
                    <input type="hidden" name="machine_type[]" value="selladora">
                    <input type="hidden" name="machine_id[]" value="selladora-4">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.6') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.6') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.6') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addSelladoraLine('selladora-4')"></i>
                    <i class="fa fa-minus-circle" onclick="removeSelladoraLine('selladora-4')"></i>
                </div>
            </div>
            <!-- Selladora 5 -->
            <div class="col-md-2">
                <div class="machine-group" id="selladora-5">
                    <i class="fa fa-cog"></i> Selladora 5
                    <input type="hidden" name="machine_type[]" value="selladora">
                    <input type="hidden" name="machine_id[]" value="selladora-5">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.7') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.7') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.7') }}">

                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addSelladoraLine('selladora-5')"></i>
                    <i class="fa fa-minus-circle" onclick="removeSelladoraLine('selladora-5')"></i>
                </div>
            </div>
        </div>

        <!-- Microperforadoras -->
        <h3>Microperforadoras</h3>
        <div class="row">
            <!-- Microperforadora 1 -->
            <div class="col-md-2">
                <div class="machine-group" id="microperforadora-1">
                    <i class="fa fa-cogs"></i> Microperforadora 1
                    <input type="hidden" name="machine_type[]" value="microperforadora">
                    <input type="hidden" name="machine_id[]" value="microperforadora-1">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.8') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.8') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.8') }}">
                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addMicroperforadoraLine('microperforadora-1')"></i>
                    <i class="fa fa-minus-circle" onclick="removeMicroperforadoraLine('microperforadora-1')"></i>
                </div>
            </div>
            <!-- Microperforadora 2 -->
            <div class="col-md-2">
                <div class="machine-group" id="microperforadora-2">
                    <i class="fa fa-cogs"></i> Microperforadora 2
                    <input type="hidden" name="machine_type[]" value="microperforadora">
                    <input type="hidden" name="machine_id[]" value="microperforadora-2">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.9') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.9') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.9') }}">
                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addMicroperforadoraLine('microperforadora-2')"></i>
                    <i class="fa fa-minus-circle" onclick="removeMicroperforadoraLine('microperforadora-2')"></i>
                </div>
            </div>
            <!-- Microperforadora 3 -->
            <div class="col-md-2">
                <div class="machine-group" id="microperforadora-3">
                    <i class="fa fa-cogs"></i> Microperforadora 3
                    <input type="hidden" name="machine_type[]" value="microperforadora">
                    <input type="hidden" name="machine_id[]" value="microperforadora-3">
                    <input type="text" name="orden_produccion[]" placeholder="Orden de produccion" class="oc-input" value="{{ old('orden_produccion.10') }}">
                    <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input" value="{{ old('kilos_fabricados.10') }}">
                    <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input" value="{{ old('kilos_programados.10') }}">
                    <div class="extra-lines"></div>
                    <i class="fa fa-plus-circle" onclick="addMicroperforadoraLine('microperforadora-3')"></i>
                    <i class="fa fa-minus-circle" onclick="removeMicroperforadoraLine('microperforadora-3')"></i>
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
    'scrap': { max: 3 },
    'cumplimiento': { min: 100 },
    'cumpleprod': { min: 100 },
    'scrapxproc': { max: 3 },
    'prodxmaquina': { min: 100 },
    'produccionxproceso': { min: 100 },
    'numerocambioxprog': { max: 0 }
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
        const totalKilogramos = parseFloat(group.querySelector(`#kilostotales-${groupIndex + 1}`).value) || 0;
        const totalScrap = parseFloat(group.querySelector(`#kilosscrap-${groupIndex + 1}`).value) || 0;
        const totalProgramados = parseFloat(group.querySelector(`#kilosprogramados-${groupIndex + 1}`).value) || 0;
        const totalProducto = parseFloat(group.querySelector(`#kiloproducto-${groupIndex + 1}`).value) || 0;
        const totalMaquina = parseFloat(group.querySelector(`#totalkilosxmaquina-${groupIndex + 1}`).value) || 0;
        const numCambios = parseFloat(group.querySelector(`#numerocambioxprog-${groupIndex + 1}`).value) || 0;

        const formulas = [
            {
                label: "Tasa promedio de scrap",
                description: "(Total kilogramos de scrap del período / Total kilogramos producidos en período) x 100",
                value: (totalScrap / totalKilogramos) * 100,
                field: 'scrap'
            },
            {
                label: "Tasa cumplimiento meta productiva",
                description: "(kilogramos totales producidos en el período / kilogramos totales de producción programados para el período) x 100",
                value: (totalKilogramos / totalProgramados) * 100,
                field: 'cumplimiento'
            },
            {
                label: "Tasa cumplimiento meta por producto",
                description: "(kilogramos totales por producto producidos en el período / kilogramos totales de producción por producto programados para el período) x 100",
                value: (totalProducto / totalProgramados) * 100,
                field: 'cumpleprod'
            },
            {
                label: "Tasa de scrap por proceso",
                description: "(Total kilogramos scrap por proceso por período / Total de kilogramos de producción por proceso por período) x 100",
                value: (totalScrap / totalKilogramos) * 100,
                field: 'scrapxproc'
            },
            {
                label: "Tasa de producción por máquina",
                description: "(Total de kilogramos producidos por máquina por período / Kilogramos programados para producción por máquina por período) x 100",
                value: (totalMaquina / totalProgramados) * 100,
                field: 'prodxmaquina'
            },
            {
                label: "Tasa de producción por proceso",
                description: "(Kilogramos producidos por proceso por período / Kilogramos programados por proceso por período) x 100",
                value: (totalKilogramos / totalProgramados) * 100,
                field: 'produccionxproceso'
            },
            {
                label: "N° de cambios hechos al programa de producción",
                description: "N° de cambios hechos al programa de producción",
                value: numCambios,
                field: 'numerocambioxprog'
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

// Función para agregar líneas dinámicamente
function addExtrusoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length < 4) {
        const line = document.createElement('div');
        line.classList.add('extra-line');
        line.innerHTML = `
            <input type="text" name="orden_produccion[]" placeholder="Orden de producción" class="oc-input">
            <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input">
            <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input">
            <input type="number" name="kilosscrap[]" placeholder="Kilos scrap" class="kilos-scrap">
        `;
        extraLinesContainer.appendChild(line);
    } else {
        alert("No se pueden agregar más de 4 líneas.");
    }
}

function removeExtrusoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length > 0) {
        extraLinesContainer.removeChild(lines[lines.length - 1]);
    }
}

// Función para agregar líneas dinámicamente
function addSelladoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length < 4) {
        const line = document.createElement('div');
        line.classList.add('extra-line');
        line.innerHTML = `
            <input type="text" name="orden_produccion[]" placeholder="Orden de producción" class="oc-input">
            <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input">
            <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input">
        `;
        extraLinesContainer.appendChild(line);
    } else {
        alert("No se pueden agregar más de 4 líneas.");
    }
}

function removeSelladoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length > 0) {
        extraLinesContainer.removeChild(lines[lines.length - 1]);
    }
}

// Función para agregar líneas dinámicamente
function addMicroperforadoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length < 4) {
        const line = document.createElement('div');
        line.classList.add('extra-line');
        line.innerHTML = `
            <input type="text" name="orden_produccion[]" placeholder="Orden de producción" class="oc-input">
            <input type="number" name="kilos_fabricados[]" placeholder="Kilos fabricados" class="kilos-input">
            <input type="number" name="kilos_programados[]" placeholder="Kilos programados" class="kilos-input">
        `;
        extraLinesContainer.appendChild(line);
    } else {
        alert("No se pueden agregar más de 4 líneas.");
    }
}

function removeMicroperforadoraLine(machineId) {
    const machineGroup = document.getElementById(machineId);
    const extraLinesContainer = machineGroup.querySelector('.extra-lines');
    const lines = extraLinesContainer.querySelectorAll('div');
    if (lines.length > 0) {
        extraLinesContainer.removeChild(lines[lines.length - 1]);
    }
}

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
