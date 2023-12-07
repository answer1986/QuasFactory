<!-- password.request.blade.php -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Enviar Enlace de Restablecimiento de Contraseña</button>
    </div>
</form>
