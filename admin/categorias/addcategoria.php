<?php
session_start();
if (isset($_SESSION['administrador'])){

    if ($_POST['categoria']!=""){
        include ("../../php/conexion.php");
        $categoria=utf8_decode($_POST['categoria']);
        $registros=mysqli_query($link,"SELECT categoria FROM categorias WHERE categoria='$categoria'");

        if (mysqli_num_rows($registros)==0){
            mysqli_query($link,"INSERT INTO categorias (categoria) VALUES ('$categoria')");
            cerrarconexion();
            header('location:formaddcategoria.php?alert=1&categoria='.$categoria); //Alert 1
        }else{header('location:formaddcategoria.php?alert=3');} //Alert 3

        //echo $_POST['categoria'];
    }elseif ($_POST['categoria']==""){
        header('location:formaddcategoria.php?alert=2');} //Alert 2
}else{header('location:../index.php');}