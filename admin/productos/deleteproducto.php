<?php

session_start();

if (isset($_SESSION['administrador']) && $_POST['idproducto'] != ""){

    $id_producto = $_POST['idproducto'];
    include ("../../php/conexion.php");
    $registros = mysqli_query($link,"select nombre from imagenes WHERE id_producto = '$id_producto'");
    while($fila = mysqli_fetch_array($registros)){
        unlink("imagenes/".$fila["nombre"]);
    }
    mysqli_query($link,"delete from imagenes WHERE id_producto = '$id_producto'");
    mysqli_query($link,"delete from productos WHERE id_producto = '$id_producto'");
    cerrarconexion();

}else{header('location:../index.php');}