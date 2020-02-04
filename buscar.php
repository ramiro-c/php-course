<?php require_once './includes/helpers.php'; ?>
<?php require_once './includes/cabecera.php'; ?>

<?php
if (!isset($_POST['busqueda'])) {
    header('Location: index.php');
}
?>

<?php require_once './includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Busqueda: "<?= $_POST['busqueda'] ?>"</h1>
    <?php
    $articulos = obtenerArticulos($db, null, null, null, $_POST['busqueda']);

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
