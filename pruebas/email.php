<?php

$para = 'phpejemplocliente@gmail.com';
$titulo = 'Enviando email desde PHP';

$mensaje = '<html>'.
    '<head><title>Email con HTML</title></head>'.
    '<body><h1>Email con HTML</h1>'.
    'Esto es un email que se envía en el formato HTML'.
    '<hr>'.
    '<a href="http://localhost/">mio</a>'.
    'Enviado por mi programa en PHP'.
    '</body>'.
    '</html>';

$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'From: Admin<admin@tiendaonline.com>';

$enviado = mail($para, $titulo, $mensaje, $cabeceras);

if ($enviado)
    echo 'Email enviado correctamente';
else
    echo 'Error en el envío del email';


//configuracion de los parametros
//https://meetanshi.com/blog/send-mail-from-localhost-xampp-using-gmail/ esta es una verificacion a 2 pasos.
//o simplemente ir a https://myaccount.google.com/lesssecureapps y permitir el acceso a las LSA
//google desactivara esta opcion despues de un tiempo.
// otra forma de hacerlo, configuraacion a verificacion de 2 pasos. https://www.youtube.com/watch?v=L5uCc8Hab-I