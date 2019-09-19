<?php

$link = mysqli_connect("localhost","root","");

if (!$link){
    die("error de conexión: ".mysqli_error($link));
}

mysqli_select_db($link, "shoponline") or die("Error al conectar con la base de datos: ".mysqli_error($link));

function cerrarconexion(){
    mysqli_close($GLOBALS['link']);
}