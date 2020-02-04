<?php require_once './includes/redireccion.php'; ?>
<?php require_once './includes/cabecera.php'; ?>	
<?php require_once './includes/lateral.php'; ?>
<?php require_once './includes/helpers.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Mis datos</h1>

    <?php if (isset($_SESSION['completado'])): ?>
        <div class="alerta">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif (isset($_SESSION['errores']['general'])): ?>
        <div class="alerta">
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>

    <form action="actualizar-usuario.php" method="POST"> 
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos']; ?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

        <input type="submit" name="submit" value="Actualizar" />
    </form>

    <br/>

    <h1>Mis articulos</h1>
    <?php if (isset($_SESSION['articulo_eliminado'])): ?>
        <div class="alerta">
            <?= $_SESSION['articulo_eliminado']; ?>
        </div>
        <?php
    endif;
    ?>
    <?php
    $usuario_id = (int) $_SESSION['usuario']['id'];
    $articulos = obtenerArticulos($db, null, null, $usuario_id);
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
        <a href="index.php">Ir a pagina principal</a>
    </div>

    <?php borrarErrores(); ?>

</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>
