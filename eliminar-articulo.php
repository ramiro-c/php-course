<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    require_once './includes/conexion.php';
    $articulo_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];
    $sql = "delete from articulos 
            where usuario_id = $usuario_id and id = $articulo_id";

    $query = mysqli_query($db, $sql);
    if ($query) {
        $_SESSION['articulo_eliminado'] = 'El articulo fue eliminado con exito';
    }
}
header('Location: mis-datos.php');
