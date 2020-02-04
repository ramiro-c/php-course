<?php require_once './includes/cabecera.php'; ?>
<?php require_once './includes/helpers.php'; ?>
<?php require_once './includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Ultimos articulos</h1>

    <?php
    $articulos = obtenerArticulos($db, 4);
    if (!empty($articulos)):
        while ($articulo = mysqli_fetch_assoc($articulos)):
            ?>
            <article class="articulo">
                <a href="articulo.php?id=<?= $articulo['id'] ?>">
                    <h2><?= $articulo['titulo'] ?></h2>
                    <span class="fecha"><?= $articulo['categoria'] . ' | ' . $articulo['fecha'] ?></span>
                    <p>
                        <?= substr($articulo['descripcion'], 0, 200) . " [...]" ?>
                    </p>
                </a>
            </article>  
            <?php
        endwhile;
    endif;
    ?>
    <div id="boton-principal">
        <a href="articulos.php">Ver todos las articulos</a>
    </div>
</div><!-- Fin principal -->

<?php require_once 'includes/pie.php'; ?>
