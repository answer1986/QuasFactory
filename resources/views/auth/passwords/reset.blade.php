<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Quas Factory</title>
    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div id="app" class="g-col">
    <h1 id="Nombre-app" class="text-center mb-4">Quas Factory</h1>
    <h2 id="login" class="text-center mb-4">Restablecer Contraseña</h2>
    <div class="overlay-text">
        Tu empresa creciendo en la direccion correcta, excelencia en la gestión y conformidad reglamentaria.
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva Contraseña:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirmar Nueva Contraseña:</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row" id="pie-login">
        <div class="col-md-4">
            <a href="https://quas.cl" id="pie1">Nuestra web</a>
        </div>
        <div class="col-md-4">
            <a id="pie1">Otros Productos</a> 
        </div>
        <div class="col-md-4">
            <a href="https://quas.cl/nuestros_servicios" id="pie1">Certificaciones iso</a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
