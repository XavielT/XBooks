<?php
require_once 'db.php';

// Consulta
$query = "
    SELECT id_autor, nombre, apellido, ciudad, pais 
    FROM autores
";
$stmt = $pdo->query($query);
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Autores</title>
    <link rel="stylesheet" href="css/styles-autores.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="autores.php">Autores</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>

     <!-- Contenedor del título, se me hizo mas facil ponerlo en un contenedor aparte...me estaba dando problemas -->
     <div class="title-container">
        <h1>Listado de Autores</h1>
    </div>

    <!-- Contenedor para los autores -->
    <div class="authors-container">
        <?php foreach ($autores as $autor): ?>
            <!-- Tarjeta de autor -->
            <div class="author-card">
                <h2><?= $autor['nombre'] ?> <?= $autor['apellido'] ?></h2>
                <p><strong>Ciudad:</strong> <?= $autor['ciudad'] ?></p>
                <p><strong>País:</strong> <?= $autor['pais'] ?></p>
                <p><strong>ID:</strong> <?= $autor['id_autor'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
