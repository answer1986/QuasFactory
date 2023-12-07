@extends ('layouts/all')
@include('essencials/nav')

@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>
@endsection

@section('banner')
    <!-- Alertas -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Título -->
    <h2 id="title-oc">
        {{ isset($orden) ? 'Editar' : 'Crear' }} Orden de Trabajo
    </h2>

    <!-- Formulario -->
    <form 
        method="POST" 
        action="{{ route('ingreso.store') }}" 
        id="contenedor-oc">
        @csrf
        @if(isset($orden))
         @method('PATCH')
            <input type="hidden" name="id" value="{{ $orden->id }}">
        @endif


        <!-- Cliente -->
        <label for="cliente_id">Cliente:</label>
        <select 
            name="cliente_id" 
            id="cliente_id" 
            required 
            onchange="showClientImage()">
            <option value="" disabled selected>
                Seleccione un cliente
            </option>
            @foreach($clientes ?? [] as $cliente)
                <option 
                    value="{{ $cliente->id }}" 
                    data-img="{{ asset('storage/' . $cliente->foto) }}" 
                    {{ (isset($orden) && $orden->cliente_id == $cliente->id) ? 'selected' : '' }} >
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
        <br>

        <!-- Imagen del Cliente -->
        <img 
            id="client_image" 
            src="" 
            alt="Imagen del cliente" 
            style="max-width:200px; max-height:200px; display:none;">
        <br>

        <!-- Número OC -->
        <label for="numero_oc">Número OC:</label>
        <input 
            type="text" 
            name="numero_oc" 
            id="numero_oc" 
            value="{{ $orden->numero_oc ?? '' }}" 
            required>
        <br>

        <label for="extrusora">Selecciona Extrusora disponible:</label>
        <select name="extrusora" id="extrusora" required>
            <option value="" disabled selected>Seleccione una maquina...</option>
            
            <option value="extrusora1" {{ (isset($orden) && $orden->extrusora == 'extrusora1') ? 'selected' : '' }}>Extrusora 1</option>
            <option value="extrusora2" {{ (isset($orden) && $orden->extrusora == 'extrusora2') ? 'selected' : '' }}>Extrusora 2</option>
            <option value="extrusora3" {{ (isset($orden) && $orden->extrusora == 'extrusora3') ? 'selected' : '' }}>Extrusora 3</option>
        </select>
        <br>

        <label for="selladora">Selecciona Selladora disponible:</label>
        <select name="selladora" id="selladora" required>
            <option value="" disabled selected>Seleccione un tipo de proceso</option>
            <option value="selladora1" {{ (isset($orden) && $orden->selladora == 'selladora1') ? 'selected' : '' }}>Selladora1</option>
            <option value="selladora2" {{ (isset($orden) && $orden->selladora == 'selladora2') ? 'selected' : '' }}>Selladora2</option>
            <option value="selladora3" {{ (isset($orden) && $orden->selladora == 'selladora3') ? 'selected' : '' }}>Selladora3</option>
        </select>
        <br>    

        <label for="microperforadora">Selecciona Microperforadora disponible:</label>
        <select name="microperforadora" id="microperforadora" required>
            <option value="" disabled selected>Seleccione un tipo de proceso</option>
            <option value="microperforadora1" {{ (isset($orden) && $orden->tipo_proceso == 'microperforadora1') ? 'selected' : '' }}>microperforadora1</option>
            <option value="microperforadora2" {{ (isset($orden) && $orden->tipo_proceso == 'microperforadora2') ? 'selected' : '' }}>microperforadora2</option>
            <option value="microperforadora3" {{ (isset($orden) && $orden->tipo_proceso == 'microperforadora3 ') ? 'selected' : '' }}>microperforadora3</option>
        </select>
        <br>

        <!-- Producto -->
        <label for="tipo_proceso">Tipo de Producto:</label>
        <select name="producto_id" id="producto_id" required>
            <option value="" disabled selected>Seleccione un producto</option>
            @foreach($productos as $producto)
            <option 
                value="{{ $producto->id }}" 
                {{ (isset($orden) && $orden->producto_id == $producto->id) ? 'selected' : '' }}>
                {{ $producto->nombre }} <!-- Asegúrate de que tu modelo 'Producto' tiene una columna 'nombre' -->
            </option>
            @endforeach
        </select>



        <!-- Fecha -->
        <label for="fecha" style= "text-color:black">Fecha:</label>
        <input 
            type="date" 
            name="fecha" 
            id="fecha" 
            value="{{ $orden->fecha ?? '' }}" 
            required>
        <br>
        
        <!-- Cantidad -->
        <label for="cantidad">Cantidad:</label>
        <input 
            type="number" 
            name="cantidad" 
            id="cantidad" 
            value="{{ $orden->cantidad ?? '' }}" 
            required>
        <br>
        
        <!-- Fecha Comprometida -->
        <label for="fecha_comprometida">Fecha Comprometida:</label>
        <input 
            type="date" 
            name="fecha_comprometida" 
            id="fecha_comprometida" 
            value="{{ $orden->fecha_comprometida ?? '' }}" 
            required>
        <br>
        
        <!-- Estado OC -->
        <label for="status_oc">Estado OC:</label>
        <select 
            name="status_oc" 
            id="status_oc" 
            required>
            <option value="" disabled selected>
                Seleccione un estado
            </option>
            <option value="En Progreso" {{ (isset($orden) && $orden->status_oc == 'En Progreso') ? 'selected' : '' }}>
                En Progreso
            </option>
            <option value="Detenida" {{ (isset($orden) && $orden->status_oc == 'Detenida') ? 'selected' : '' }}>
                Detenida
            </option>
            <option value="Terminada" {{ (isset($orden) && $orden->status_oc == 'Terminada') ? 'selected' : '' }}>
                Terminada
            </option>
        </select>
        <br>

        <!-- Porcentaje de Progreso -->
        <label for="porcentaje_progreso">Porcentaje de Progreso:</label>
        <input 
            type="number" 
            name="porcentaje_progreso" 
            id="porcentaje_progreso" 
            value="{{ $orden->porcentaje_progreso ?? '' }}" 
            required>
        <br>
        
        <!-- Observaciones -->
        <br>
        <label for="observaciones">Observaciones:</label>
        <textarea  name="observaciones" id="observaciones" style= "width:100%">{{ $orden->observaciones ?? '' }}</textarea>
        <br>
        
        <!-- Botón de Envío -->
        <button type="submit" id="boton-ingreso">
            {{ isset($orden) ? 'Actualizar' : 'Crear' }} Orden
        </button>
    </form>
    <br>
@endsection


@include('essencials/footer')
