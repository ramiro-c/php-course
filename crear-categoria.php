<?php require_once './includes/redireccion.php'; ?>
<?php require_once './includes/cabecera.php'; ?>
<?php require_once './includes/lateral.php'; ?>
<?php require_once './includes/helpers.php'; ?>

<div id="principal">
    <h1>Crear categoria</h1>
    <p>
        Agregue nuevas categorias al blog para que los usuarios puedan utilizarlas
        en sus nuevos articulos
    </p>
    <br/>

    <?php if (isset($_SESSION['error_categoria'])): ?>
        <div class="alerta">
            <?= $_SESSION['error_categoria']; ?>
        </div>
    <?php endif; ?>

    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : '' ?>

        <input type="submit" value="Crear categoria">
    </form>

    <?php borrarErrores(); ?>

</div><!-- Fin principal -->

<?php require_once './includes/pie.php'; ?>
