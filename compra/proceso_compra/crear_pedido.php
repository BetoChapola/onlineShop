<?php
session_start();
if (!isset($_SESSION['nombre_cliente'])){
    if (!isset($_COOKIE['nombre_cliente'])){
        header("location:../../index.php");
    }
}

if (!isset($_SESSION['mi_carrito'])){
    header("location:../../index.php");
}
include ("../../php/conexion.php");
$registros = mysqli_query($link,"select pedido from pedidos
                                       WHERE pedido = (SELECT max(pedido) FROM pedidos)") ;
if (mysqli_num_rows($registros) === 0){
    $pedido = 1;
}else {
    $fila = mysqli_fetch_array($registros);
    $pedido = $fila['pedido']+1;
}
//(PHP 4, PHP 5, PHP 7)
//count — Cuenta todos los elementos de un array o algo de un objeto.
//Insert en la tabla pedidos
for ($i=0;$i<count($_SESSION['mi_carrito']);$i++){
    $producto = $_SESSION['mi_carrito'][$i]['nombre'];
    $cantidad = $_SESSION['mi_carrito'][$i]['cantidad'];
    $precio = $_SESSION['mi_carrito'][$i]['precio'];

    if (isset($_SESSION['id_cliente'])){
        $id_cliente = $_SESSION['id_cliente'];
    }
    if (isset($_COOKIE['id_cliente'])){
        $id_cliente = $_COOKIE['id_cliente'];
    }

    mysqli_query($link,"insert into pedidos (pedido, producto, cantidad, precio_producto, id_cliente)
                              VALUES ('$pedido','$producto','$cantidad','$precio','$id_cliente')");
}

//Insert en la tabla pedidos2
$total_pedido = $_SESSION['total'];
$pago = $_SESSION['pago'];
if (isset($_SESSION['envio'])){
    $envio = 1; //true
}else{$envio = 0;} //false

mysqli_query($link,"insert into pedidos2 (total_pedido, envio, pago, pedido)
                          VALUES ('$total_pedido','$envio','$pago','$pedido')");

// Destruir las sesiones.
unset($_SESSION['mi_carrito']);
if (isset($_SESSION['envio'])){
    unset($_SESSION['envio']);
}
unset($_SESSION['pago']);
unset($_SESSION['total']);
unset($_SESSION['total_iva']);

cerrarconexion();

header("location:../../index.php?compra_realizada");