<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'db.php';

if (isset($_GET['id_titulo'])) {
    $id_titulo = $_GET['id_titulo'];

    // Consulta
    $query = "
        SELECT id_titulo, titulo, precio, tipo, portada, descripcion
        FROM titulos
        WHERE id_titulo = :id_titulo
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id_titulo' => $id_titulo]);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirigiendo por si no se recibe el id_titulo
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <link rel="stylesheet" href="css/styles-detalle.css">
</head>
<body>
    <h1>Detalles del Libro</h1>

    <?php if ($libro): ?>
        <div class="detalle-libro">
            <img src="images/<?= !empty($libro['portada']) ? $libro['portada'] : 'libro-placeholder.jpg' ?>" alt="Portada de <?= htmlspecialchars($libro['titulo']) ?>">
            <h2><?= htmlspecialchars($libro['titulo']) ?></h2>
            <p><strong>Precio:</strong> $<?= number_format($libro['precio'], 2) ?></p>
            <p><strong>Tipo:</strong> <?= htmlspecialchars($libro['tipo']) ?></p>
            <p><strong>Descripción:</strong> <?= htmlspecialchars($libro['descripcion']) ?></p>
            
            <!-- Botón de compra -->
            <a href="#" class="btn-comprar">Comprar</a>
        </div>
    <?php else: ?>
        <p>Lo siento, no se encontró el libro.</p>
    <?php endif; ?>

    <a href="index.php">Volver al inicio</a>
</body>
</html>
