<?php

if (isset($_POST)) {

    require_once './includes/conexion.php';
    require_once './includes/helpers.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, strtolower(trim($_POST['email']))) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;

    $email_validado = validarEmail($email);
    $password_validado = validarPassword($password);

    $_SESSION['error_login'] = 'Login incorrecto';

    if ($email_validado && $password_validado) {
        $sql = "select * from usuarios where email = '$email'";
        $query = mysqli_query($db, $sql);

        if ($query && mysqli_num_rows($query) == 1) {
            $usuario = mysqli_fetch_assoc($query);

            $verify = password_verify($password, $usuario['password']);
            if ($verify) {
                $usuario['nombre'] = ucwords($usuario['nombre']);
                $usuario['apellidos'] = ucwords($usuario['apellidos']);
                $_SESSION['usuario'] = $usuario;
            }
        }
    }
}
header('Location: index.php');
