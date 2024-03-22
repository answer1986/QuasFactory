<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producción</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #999;
        }
        #carrusel-imagenes {
            position: relative;
            max-width: 100%;
            max-height: 100%;
            overflow: hidden;
        }
        .full-screen-image {
            display: none;
            width: 100%;
            height: auto;
            transition: opacity 1s ease;
        }
        .active {
            display: block;
            opacity: 1;
        }
        .control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 24px;
            cursor: pointer;
            z-index: 100;
        }
        .prev {
            left: 10px;
        }
        .next {
            right: 10px;
        }
    </style>
</head>
<body>
    <div id="carrusel-imagenes">
        @foreach ($imagenes as $imagen)
            <img src="{{ url('storage/imagenes/' . $imagen->nombre_archivo) }}" alt="Imagen Cargada" class="full-screen-image">
        @endforeach
        <div class="control prev"><i class="fas fa-chevron-left"></i></div>
        <div class="control next"><i class="fas fa-chevron-right"></i></div>
    </div>

    <script>
    let imagenes = document.querySelectorAll('.full-screen-image');
    let indiceActual = 0;

    // Hace la primera imagen visible al cargar
    window.onload = function() {
        imagenes[indiceActual].classList.add('active');
        imagenes[indiceActual].style.opacity = '1';
    };

    document.querySelector('.prev').addEventListener('click', function() {
        indiceActual = (indiceActual - 1 + imagenes.length) % imagenes.length;
        cambiarImagen();
    });

    document.querySelector('.next').addEventListener('click', function() {
        indiceActual = (indiceActual + 1) % imagenes.length;
        cambiarImagen();
    });

    function cambiarImagen() {
        // Oculta todas las imágenes
        imagenes.forEach(img => {
            img.classList.remove('active');
            img.style.opacity = '0';
        });

        // Muestra la imagen actual
        imagenes[indiceActual].classList.add('active');
        setTimeout(() => { imagenes[indiceActual].style.opacity = '1'; }, 100);
    }

    if (imagenes.length > 0) {
        // Inicia la rotación automática de las imágenes
        setInterval(function() {
            indiceActual = (indiceActual + 1) % imagenes.length;
            cambiarImagen();
        }, 5000); // Cambia cada 5 segundos
    }
</script>

</body>
</html>
