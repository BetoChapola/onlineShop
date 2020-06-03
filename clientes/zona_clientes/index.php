<?php
session_start();

if (isset($_SESSION['nombre_cliente'])){echo "Hola por sesion ".$_SESSION['nombre_cliente'];}
if (!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])){
    echo "Hola por cookie ".$_COOKIE['nombre_cliente'];
    echo "<br>";
    echo $_COOKIE['password_cliente'];
}
