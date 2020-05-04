<?php
//sleep es solo para crear un efecto del retraso que normalmente pasa en internet.
//Ya que nuestra maquina es servidor y cliente al mismo tiempo, eso no sucede y tenemos que crearlo con sleep(1);
sleep(1);
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