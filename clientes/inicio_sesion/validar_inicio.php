<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])){
    include ("../../php/conexion.php");

    $email = mysqli_real_escape_string($link,$_POST['email']);
    $pass = mysqli_real_escape_string($link,$_POST['password']);
    $registros = mysqli_query($link, "select id_cliente,nombre,email,password from clientes
                                            WHERE email = '$email' AND password = '$pass' AND validado = '1'");

    if(mysqli_num_rows($registros) > 0){
        $fila = mysqli_fetch_array($registros);
        $_SESSION['id_cliente'] = $fila ['id_cliente'];
        $_SESSION['nombre_cliente'] = $fila['nombre'];

        if ($_POST['crear_cookie'] == "true"){
            if (!isset($_COOKIE['nombre_cliente'])){//Si no existe la cookie, entonces:
                setcookie("nombre_cliente",$fila['nombre'],time()+7200,"/"); //7200 seg son 2 horas
                setcookie("password_cliente",$fila['password'],time()+7200,"/");
                setcookie("email_cliente",$fila['email'],time()+7200,"/");
                setcookie("id_cliente",$fila['id_cliente'],time()+7200,"/");
            }
        }

        echo "exito";
    }else {echo "fracaso";}

}