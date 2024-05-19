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

@section('banner')

<h2 id="title-oc">Ingreso de indicadores{{$section ?? ''}}</h2>
<form id="dataForm">
    <div id="formContainer">
        <div class="form-group" data-index="1">
            <div class="row">
                
                    <label for="startDate" id="fechainicio">
                        Fecha de inicio
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </label>
                    <input type="date" id="startDate-1" name="startDate[]" onchange="calculateDays(this)">
                    
                    <label for="endDate" id="fechainicio" >
                        Fecha de fin
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </label>
                
                    <input type="date" id="endDate-1" name="endDate[]" onchange="calculateDays(this)">
                    <span class="days-count" id="daysCount-1"></span>
                    <br>
            </div>
            <div class="row">
                <label for="kilostotales">Total kilogramos de producidos en período</label>
                <input type="number" id="kilostotales-1" name="kilostotales[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-kilostotales-1"></span>
                
                <label for="kilosscrap">Total kilogramos de scrap del período</label>
                <input type="number" id="kilosscrap-1" name="kilosscrap[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-kilosscrap-1"></span>
                
                <label for="kilosprogramados">Kilogramos totales de producción programados para el período</label>
                <input type="number" id="kilosprogramados-1" name="kilosprogramados[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-kilosprogramados-1"></span>
                
                <label for="kiloproducto">Kilogramos totales por producto producidos en el período</label>
                <input type="number" id="kiloproducto-1" name="kiloproducto[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-kiloproducto-1"></span>
                
                <label for="totalkilosxmaquina">Total de kilogramos producidos por máquina por período</label>
                <input type="number" id="totalkilosxmaquina-1" name="totalkilosxmaquina[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-totalkilosxmaquina-1"></span>
                
                <label for="numerocambioxprog">N° de cambios hechos al programa de producción</label>
                <input type="number" id="numerocambioxprog-1" name="numerocambioxprog[]" step="any" inputmode="decimal">
                <span class="validation" id="validation-numerocambioxprog-1"></span>
                
                <div class="actions">
                    <button type="button" onclick="duplicateFormGroup(this)">Duplicar</button>
                    <button type="button" onclick="removeFormGroup(this)">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="btn-graficos" onclick="generateCharts()">Generar Gráficos</button>
</form>

<div id="chartsContainer" style="display: flex; flex-wrap: wrap; justify-content: center;"></div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

1uau2f6k

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

function duplicateFormGroup(button) {
    const formGroup = button.closest('.form-group');
    const formContainer = document.getElementById('formContainer');
    const newFormGroup = formGroup.cloneNode(true);

    const index = formContainer.children.length + 1;
    newFormGroup.setAttribute('data-index', index);
    
    newFormGroup.querySelectorAll('label, input, .validation, .days-count').forEach((element) => {
        if (element.tagName === 'LABEL') {
            const forAttribute = element.getAttribute('for');
            element.setAttribute('for', forAttribute.replace(/\d+/, index));
        }
        if (element.tagName === 'INPUT') {
            const id = element.getAttribute('id');
            element.setAttribute('id', id.replace(/\d+/, index));
            element.value = '';
        }
        if (element.classList.contains('validation') || element.classList.contains('days-count')) {
            element.setAttribute('id', element.getAttribute('id').replace(/\d+/, index));
            element.innerHTML = '';
        }
    });

    formContainer.appendChild(newFormGroup);
}

function removeFormGroup(button) {
    const formGroup = button.closest('.form-group');
    const formContainer = document.getElementById('formContainer');
    if (formContainer.children.length > 1) {
        formGroup.remove();
    } else {
        alert("No se puede eliminar el último conjunto de campos.");
    }
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

// Event listeners to ensure only numbers are entered
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9.]/g, '');
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'e' || e.key === '-' || e.key === '+') {
            e.preventDefault();
        }
    });

    input.addEventListener('paste', (e) => {
        const paste = (e.clipboardData || window.clipboardData).getData('text');
        if (!/^\d*\.?\d*$/.test(paste)) {
            e.preventDefault();
        }
    });
});

</script>
@endsection




@include('essencials/footer')