<?php
session_start();
if (!isset($_SESSION['administrador'])){header("location:../index.php");}
include ("../../php/conexion.php");

$pagina = $_POST['pagina'];

if (isset($_POST['actualizar'])){
    if (is_array($_POST['checado'])){
        $estado = $_POST['select_estado'];
        $pedido = $_POST['checado'];

        foreach ($pedido as $valor){
            mysqli_query($link,"UPDATE pedidos2 SET estado = '$estado'
                                      WHERE pedido = '$valor'");

        }
    }
}header("location:ver_pedidos.php?pagina=".$pagina);

