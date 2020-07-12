<?php
session_start();
if (isset($_SESSION['administrador'])){
    include ("../../php/conexion.php");


$total_pedidos = mysqli_query($link, "SELECT count(*) AS total FROM pedidos2") or die("Error al conectar con la tabla" . mysqli_error($link));
$total_filas = mysqli_fetch_array($total_pedidos);


/**---------------------- PAGINADOR--------------------*/


$registros = mysqli_query($link, "SELECT pedido FROM pedidos2") or die("Error al conectar con la tabla" . mysqli_error($link));
$total_registros = mysqli_num_rows($registros);

$TAMAÑO_PAGINA = 4;
$pagina = false;

if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $TAMAÑO_PAGINA;
}

$total_paginas = ceil($total_registros / $TAMAÑO_PAGINA);

$registros1 = mysqli_query($link, "select * from pedidos2 ORDER BY pedido DESC LIMIT " . $inicio . "," . "$TAMAÑO_PAGINA")
or die("Error al conectar con ls tabla" . mysqli_error($link));

/**---------------------- PAGINADOR--------------------*/
?>

    <!doctype html>
    <html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Shop</title>

        <link rel="stylesheet" type="text/css"
              href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <!-- dns para font Ubuntu -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../css/estilos.css">
        <link rel="stylesheet" href="../../css/normalizar.css">
        <link rel="stylesheet" href="../admin.css">

        <!-- Bootstrap-->
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <!-- Bootstrap-->

    </head>

    <body>
    <!------------------------  Ver detalles  ----------------------->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detalle del pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="divDetalles"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!------------------------  Ver detalles  ----------------------->
    <div class="tcat"><strong>PEDIDOS</strong></div>

    <div class="showcategorias fuente">

        <form action="actualizar_pedidos.php" method="post">
            <div style="float: left"><p><span style="color: dodgerblue">Total: </span><?php echo $total_filas ['total'] ?> Pedidos.</p></div>
            <div style="float: left">
                <select name="select_estado" id="estados" class="form-control" style="width: 200px; margin-left: 440px">
                    <option value="0">Preparacion en curso</option>
                    <option value="1">Enviado</option>
                    <option value="2">Entregado</option>
                </select>
                <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
            </div>
            <div style="float: left; margin-left: 10px"><button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button></div>

            <!------------------------ TABLA --------------------->
            <table class="table table-hover fuente">
                <tr align="center">
                    <th></th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Estado</th>
                </tr>
                <tbody align="center" style="font-size: 14px;">
                <?php
                $i = 0;
                while ($fila1 = mysqli_fetch_array($registros1)) {
                $i++;

                $registros2 = mysqli_query($link,"Select id_cliente from pedidos
                                                        WHERE pedido = '$fila1[pedido]'");
                $fila2 = mysqli_fetch_array($registros2);
                $registros3 = mysqli_query($link,"select nombre, apellido from clientes
                                                        WHERE id_cliente = '$fila2[id_cliente]'");
                $fila3 = mysqli_fetch_array($registros3);
                ?>
                <?php if (($i % 2) == 0) { ?> <tr class="alert-warning" id="<?php echo $fila1['pedido']; ?>"> <?php } ?>
                    <?php if (($i % 2) == 1) { ?> <tr class="alert-success" id="<?php echo $fila1['pedido']; ?>"> <?php } ?>

                    <td style="vertical-align: middle;"><input type="checkbox" name="checado[]" value="<?php echo $fila1['pedido'] ?>"></td>
        </form>
                <td style="vertical-align: middle"><?php echo $fila1['pedido']; ?></td>
                <td style="vertical-align: middle"><?php echo $fila3['nombre']." ".$fila3['apellido']?></td>
                <td style="vertical-align: middle"><?php echo $fila1['fecha_pedido']; ?></td>
                <td style="vertical-align: middle"><a>
                        <button type="button" onclick="ver_detalles('<?php echo $fila2['id_cliente']?>','<?php echo $fila1['pedido'] ?>')" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong" style="font-size: 12px">Detalles</button>
                    </a>
                </td>
                <?php if($fila1['estado'] == 0){ ?> <td style="background-color: darkorange; vertical-align: middle">Preparacion en curso</td> <?php } ?>
                <?php if($fila1['estado'] == 1){ ?> <td style="background-color: #007bff; vertical-align: middle">Enviado</td> <?php } ?>
                <?php if($fila1['estado'] == 2){ ?> <td style="background-color: #0F9E5E; vertical-align: middle">Entregado</td> <?php } ?>
                </tr>
                <?php
            }
            cerrarconexion();
            ?>
            </tbody>
        </table>
        <!------------------------ TABLA --------------------->
    </div>

    <!--------------------BOTONES PAGINADOR------------------->
    <div style="margin-top: 150px">
        <nav><?php
            if ($total_paginas > 1) {

                if ($pagina != 1) {
                    echo '<a href = "ver_pedidos.php?pagina=' . ($pagina - 1) . '"> Anterior </a>';
                }

                for ($i = 1; $i <= $total_paginas; $i++) {
                    if ($pagina == $i) {
                        echo $pagina;
                    } else {
                        echo '<a href = "ver_pedidos.php?pagina=' . $i . '">' . $i . ' </a>';
                    }
                }

                if ($pagina != $total_paginas) {
                    echo '<a href = "ver_pedidos.php?pagina=' . ($pagina + 1) . '"> Siguiente </a>';
                }
            }

            echo '</p>'
            ?></nav>
    </div>
    <!--------------------BOTONES PAGINADOR------------------->
    </body>
    <script type="text/javascript" src="pedidos.js"></script>
    </html>

<?php
} else {header('location:../index.php');}