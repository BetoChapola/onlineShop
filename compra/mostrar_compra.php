<?php
session_start();
$repetido = "no";
/**Lo que se muestra en el div "carrito":**/

/**Si y solo si existe la variable $_POST['nombre_producto'] (que se crea al momento de dar click al botón
 * "Comprar", que ejecuta la función "volar()"), entonces: **/

if (isset($_POST['nombre_producto'])){
    $total = $_POST['cantidad_producto']*$_POST['precio_producto'];
    if (isset($_SESSION['total'])){
        $_SESSION['total'] = $total + $_SESSION['total'];
    }else{$_SESSION['total'] = $total;}

    /** Si y solo si existe la variable global $_SESSION['mi_carrito']
     * o sea, si ya existe un artículo en el carrito.*/
    if (isset($_SESSION['mi_carrito'])){
        /**Se recorren todos los elementos del arreglo **/
        for ($i=0;$i<count($_SESSION['mi_carrito']);$i++){
            /**Si el valor del arreglo == el valor pasado por $_POST se suman las cantidades **/
            if ($_SESSION['mi_carrito'][$i]['nombre']===$_POST['nombre_producto']){
                $_SESSION['mi_carrito'][$i]['cantidad'] = $_SESSION['mi_carrito'][$i]['cantidad']+$_POST['cantidad_producto'];
                $repetido = "si";
            }
        }
    }

    if ($repetido == "no"){
        $_SESSION['mi_carrito'][]=array("nombre"=>$_POST['nombre_producto'],
                                        "precio"=>$_POST['precio_producto'],
                                        "cantidad"=>$_POST['cantidad_producto']);
        /**Se crea la variable global $_SESSION['mi_carrito'], de tipo array.
        ['mi_carrito'][0][nombre][precio][cantidad]
        ['mi_carrito'][1][nombre][precio][cantidad]
        ['mi_carrito'][...n][nombre][precio][cantidad]
         *
         * Recordemos que las variables de sesión una vez que se creen, estarán vivas mientras la página
         * esté abierta, o que es lo mismo: mientras la sesión esté activa. Entonces cada vez que ejecutemos la
         * página "mostrar_compra.php" estaremos agregando 1 elemento al array.
         **/
    }

}

if (isset($_SESSION['mi_carrito']) && !empty($_SESSION['mi_carrito'])){
?>
    <!-- Contenido del carrito (TABLA) -->
    <table class="table table-hover">
        <tr align="center">
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        <tbody align="center">
        <?php
        for ($i=0;$i<count($_SESSION['mi_carrito']);$i++){ ?>
            <tr id="<?php echo $i ?>">
                <td><?php echo $_SESSION['mi_carrito'][$i]['nombre']?></td>
                <td ><?php echo $_SESSION['mi_carrito'][$i]['precio']?></td>
                <td><?php echo $_SESSION['mi_carrito'][$i]['cantidad']?></td>
                <td><a style="cursor: pointer" onclick="eliminar_producto(<?php echo $i ?>)"><img src="compra/delete1.png" alt=""></a></td>
            </tr>
            <?php
        }
        ?>
        <tr class="alert-success"><td><span><strong>Total neto:</strong></span></td>
            <td><?php echo $_SESSION['total'] ?></td>
        </tr>
        <tr class="alert-success"><td><span><strong>Total + IVA:</strong></span></td>
            <?php $_SESSION['total_iva'] = (($_SESSION['total']*16)/100)+$_SESSION['total'];
                  $_SESSION['total_iva'] = round($_SESSION['total_iva'] * 100) / 100; ?>
            <td><?php echo $_SESSION['total_iva'] ?></td>
        </tr>
        </tbody>
    </table>
    <!-- Contenido del carrito (TABLA) -->

<?php

}else echo "Carrito vacio";
