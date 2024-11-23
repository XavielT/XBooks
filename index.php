<?php
require_once 'db.php';

// Consulta
$query = "
    SELECT id_titulo, titulo, precio, tipo, portada 
    FROM titulos 
    ORDER BY total_ventas DESC 
    LIMIT 8
";
$stmt = $pdo->query($query);
$librosDestacados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubre los mejores libros en XBooks, tu librería online favorita. Encuentra títulos destacados y autores reconocidos.">
    <meta name="keywords" content="libros, librería online, literatura, autores, títulos destacados">
    <meta name="author" content="XBooks">

    <title>XBooks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js" defer></script>
</head>
<body>
    <h1 class="XBooks">XBooks</h1>

    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Inicio</a></li>
            <li><a href="autores.php" class="<?= basename($_SERVER['PHP_SELF']) == 'autores.php' ? 'active' : '' ?>">Autores</a></li>
            <li><a href="libros.php" class="<?= basename($_SERVER['PHP_SELF']) == 'libros.php' ? 'active' : '' ?>">Libros</a></li>
            <li><a href="contacto.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : '' ?>">Contacto</a></li>
        </ul>

        <div class="search-form">
          <form action="busqueda.php" method="get">
             <input type="text" name="search" placeholder="Busca un libro..." value="<?= $busqueda ?>">
               <button type="submit">Buscar</button>
           </form>

        </div>
    </nav>

    <section class="destacados">
        <?php 
            $subtitulos = ["Descubre los más vendidos", "Lecturas imprescindibles", "Tus favoritos aquí"];
            $subtitulo = $subtitulos[array_rand($subtitulos)];
        ?>
        <h2>Libros Destacados</h2>
        <h3><?= $subtitulo ?></h3>

        <!-- Contenedor principal del slider -->
        <div class="swiper">
            <!-- Wrapper del slider -->
            <div class="swiper-wrapper">
                <?php foreach ($librosDestacados as $libro): ?>
                    <div class="swiper-slide tarjeta">
                        <img src="images/<?= !empty($libro['portada']) ? $libro['portada'] : 'libro-placeholder.jpg' ?>" 
                             alt="Portada de <?= htmlspecialchars($libro['titulo']) ?>">
                        <h3 class="titulo-libro">
                            <a href="detalle.php?id_titulo=<?= $libro['id_titulo'] ?>"><?= htmlspecialchars($libro['titulo']) ?></a>
                        </h3>
                        <p>Tipo: <?= htmlspecialchars($libro['tipo']) ?></p>
                        <p class="precio">$<?= number_format($libro['precio'], 2) ?></p>
                        <a href="libros.php" class="btn-ver-mas">Ver más libros</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controles de navegación -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="acerca">
        <div class="acerca-container">
            <h2>Acerca de Nosotros</h2>
            <p>Bienvenidos a nuestra librería. Nos especializamos en ofrecer los mejores títulos literarios y autores destacados del mercado. Nuestro objetivo es proporcionar una experiencia única para todos los amantes de la lectura, ofreciéndoles una amplia variedad de géneros y temáticas para todos los gustos.</p>

            <h3>Nuestra Misión</h3>
            <p>Brindar acceso a una extensa variedad de libros, garantizando calidad y diversidad en nuestros productos, con el fin de fomentar la lectura y el conocimiento.</p>

            <h3>Nuestra Visión</h3>
            <p>Ser la librería de referencia en línea, conocida por su servicio excepcional y su compromiso con la cultura y el aprendizaje.</p>
        </div>
    </section>

    <script src="js/swiper-init.js"></script>
</body>
</html>