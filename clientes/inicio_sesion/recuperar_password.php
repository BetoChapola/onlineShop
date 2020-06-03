<?php
if (isset($_POST['email'])){
    include ("../../php/conexion.php");

    $email = mysqli_real_escape_string($link,$_POST['email']);
    $registros = mysqli_query($link,"select nombre,email, password from clientes
                                           WHERE email = '$email' and validado = '1' ");

    if (mysqli_num_rows($registros) > 0){
        $fila = mysqli_fetch_array($registros);

        //Enviar password al email

        $para = $email;
        $titulo = 'Envio de password';

        $mensaje = '<html>'.
            '<head><title>Email con HTML</title></head>'.
            '<body><h1>Hola '.$fila['nombre'].'</h1>'.
            '<hr>'.
            'Tu contraseña es: '.$fila['password'].'<b></b>'.
            //'<a href="http://localhost/onlineShop/clientes/validarcliente.php?codigo='.$codigo.'&id_cliente='.$fila2['id_cliente'].'">Click aquí</a>'.
            '<br>'.
            '<br>'.
            'Enviado por mi programa en PHP'.
            '</body>'.
            '</html>';

        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: Admin<admin@tiendaonline.com>';

        $enviado = mail($para, $titulo, $mensaje, $cabeceras);


        echo "exito";
    }else{echo "fracaso";}
}
else{header("location:../../index.php");}
cerrarconexion();