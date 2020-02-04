<?php require_once './includes/redireccion.php'; ?>
<?php require_once './includes/cabecera.php'; ?>
<?php require_once './includes/lateral.php'; ?>
<?php require_once './includes/helpers.php'; ?>

<div id="principal">
    <h1>Crear articulo</h1>
    <p>
        Agregue nuevos articulos al blog para que los usuarios puedan leerlas
        y disfrutar del contenido
    </p>
    <br/>

    <?php if (isset($_SESSION['error_articulo'])): ?>
        <div class="alerta">
            <?= $_SESSION['error_articulo']; ?>
        </div>
    <?php endif; ?>

    <form action="guardar-articulo.php" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'titulo') : '' ?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'descripcion') : '' ?>

        <?php
        $categorias = obtenerCategorias($db);
        if (!empty($categorias)):
            ?>
            <label for="categoria">Categoria</label>
            <select name="categoria">     
                <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?= $categoria['id']; ?>">
                        <?= $categoria['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <?php
        endif;
        ?>
        <input type="submit" value="Crear articulo">
    </form>

    <?php borrarErrores(); ?>

</div><!-- Fin principal -->

<?php require_once './includes/pie.php'; ?>
