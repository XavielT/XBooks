<?php
require_once 'db.php';

// Consulta
$query = "
    SELECT t.id_titulo, t.titulo, t.tipo, t.precio, p.nombre_pub 
    FROM titulos t
    LEFT JOIN publicadores p ON t.id_pub = p.id_pub
";
$stmt = $pdo->query($query);
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Libros</title>
    <link rel="stylesheet" href="css/styles-libros.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="autores.php">Autores</a></li>
            <li><a href="libros.php" class="active">Libros</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>

    <div class="title-container">
        <h1>Listado de Libros</h1>
    </div>

    <!-- Contenedor principal -->
    <div class="container">
        <table class="tabla-libros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Publicador</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= $libro['id_titulo'] ?></td>
                        <td><?= $libro['titulo'] ?></td>
                        <td><?= $libro['tipo'] ?></td>
                        <td><?= number_format($libro['precio'], 2, ',', '.') ?> €</td>
                        <td><?= $libro['nombre_pub'] ?: 'Desconocido' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>