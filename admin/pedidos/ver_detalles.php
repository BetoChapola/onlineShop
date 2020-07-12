<?php
session_start();
if (isset($_SESSION['administrador'])){
    include ("../../php/conexion.php");

    if (isset($_POST['id_cliente']) && isset($_POST['pedido'])){

        $registros1 = mysqli_query($link,"select pedido from pedidos
                                                WHERE id_cliente = '$_POST[id_cliente]'");
        $fila1 = mysqli_fetch_array($registros1);
        ?>

        <?php
        //echo "<h3 class='fuente'>Pedido Número: $_POST[pedido]</h3>";

        $registros2 = mysqli_query($link,"select * from pedidos
                                                WHERE pedido = $_POST[pedido]");
        $registros4 = mysqli_query($link,"select * from pedidos2
                                                WHERE pedido = $_POST[pedido]");
        $fila4 = mysqli_fetch_array($registros4);
        ?>
        <div>
            <table class="table table-light fuente">
                <tr>
                    <?php if($fila4['estado'] == 0){ ?> <td colspan="3" style="background-color: darkorange">Preparacion en curso</td> <?php } ?>
                    <?php if($fila4['estado'] == 1){ ?> <td colspan="3" style="background-color: #007bff">Enviado</td> <?php } ?>
                    <?php if($fila4['estado'] == 2){ ?> <td colspan="3" style="background-color: #0F9E5E">Entregado</td> <?php } ?>
                </tr>
                <tr>
                    <td>Pedido: <?php echo $_POST['pedido']?></td>
                    <td class="alert-success">Fecha:</td>
                    <td class="alert-success"><?php echo $fila4['fecha_pedido']?></td>
                </tr>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                <tbody style="font-size: 14px">
                <?php while($fila2 = mysqli_fetch_array($registros2)){ ?>
                    <tr>
                        <td><?php echo $fila2['producto']?></td>
                        <td align="center"><?php echo $fila2['cantidad']?></td>
                        <td><?php echo $fila2['precio_producto']?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th>Envío: </th>
                    <?php if ($fila4['envio'] == "1"){ ?>
                        <td align="center">SI</td>
                        <td>2.52</td>
                    <?php }else { ?>
                        <td align="center">NO</td>
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
                <!--<tr>
                    <td></td>
                    <td></td>
                    <td align="center">
                        <img src="../../imagenes/downloadPDF.png" style="width: 70px">
                    </td>
                </tr>-->
                </tbody>
            </table>
        </div>
        <?php
    }
}else header('location:../../index.php');
