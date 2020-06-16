<?php
session_start();
include ("../../php/conexion.php");

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) &&
    isset($_POST['direccion']) && isset($_POST['cp']) && isset($_POST['ciudad']) &&
    isset($_POST['password'])){

    $nombre = mysqli_real_escape_string($link,$_POST['nombre']);
    $apellido = mysqli_real_escape_string($link,$_POST['apellido']);
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $direccion = mysqli_real_escape_string($link,$_POST['direccion']);
    $cp = mysqli_real_escape_string($link,$_POST['cp']);
    $ciudad = mysqli_real_escape_string($link,$_POST['ciudad']);
    $password = mysqli_real_escape_string($link,$_POST['password']);

    $nombre = ucwords($nombre); //pone la primer letra en mayúsculas
    $apellido = ucwords($apellido);

    mysqli_query($link,"UPDATE clientes SET
                              nombre = '$nombre', apellido = '$apellido',
                              email = '$email', direccion = '$direccion',
                              cp = '$cp', ciudad = '$ciudad', password = '$password'
                              WHERE email = '$_POST[email]'");


    setcookie("nombre_cliente",$nombre,time()+300,"/");
    setcookie("password_cliente",$password,time()+300,"/");
    setcookie("email_cliente",$email,time()+300,"/");

}else{ header("location:../../index..php");}