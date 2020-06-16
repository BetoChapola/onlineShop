<?php
session_start();
include ("../../php/conexion.php");

if (isset($_SESSION['nombre_cliente'])) include ('vista_index.php');

else if (!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])){
    $email = $_COOKIE["email_cliente"];
    $password = $_COOKIE["password_cliente"];
    $registro = mysqli_query($link,"select email, password, nombre from clientes
                              WHERE email = '$email' AND password = '$password'");
    if (mysqli_num_rows($registro) === 0){ header("location:../../index.php");}
    else {
        include ('vista_index.php');
        //$fila = mysqli_fetch_array($registro);
        //echo $fila['nombre'];
    }
}else {header("location:../../index.php");}

cerrarconexion();