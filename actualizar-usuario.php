<?php

if (isset($_POST)) {

    require_once './includes/conexion.php';
    require_once './includes/helpers.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, ucfirst(strtolower(trim($_POST['nombre'])))) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, ucfirst(strtolower(trim($_POST['apellidos'])))) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, strtolower(trim($_POST['email']))) : false;

    $nombre_validado = validarString($nombre);
    $apellidos_validado = validarString($apellidos);
    $email_validado = validarEmail($email);

    $errores = array();

    if (!$nombre_validado) {
        $errores['nombre'] = 'Nombre/s no valido/s';
    }
    if (!$apellidos_validado) {
        $errores['apellidos'] = 'Apellido/s no valido/s';
    }
    if (!$email_validado) {
        $errores['email'] = 'Email no valido';
    }

    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $usuario_id = $_SESSION['usuario']['id'];

        $sql_select = "select id, email from usuarios where email='$email';";
        $isset_email = mysqli_query($db, $sql_select);
        $isset_usuario = mysqli_fetch_assoc($isset_email);

        if ($isset_usuario['id'] == $usuario['id'] || empty($isset_usuario)) {
            $sql_update = "update usuarios set "
                    . "nombre='$nombre', "
                    . "apellidos='$apellidos', "
                    . "email='$email' "
                    . "where id=$usuario_id;";

            $query = mysqli_query($db, $sql_update);

            if ($query) {
                $_SESSION['completado'] = 'Los datos del usuario se han actualizado con exito';
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                header('Location: mis-datos.php');
                exit();
            }
        } else {
            $errores['email'] = 'Ese email ya esta siendo utilizado';
        }
    }
    $_SESSION['errores'] = $errores;
    $_SESSION['errores']['general'] = 'Fallo al actualizar los datos el usuario';
}
header('Location: mis-datos.php');

