<?php
/** Los archivos cron_job pueden ser configurados y ejecutados en un servidor de paga de manera automatica, para este
 * ejemplo lo haremos manualmente, simulando lo que el script haria cada 24 horas.
 *
 *  El scritp borra de la tabla de clientes todos los clientes que no hayan validado su registro dentro de
 *  las siguientes 24 horas despues de su registro. O sea, los clientes que tengan el campo "validado" = 0.
 *
 *  fecha_actual-fecha_antigua = 86400 segundos (un dia tiene 86400 seg)
 **/


include ("../php/conexion.php");
$fecha_actual = time();
$registros = mysqli_query($link,"select id_cliente from codigos WHERE '$fecha_actual' - fecha_antigua > 60");
mysqli_query($link,"delete from codigos WHERE '$fecha_actual' - fecha_antigua > 60");

while ($fila = mysqli_fetch_array($registros)){
    mysqli_query($link,"delete from clientes where id_cliente = '$fila[id_cliente]' and validado = '0'");
}
