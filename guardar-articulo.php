<?php

if (isset($_POST)) {
    require_once './includes/conexion.php';
    require_once './includes/helpers.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, ucfirst(trim($_POST['titulo']))) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, ucfirst(trim($_POST['descripcion']))) : false;
    $categoria_id = isset($_POST['categoria']) ? (int) $_POST['categoria'] : false;
    $usuario_id = $_SESSION['usuario']['id'];

    $titulo_validado = validarString($titulo);
    $descripcion_validado = validarDescripcion($descripcion);
    $categoria_validado = $categoria_id !== false;

    $errores = array();

    if (!$titulo_validado) {
        $errores['titulo'] = 'Titulo no valido';
    }
    if (!$descripcion_validado) {
        $errores['descripcion'] = 'La descripcion es muy corta, minimo 10 caracteres';
    }
    if (!$categoria_validado) {
        $errores['categoria'] = 'Categoria no valido';
    }

    if (count($errores) == 0) {
        if (isset($_GET['editar'])) {
            $articulo_id = $_GET['editar'];
            $sql = "update articulos 
                   set categoria_id = $categoria_id, titulo = '$titulo', descripcion = '$descripcion'
                   where id = $articulo_id and usuario_id = $usuario_id";
        } else {
            $sql = "insert into articulos values(null, $usuario_id, $categoria_id,'$titulo', '$descripcion', curdate());";
        }
        $query = mysqli_query($db, $sql);
        if ($query) {
            if (isset($_GET['editar'])) {
                header('Location: articulo.php?id=' . $_GET['editar']);
            } else {
                header('Location: index.php');
            }
            exit();
        }
        $errores['error_articulo'] = 'No se pudo crear el articulo';
    }
    $_SESSION['errores'] = $errores;
}
header('Location: crear-articulo.php');
