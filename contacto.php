<?php
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="css/styles-contacto.css">
</head>
<body>

    <!-- Barra de navegación -->
    <nav>
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="autores.php">Autores</a></li>
                <li><a href="libros.php">Libros</a></li>
                <li><a href="contacto.php" class="active">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="form-container">
        <h1>Formulario de Contacto</h1>

        <!-- Mensaje de exito o error -->
        <?php if ($mensaje == 'success'): ?>
            <p class="success">¡Gracias por tu mensaje! Lo hemos recibido correctamente.</p>
        <?php elseif ($mensaje == 'error'): ?>
            <p class="error">Ocurrió un error al enviar tu mensaje. Por favor, intenta nuevamente.</p>
        <?php endif; ?>

        <!-- Formulario de contacto -->
        <form action="guardar_contacto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" required>

            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario" rows="4" required></textarea>

            <button type="submit">Enviar</button>
            <div id="loading" style="display: none;">Enviando...</div>
        </form>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let nombre = document.getElementById("nombre").value;
            let correo = document.getElementById("correo").value;
            let asunto = document.getElementById("asunto").value;
            let comentario = document.getElementById("comentario").value;

            if (!nombre || !correo || !asunto || !comentario) {
                alert("Todos los campos son obligatorios.");
                event.preventDefault();
            } else if (!/\S+@\S+\.\S+/.test(correo)) {
                alert("Por favor, ingresa un correo electrónico válido.");
                event.preventDefault();
            } else {
                document.getElementById("loading").style.display = "block";
            }
        });
    </script>

</body>
</html>
