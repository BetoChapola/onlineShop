<?php

session_start();

if (isset($_SESSION['administrador']) && $_POST['idcliente'] != ""){
    include ("../../php/conexion.php");
    $id_cliente = $_POST['idcliente'];

    $registros = mysqli_query($link,"select * from clientes WHERE id_cliente = $id_cliente");
    if (mysqli_num_rows($registros) >0){
        mysqli_query($link,"delete from clientes WHERE id_cliente = $id_cliente");
        echo "exito";
        cerrarconexion();
    }
}else {header("location:../../index.php");}