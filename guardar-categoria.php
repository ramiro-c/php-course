<?php

if (isset($_POST)) {
    require_once './includes/conexion.php';
    require_once './includes/helpers.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, ucfirst(strtolower(trim($_POST['nombre'])))) : false;
    $nombre_validado = validarString($nombre);

    $errores = array();

    if (!$nombre_validado) {
        $errores['nombre'] = 'Nombre no valido';
        $_SESSION['errores'] = $errores;
    }

    if (count($errores) == 0) {
        $sql = "insert into categorias values(null,'$nombre');";
        $query = mysqli_query($db, $sql);
        if ($query) {
            header('Location: index.php');
            exit();
        }
        $errores['error_categoria'] = 'No se pudo crear la categoria';
    }
}
header('Location: crear-categoria.php');
