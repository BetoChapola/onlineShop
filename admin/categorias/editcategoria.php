<?php
session_start();
if (isset($_SESSION['administrador'])){

    if ($_POST['categorianueva']!=""){
        include ("../../php/conexion.php");
        $categorianueva=utf8_decode($_POST['categorianueva']);
        $categoriavieja=utf8_decode($_POST['categoriavieja']);
        $registros=mysqli_query($link,"SELECT categoria FROM categorias WHERE categoria='$categorianueva'");

        if (mysqli_num_rows($registros)==0){
            mysqli_query($link,"UPDATE categorias SET categoria='$categorianueva' WHERE categoria='$categoriavieja'");
            cerrarconexion();
            header('location:formaddcategoria.php?alert=4&categoriavieja='.$categoriavieja.'&categorianueva='.$categorianueva); //Alert 4
        }else{header('location:formaddcategoria.php?alert=3');} //Alert 3

        echo $_POST['categoria'];
    }elseif ($_POST['categoria']==""){
        header('location:formaddcategoria.php?alert=5');} //Alert 2
}else{header('location:../index.php');}