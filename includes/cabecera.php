<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <title>Blog de Videojuegos</title>
    </head>
    <body>
        <!-- CABECERA -->
        <header id="cabecera">
            <div id="logo">
                <a href="index.php">
                    Blog de Videojuegos
                </a>
            </div>
            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <?php
                    $categorias = obtenerCategorias($db, $limite = 13);
                    if (!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)):
                            ?>
                            <li>
                                <a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre']; ?></a>
                            </li>
                            <?php
                        endwhile;
                    endif;
                    ?>

                    <li>
                        <a href="index.php">Sobre mi</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>                
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>
        <div id="contenedor">