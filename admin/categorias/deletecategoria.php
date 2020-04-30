<?php

session_start();

if (isset($_SESSION['administrador']) && $_POST['idcategoria']){

    $idcategoria = $_POST['idcategoria'];//Variable que recibe el valor del "id" de la tabla categoría, enviado por ajax.
    include ("../../php/conexion.php");//Abrimos la conexión.

//Hacemos la consulta a la tabla productos, filtrando por id_categoria; mediante el id de la categoria que guardamos en $idcategoria.
    $registros1 = mysqli_query($link,("select id_producto from productos WHERE id_categoria = '$idcategoria'"));
    while ($fila1 = mysqli_fetch_array($registros1)){

        //Hacemos la consulta a la tabla imagenes, filtrando por id_producto. Seleccionando asi las imagenes que pertenecen a ese producto.
        $registros2 = mysqli_query($link,"select nombre from imagenes WHERE id_producto = '$fila1[id_producto]'");

        while ($fila2 = mysqli_fetch_array($registros2)){
            unlink("../productos/imagenes/".$fila2['nombre']);
        }

        mysqli_query($link,"delete from imagenes WHERE id_producto = '$fila1[id_producto]'");
        mysqli_query($link,"delete from productos WHERE id_categoria = '$fila1[id_producto]'");
    }

    mysqli_query($link,"delete from categorias WHERE id = '$idcategoria'");
    cerrarconexion();

}else{header('location:../index.php');}