<?php
include ("../php/conexion.php");
include ("../php/funciones.php");

/** Mientras el proyecto no este en un servidor de paga, se tiene que ejecutar manualmente el archivo "cron_jobs",
 *  para poder simular el tiempo de expiracion de los codigos de activacion." **/


if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) &&
    isset($_POST['direccion']) && isset($_POST['cp']) && isset($_POST['ciudad']) &&
    isset($_POST['password'])){

    $nombre = mysqli_real_escape_string($link,$_POST['nombre']);
    $nombre = ucwords($nombre);
    $apellido = mysqli_real_escape_string($link,$_POST['apellido']);
    $apellido = ucwords($apellido);
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $direccion = mysqli_real_escape_string($link,$_POST['direccion']);
    $cp = mysqli_real_escape_string($link,$_POST['cp']);
    $ciudad = mysqli_real_escape_string($link,$_POST['ciudad']);
    $password = mysqli_real_escape_string($link,$_POST['password']);

    //Validacion de existencia de cliente
    $registros=mysqli_query($link,"select email from clientes WHERE email = '$email'");
    if(mysqli_num_rows($registros) == 0){
        mysqli_query($link,"insert into clientes (nombre, apellido, email, direccion, cp, ciudad, password)
                              VALUES ('$nombre','$apellido','$email','$direccion','$cp','$ciudad','$password')");

        //Generacion del codigo de activacion.
        $codigo = generarCodigo(10);
        $fecha = time();
        $registros2 = mysqli_query($link, "select id_cliente from clientes WHERE email = '$email'");
        $fila2 = mysqli_fetch_array($registros2);

        mysqli_query($link,"insert into codigos (codigo, fecha_antigua, id_cliente) 
                              VALUES ('$codigo','$fecha','$fila2[id_cliente]')");

        //SE ENVIA CORREO DE BIENVENIDA

        $para = $email;//esto solo funciona si tuvieramos nuestra app en un servidor de pago. De lo contrario solo funciona en nuestro
        //correo que configuramos (archivo sendamil,ini y php.ini) para hacer las pruebas de envío.

        $titulo = 'Enviando email desde PHP';

        $mensaje = '<html>'.
            '<head><title>Email con HTML</title></head>'.
            '<body><h1>Hola '.$nombre.'</h1>'.
            'Gracias por darte de alta'.
            '<hr>'.
            'Para darte de alta, da click aquí: '.
            '<a href="http://localhost/onlineShop/clientes/validarcliente.php?codigo='.$codigo.'&id_cliente='.$fila2['id_cliente'].'">Click aquí</a>'.
            '<br>'.
            '<br>'.
            'Enviado por mi programa en PHP'.
            '</body>'.
            '</html>';

        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: Admin<admin@tiendaonline.com>';

        $enviado = mail($para, $titulo, $mensaje, $cabeceras);

        if ($enviado){
            echo 'exito';}
        else{
            echo 'noenviado';
        }
        cerrarconexion();
    }else{echo "emailrepetido";}
}
