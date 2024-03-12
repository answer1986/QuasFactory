<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producción</title>
</head>
<style>
body {
  height: 100%;
}

body {
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #999;
}
</style>      
<body>


        @if (isset($imagen))
        <img src="{{ url('storage/imagenes/' . $imagen->nombre_archivo) }}" alt="Imagen Cargada" class="full-screen-image">
        @else
            <p>No hay datos para mostrar.</p>
        @endif
  

</body>
</html>
