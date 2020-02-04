<!-- BARRA LATERAL -->
<aside id="sidebar">

    <?php if (isset($_SESSION['usuario'])): ?>
        <div id="buscador" class="bloque">
            <h2>Buscar</h2>
            <form action="buscar.php" method="POST"> 
                <input type="text" name="busqueda" />
                <input type="submit" value="Entrar" />
            </form>
        </div>
        <div id="usuario-logueado" class="bloque">
            <h2>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] . '!'; ?></h2>
            <!--botones-->
            <div class="contenedor-botones">
                <a href="crear-articulo.php" class="boton">Crear articulo</a>
                <a href="crear-categoria.php" class="boton">Crear categoria</a>
                <a href="mis-datos.php" class="boton">Mis datos</a>
                <a href="cerrar.php" class="boton">Cerrar sesión</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h3>Identificate, tornado.</h3>

            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alerta">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST"> 
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" value="Entrar" />
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrate, toro.</h3>

            <?php if (isset($_SESSION['completado'])): ?>
                <div class="alerta">
                    <?= $_SESSION['completado']; ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])): ?>
                <div class="alerta">
                    <?= $_SESSION['errores']['general']; ?>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre/s</label>
                <input type="text" name="nombre"/>
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : '' ?>

                <label for="apellidos">Apellido/s</label>
                <input type="text" name="apellidos"/>
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : '' ?>

                <label for="email">Email</label>
                <input type="email" name="email"/>
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : '' ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : '' ?>

                <input type="submit" name="submit" value="Registrarse"/>    
            </form>

            <?php borrarErrores(); ?>

        </div>
    <?php endif; ?>

</aside>