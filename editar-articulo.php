<?php require_once './includes/redireccion.php'; ?>
<?php require_once './includes/helpers.php'; ?>
<?php require_once './includes/cabecera.php'; ?>

<?php
$articulo = obtenerArticulo($db, $_GET['id']);
if (!isset($articulo['id'])) {
    header('Location: index.php');
}
?>

<?php require_once './includes/lateral.php'; ?>

<div id="principal">
    <h1>Editar articulo</h1>
    <p>
        Edite su articulo "<?= $articulo['titulo'] ?>"
    </p>
    <br/>

    <?php if (isset($_SESSION['error_articulo'])): ?>
        <div class="alerta">
            <?= $_SESSION['error_articulo']; ?>
        </div>
    <?php endif; ?>

    <form action="guardar-articulo.php?editar=<?= $articulo['id'] ?>" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="<?= $articulo['titulo'] ?>">
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'titulo') : '' ?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?= $articulo['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'descripcion') : '' ?>

        <?php
        $categorias = obtenerCategorias($db);
        if (!empty($categorias)):
            ?>
            <label for="categoria">Categoria</label>
            <select name="categoria">     
                <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?= $categoria['id']; ?>" 
                    <?= $categoria['id'] == $articulo['categoria_id'] ? 'selected="selected"' : '' ?>>
                        <?= $categoria['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <?php
        endif;
        ?>
        <input type="submit" value="Editar articulo">
    </form>

    <?php borrarErrores(); ?>

</div><!-- Fin principal -->

<?php require_once './includes/pie.php'; ?>
