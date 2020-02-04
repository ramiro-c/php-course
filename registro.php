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
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;

    $nombre_validado = validarString($nombre);
    $apellidos_validado = validarString($apellidos);
    $email_validado = validarEmail($email);
    $password_validado = validarPassword($password);

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
    if (!$password_validado) {
        $errores['password'] = 'Password no valida';
    }

    if (count($errores) == 0) {
        /* Cifrar password */
        $password_cifrada = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        /* ingresar usuario a la bbdd */
        $sql = "insert into usuarios values(null, '$nombre', '$apellidos', '$email', '$password_cifrada', curdate());";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['completado'] = 'El registro del usuario se ha completado';
        } else {
            $_SESSION['errores']['general'] = 'Fallo al registrar el usuario';
        }
    } else {
        $_SESSION['errores'] = $errores;
        $_SESSION['errores']['general'] = 'Fallo al registrar el usuario';
    }
}

header('Location: index.php');
