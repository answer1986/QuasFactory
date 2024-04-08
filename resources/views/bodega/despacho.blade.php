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


<div class="container">
    <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Rebajar Producto Terminado y Materia Prima</div>

                    <div class="card-body">
                        <form method="POST" action="{ route('rebajar.store') }}"> <!-- { -->
                            @csrf

                            <div class="form-group row">
                                <label for="orden_trabajo_id" class="col-md-4 col-form-label text-md-right">Orden de Trabajo ID</label>

                                <div class="col-md-6">
                                    <input id="orden_trabajo_id" type="text" class="form-control @error('orden_trabajo_id') is-invalid @enderror" name="orden_trabajo_id" required autofocus>

                                    @error('orden_trabajo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="venta_id" class="col-md-4 col-form-label text-md-right">Venta ID</label>

                                <div class="col-md-6">
                                    <input id="venta_id" type="text" class="form-control @error('venta_id') is-invalid @enderror" name="venta_id" required autofocus>

                                    @error('venta_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="producto_terminado_id" class="col-md-4 col-form-label text-md-right">Producto Terminado ID</label>

                                <div class="col-md-6">
                                    <input id="producto_terminado_id" type="text" class="form-control @error('producto_terminado_id') is-invalid @enderror" name="producto_terminado_id" required autofocus>

                                    @error('producto_terminado_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cantidad_rebajada" class="col-md-4 col-form-label text-md-right">Cantidad Rebajada</label>

                                <div class="col-md-6">
                                    <input id="cantidad_rebajada" type="number" class="form-control @error('cantidad_rebajada') is-invalid @enderror" name="cantidad_rebajada" required>

                                    @error('cantidad_rebajada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Rebajar Producto
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@include('essencials/footer')
