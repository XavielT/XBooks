<?php
$host = 'sql213.infinityfree.com'; 
$dbname = 'if0_37737636_libreria'; 
$username = 'if0_37737636'; 
$password = 'Xavi0374'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error en la conexión: ' . $e->getMessage());
}
?>

