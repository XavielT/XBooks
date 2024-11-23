<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui se recogen los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    try {
        // Aqui se insertan los datos en la tabla
        $query = "
            INSERT INTO contacto (nombre, correo, asunto, comentario)
            VALUES (:nombre, :correo, :asunto, :comentario)
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':asunto' => $asunto,
            ':comentario' => $comentario
        ]);

        // Redirigir con un mensaje de éxito
        header("Location: contacto.php?mensaje=success");
        exit;
    } catch (PDOException $e) {
        // Otro mensaje de error
        header("Location: contacto.php?mensaje=error");
        exit;
    }
} else {
    echo "Acceso no autorizado.";
}
