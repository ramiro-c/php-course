<?php

$server = 'localhost';
$username = 'administrador';
$password = '.miguel457;!123abc';
$database = 'blog';

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "set names 'utf8'");

if (!isset($_SESSION)) {
    session_start();
}
