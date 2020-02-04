<?php require_once './includes/helpers.php'; ?>
<?php require_once './includes/cabecera.php'; ?>

<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
}
$articulo = obtenerArticulo($db, $_GET['id']);
if (!isset($articulo['id'])) {
    header('Location: index.php');
}
?>

<?php require_once './includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Articulo actual: <?= $articulo['titulo'] ?></h1>
    <a href="categoria.php?id=<?= $articulo['categoria_id'] ?>">
        <h2 class="nombre-categoria"><?= $articulo['categoria'] ?></h2>
    </a>
    <h4 class="fecha"><?= $articulo['fecha'] ?> | <?= $articulo['autor'] ?> </h4>
    <p>
        <?= $articulo['descripcion'] ?>
    </p>
    <div id="boton-principal">
        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $articulo['usuario_id']): ?>
            <a href="editar-articulo.php?id=<?= $articulo['id'] ?>" class="boton">Editar articulo</a>
            <a href="eliminar-articulo.php?id=<?= $articulo['id'] ?>" class="boton">Eliminar articulo</a>
        <?php endif; ?>
        <a href="index.php">Ir a pagina principal</a>
    </div>
</div><!-- Fin principal -->

<?php require_once './includes/pie.php'; ?>
