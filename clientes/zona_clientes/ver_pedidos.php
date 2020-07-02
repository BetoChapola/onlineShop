<?php
session_start();
include ("../../php/conexion.php");

//De ahora en adelante, se usarán solo variables de $_SESSION; Al iniciar sesión por $_COOKIE, se creará
//la $_SESSION['id_cliente'].
if (isset($_COOKIE['id_cliente'])){
    $_SESSION['id_cliente'] = $_COOKIE['id_cliente'];
}

if (isset($_SESSION['id_cliente'])){
    //En vista_index.php ya existe una variable llamada $registros0, por lo cuál no se puede repetir en este código.

    $registros1 = mysqli_query($link,"select pedido from pedidos
                                            WHERE id_cliente = '$_SESSION[id_cliente]'
                                            GROUP BY pedido ASC");

    echo "<div id='accordion' style='margin: 0px auto 0px auto; max-width: 700px'>";

    while ($fila1 = mysqli_fetch_array($registros1)){ ?>
    <?php
        echo "<br><br>
        <h3 class='fuente'>Pedido Número: $fila1[pedido]</h3>";

        $registros2 = mysqli_query($link,"select * from pedidos
                                                WHERE pedido = $fila1[pedido]");
        $registros3 = mysqli_query($link,"select fecha_pedido from pedidos2
                                                WHERE pedido = $fila1[pedido]");
        $fila3 = mysqli_fetch_array($registros3);
        $registros4 = mysqli_query($link,"select total_pedido,envio,pago from pedidos2
                                                WHERE pedido = $fila1[pedido]");
        $fila4 = mysqli_fetch_array($registros4);
        ?>
            <div>
                <table class="table table-light fuente">
                    <tr>
                        <td>Pedido Número: <?php echo $fila1['pedido']?></td>
                        <td></td>
                        <td class="alert-success">Fecha de pedido: <?php echo $fila3['fecha_pedido']?></td>
                    </tr>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                    <?php while($fila2 = mysqli_fetch_array($registros2)){ ?>
                        <tr>
                            <td><?php echo $fila2['producto']?></td>
                            <td><?php echo $fila2['cantidad']?></td>
                            <td><?php echo $fila2['precio_producto']?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Envío: </th>
                        <?php if ($fila4['envio'] == "1"){ ?>
                            <td>SI</td>
                            <td>2.52</td>
                        <?php }else { ?>
                            <td>NO</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>Total: </th>
                        <td></td>
                        <td><?php echo $fila4['total_pedido']?></td>
                    </tr>
                    <tr>
                        <th>Total (+IVA): </th>
                        <td></td>
                        <td><?php
                            $Total = ((($fila4['total_pedido'])*16)/100)+$fila4['total_pedido'];
                            $Total = round($Total*100)/100;
                            echo $Total;?></td>
                    </tr>
                    <tr>
                        <th>Tipo de pago: </th>
                        <td><?php echo $fila4['pago']?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center">
                            <img src="../../imagenes/downloadPDF.png" style="width: 70px">
                        </td>
                    </tr>
                </table>
            </div>
    <?php }
    echo "</div>"
    ?>
<?php }