<?php
session_start();
include ('../../php/conexion.php');

if (isset($_SESSION['administrador'])){
    //Seleccionar tabla productos
    $registros1 = mysqli_query($link,"SELECT * FROM productos WHERE id_producto = '$_POST[idproducto]'")
                                            or die("Error al conectar con la BD".mysqli_error($link));
    $fila1 = mysqli_fetch_array($registros1);

    //Seleccionar tabla categoria
    $registros2 = mysqli_query($link,"SELECT categoria from categorias WHERE id = '$fila1[id_categoria]'");
    $fila2 = mysqli_fetch_array($registros2);

    //Seleccionar tabla imagenes
    $registros3 = mysqli_query($link,"SELECT nombre FROM imagenes WHERE id_producto = '$fila1[id_producto]'");

    //Lo que se muestra en el modal

    echo "<b>Nombre: </b>".utf8_encode($fila1['nombre'])."<br>";
    echo "<b>Precio: </b>".utf8_encode($fila1['precio'])."<br>";
    echo "<b>Descripción: </b>".utf8_encode($fila1['descripcion'])."<br>";
    echo "<b>Categoria: </b>".($fila2['categoria'])."<br><br>";

    if (mysqli_num_rows($registros3) != 0){
        while ($fila3 = mysqli_fetch_array($registros3)){
            echo utf8_encode($fila3['nombre'])."<br>";
            echo "<img width='200px' src='imagenes/".utf8_encode($fila3['nombre'])."'> <br><br>";
        }
    }


}else{
    header('location:../index.php');
}