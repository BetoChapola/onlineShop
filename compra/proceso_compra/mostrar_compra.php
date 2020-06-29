<?php
session_start();
if (isset($_SESSION['mi_carrito']) && !empty($_SESSION['mi_carrito'])){?>
    <!-- Contenido del carrito (TABLA) -->
    <table class="table table-hover">
        <tr align="center">
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        <tbody align="center">
        <?php for ($i=0;$i<count($_SESSION['mi_carrito']);$i++){ ?>
            <tr id="<?php echo $i ?>">
                <td><?php echo $_SESSION['mi_carrito'][$i]['nombre']?></td>
                <td><?php echo $_SESSION['mi_carrito'][$i]['precio']?></td>
                <td><?php echo $_SESSION['mi_carrito'][$i]['cantidad']?></td>
                <td><a style="cursor: pointer" onclick="eliminar_producto(<?php echo $i ?>)"><img src="../delete1.png" alt=""></a></td>
            </tr>
            <?php } ?>
        <?php if (isset($_SESSION['envio'])){ ?>
            <tr>
                <td>Envío</td>
                <td>3</td>
                <td>1</td>
                <td></td>
            </tr>
        <?php } ?>
        <?php if (isset($_SESSION['pago'])){ ?>
            <tr class="alert-warning">
                <td>Tipo de pago:</td>
                <td><?php echo $_SESSION['pago'] ?></td>
            </tr>
        <?php } ?>
        <tr class="alert-success">
            <td><span><strong>Total neto:</strong></span></td>
            <td><?php echo $_SESSION['total'] ?></td>
        </tr>
        <tr class="alert-success">
            <td><span><strong>Total + IVA:</strong></span></td>
            <?php $_SESSION['total_iva'] = (($_SESSION['total']*16)/100)+$_SESSION['total'];
            $_SESSION['total_iva'] = round($_SESSION['total_iva'] * 100) / 100; ?>
            <td><?php echo $_SESSION['total_iva'] ?></td>
        </tr>
        </tbody>
    </table>
    <!-- Contenido del carrito (TABLA) -->
    <?php
}else echo "Carrito vacio";