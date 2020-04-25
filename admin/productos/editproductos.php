<?php
session_start();

if(isset($_SESSION['administrador']) && $_POST['id_producto']){
    include ("../../php/conexion.php");

    $newprecio = $_POST['nuevoprecio'];
    $newdescripcion = $_POST['nuevadescripcion'];
    $id_producto = $_POST['id_producto'];

    mysqli_query($link, "UPDATE productos SET precio='$newprecio', descripcion='$newdescripcion' WHERE id_producto='$id_producto'");
    header('location:showproductos.php?alert');


}else{header('location:../index.php');}