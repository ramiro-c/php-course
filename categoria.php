<?php require_once './includes/helpers.php'; ?>
<?php require_once './includes/cabecera.php'; ?>

<?php
$categoria = obtenerCategoria($db, $_GET['id']);
if (!isset($categoria['id'])) {
    header('Location: index.php');
}
?>

<?php require_once './includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Articulos</h1>
    <h2 class="nombre-categoria">Categoria: <?= $categoria['nombre'] ?></h2>
    <?php
    $categoria_id = (int) $_GET['id'];
    $articulos = obtenerArticulos($db, 4, $categoria_id);
    if (!empty($articulos) && mysqli_num_rows($articulos) > 0):
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
    else:
        ?>
        <br/>
        <div class="alerta">No hay articulos en esta categoria</div>
    <?php
    endif;
    ?>
    <div id="boton-principal">
        <a href="index.php">Ir a pagina principal</a>
    </div>
</div><!-- Fin principal -->

<?php require_once './includes/pie.php'; ?>
