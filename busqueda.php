<?php
require_once 'db.php';

$busqueda = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$resultados = [];

if (!empty($busqueda)) {
    $sql = "SELECT titulo, tipo, precio, portada 
            FROM titulos 
            WHERE titulo LIKE :busqueda";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['busqueda' => "%$busqueda%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda - XBooks</title>
    <link rel="stylesheet" href="css/styles.css">
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
        <div class="search-form">
            <form action="busqueda.php" method="get">
                <input type="text" name="search" placeholder="Busca un libro..." value="<?= $busqueda ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </nav>

    <section class="resultados">
        <?php if ($resultados): ?>
            <h2>Resultados de la búsqueda: "<?= $busqueda ?>"</h2>
            <ul class="resultados-busqueda">
                <?php foreach ($resultados as $libro): ?>
                    <li>
                        <img src="images/<?= !empty($libro['portada']) ? $libro['portada'] : 'libro-placeholder.jpg' ?>" alt="Portada de <?= htmlspecialchars($libro['titulo']) ?>">
                        <div class="info-libro">
                            <h3><a href="detalle.php?id_titulo=<?= $libro['id_titulo'] ?>"><?= htmlspecialchars($libro['titulo']) ?></a></h3>
                            <p>Tipo: <?= htmlspecialchars($libro['tipo']) ?></p>
                            <p class="precio">$<?= number_format($libro['precio'], 2) ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <h2>No se encontraron resultados para "<?= $busqueda ?>"</h2>
        <?php endif; ?>
    </section>
</body>
</html>
