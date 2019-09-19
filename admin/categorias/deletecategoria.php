<?php

session_start();

if (isset($_SESSION['administrador'])){

    $idcategoria = $_POST['idcategoria'];
    include ("../../php/conexion.php");
    mysqli_query($link,"delete from categorias WHERE id = '$idcategoria'");
    cerrarconexion();
    //header('location:formaddcategoria.php');
}else{header('location:../index.php');}