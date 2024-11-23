<?php

require_once 'db.php';

$query = "SELECT COUNT(*) AS total FROM titulos";
$stmt = $pdo->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Total de libros: " . $result['total'];
?>


<html>
<head><link rel="stylesheet" href="css/styles.css?v=<?= time() ?>"></head>
<body>
    <h1>Test de cambios</h1>
    <p>Este es un archivo de prueba. Última actualización: <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
