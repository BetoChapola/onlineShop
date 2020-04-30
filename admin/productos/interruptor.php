<?php
session_start();

if (isset($_SESSION['administrador']) and isset($_POST['interruptor']) != ""
and isset($_POST['id_producto']) != ""){
    include ("../../php/conexion.php");

    if ($_POST['interruptor'] == "activado"){
        mysqli_query($link,"update productos set inicio ='1' where id_producto = '$_POST[id_producto]'");
        echo "Producto activado correctamente";
        cerrarconexion();
    }

    if ($_POST['interruptor'] == "desactivado"){
        mysqli_query($link, "update productos set inicio ='0' where id_producto = '$_POST[id_producto]'");
        cerrarconexion();
        echo "Producto desactivado correctamente";
    }


}else {header('location:../../index.php');}


?>