<?php
include ("../php/conexion.php");

$registros = mysqli_query($link,"select id_cliente from codigos
                                       WHERE codigo = '$_GET[codigo]' and id_cliente = '$_GET[id_cliente]'");

if (mysqli_num_rows($registros) == 1){
    mysqli_query($link,"update clientes set validado = '1'
                              WHERE id_cliente = '$_GET[id_cliente]'");
    header("location:../index.php?alert=validado");
}else{
    header("location:formregistro.php?alert=caducado");
}
cerrarconexion();