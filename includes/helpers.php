<?php

function validarString(string $string): bool {
    return (!empty($string) && !is_numeric($string) && !preg_match('/[0-9]/', $string));
}

function validarEmail(string $email): bool {
    return (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL));
}

function validarPassword(string $password): bool {
    return (!empty($password) && strlen($password) >= 8 && strlen($password) <= 16);
}

function validarDescripcion(string $descripcion): bool {
    return (!empty($descripcion) && !is_numeric($descripcion) && strlen($descripcion) >= 10);
}

function mostrarErrores(array $errores, string $campo): string {
    if (!isset($errores[$campo]) || empty($campo)) {
        return '';
    }
    return '<div class="alerta">' . $errores[$campo] . '</div>';
}

function borrarErrores(): int {
    if (isset($_SESSION['errores'])) {
        unset($_SESSION['errores']);
    }
    if (isset($_SESSION['completado'])) {
        unset($_SESSION['completado']);
    }
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }
    if (isset($_SESSION['error_articulo'])) {
        unset($_SESSION['error_articulo']);
    }
    if (isset($_SESSION['error_categoria'])) {
        unset($_SESSION['error_categoria']);
    }
    if (isset($_SESSION['articulo_eliminado'])) {
        unset($_SESSION['articulo_eliminado']);
    }
    return 0;
}

function obtenerCategorias($db, int $limite = 0): iterable {
    $sql = "select * from categorias 
            order by id asc ";

    if ($limite != 0) {
        $sql .= "limit $limite;";
    }

    $categorias = mysqli_query($db, $sql);

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        return $categorias;
    }
    return array();
}

function obtenerCategoria($db, int $categoria_id): iterable {
    $sql = "select * from categorias 
            where id = $categoria_id ";

    $categoria = mysqli_query($db, $sql);

    if ($categoria && mysqli_num_rows($categoria) >= 1) {
        return mysqli_fetch_assoc($categoria);
    }
    return array();
}

function obtenerArticulos($db, int $limite = null, int $categoria_id = null, int $usuario_id = null, string $busqueda = null): iterable {
    $sql = "select a.*, c.nombre as 'categoria' from articulos a 
            inner join categorias c on a.categoria_id = c.id ";

    if (!empty($usuario_id)) {
        $sql .= " left join usuarios u on u.id = a.usuario_id  
        where u.id = $usuario_id ";
    }
    if (!empty($categoria_id)) {
        $sql .= "where a.categoria_id = $categoria_id ";
    }
        if (!empty($busqueda)) {
        $sql .= "where a.titulo like '%$busqueda%' ";
    }
    $sql .= "order by a.id desc ";

    if (!empty($limite)) {
        $sql .= "limit $limite;";
    }

    $articulos = mysqli_query($db, $sql);

    if ($articulos && mysqli_num_rows($articulos) >= 1) {
        return $articulos;
    }

    return array();
}

function obtenerArticulo($db, int $articulo_id): iterable {
    $sql = "select a.*, 
            c.nombre as 'categoria', 
            concat(u.nombre, ' ', u.apellidos) as 'autor' 
            from articulos a 
            inner join categorias c on c.id = a.categoria_id 
            inner join usuarios u on u.id = a.usuario_id 
            where a.id = $articulo_id";

    $articulo = mysqli_query($db, $sql);

    if ($articulo && mysqli_num_rows($articulo) >= 1) {
        return mysqli_fetch_assoc($articulo);
    }
    return array();
}
