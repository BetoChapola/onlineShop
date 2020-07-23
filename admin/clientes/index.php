<?php
session_start();
if (isset($_SESSION['administrador'])) {
    include('../../php/conexion.php');

    $total_clientes = mysqli_query($link, "SELECT count(*) AS total FROM clientes") or die("Error al conectar con la tabla" . mysqli_error($link));
    $total_filas = mysqli_fetch_array($total_clientes);


    /**---------------------- PAGINADOR--------------------*/


    $registros = mysqli_query($link, "SELECT id_cliente FROM clientes WHERE validado = '1'") or die("Error al conectar con la tabla" . mysqli_error($link));
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

    $registros1 = mysqli_query($link, "select * from clientes WHERE validado = '1' ORDER BY id_cliente ASC LIMIT " . $inicio . "," . "$TAMAÑO_PAGINA")
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
        <link rel="stylesheet" href="../CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>

        <!-- Bootstrap-->
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <!-- Bootstrap-->


    </head>

    <body>

    <div class="cabecera_admin"></div>
    <div align="center" style="margin-top: -90px">
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a href="../pedidos/ver_pedidos.php" style="width:168px;height:44px;line-height:44px;"><img src="../CSS3 Menu_files/css3menu1/cube.png" alt=""/>Pedidos</a></li>
            <li class="toproot"><a href="../productos/showproductos.php" style="width:168px;height:44px;line-height:44px;"><span><img src="../CSS3 Menu_files/css3menu1/transfer.png" alt=""/>Productos</span></a>
                <ul>
                    <li><a href="../productos/formaddproductos.php">Añadir</a></li>
                </ul></li>
            <li class="topmenu"><a href="../categorias/formaddcategoria.php" style="width:168px;height:44px;line-height:44px;"><img src="../CSS3 Menu_files/css3menu1/grid.png" alt=""/>Categorías</a></li>
            <li class="topmenu"><a href="../clientes/index.php" style="width:168px;height:44px;line-height:44px;"><img src="../CSS3 Menu_files/css3menu1/users.png" alt=""/>Clientes</a></li>
            <li class="topmenu"><a href="../chat/index.php" style="width:168px;height:44px;line-height:44px;"><img src="../CSS3 Menu_files/css3menu1/chat.png" alt=""/>Chat</a></li>
        </ul><p class="_css3m"><a href="http://css3menu.com/">menu drop down</a> by Css3Menu.com</p>
    </div>

    <div class="tcat"><strong>CLIENTES</strong></div>

    <div class="showcategorias">

        <p class="fuente"><span style="color: dodgerblue">Total: </span><?php echo $total_filas ['total'] ?> clientes.</p>
        <div class="alert alert-success ocultar" role="alert" id="exito">
            <p class="centrar"><strong>¡Bien!</strong> Se ha eliminado la cuenta del cliente.</p>
        </div>
        <!------------------------ TABLA --------------------->
        <table class="table table-hover">
            <tr align="center">
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>CP</th>
                <th>Ciudad</th>
                <th>Password</th>
                <th>Eliminar</th>
            </tr>
            <tbody align="center">
            <?php
            $i = 0;
            while ($fila1 = mysqli_fetch_array($registros1)) {
                $i++;
                ?>
                <?php if (($i % 2) == 0) { ?> <tr class="alert-warning" id="<?php echo $fila1['id_cliente']; ?>"> <?php } ?>
                <?php if (($i % 2) == 1) { ?> <tr class="alert-success" id="<?php echo $fila1['id_cliente']; ?>"> <?php } ?>

                <td><?php echo utf8_encode($fila1['nombre']) . "<br>"; ?></td>
                <td><?php echo $fila1['apellido'] ?></td>
                <td><?php echo $fila1['email'] ?></td>
                <td><?php echo $fila1['direccion'] ?></td>
                <td><?php echo $fila1['cp'] ?></td>
                <td><?php echo $fila1['ciudad'] ?></td>
                <td><?php echo $fila1['password'] ?></td>
                <td><a onclick="eliminar('<?php echo $fila1['id_cliente']; ?>')">
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </a></td>
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
                    echo '<a href = "index.php?pagina=' . ($pagina - 1) . '"> Anterior </a>';
                }

                for ($i = 1; $i <= $total_paginas; $i++) {
                    if ($pagina == $i) {
                        echo $pagina;
                    } else {
                        echo '<a href = "index.php?pagina=' . $i . '">' . $i . ' </a>';
                    }
                }

                if ($pagina != $total_paginas) {
                    echo '<a href = "index.php?pagina=' . ($pagina + 1) . '"> Siguiente </a>';
                }
            }

            echo '</p>'
            ?></nav>
    </div>
    <!--------------------BOTONES PAGINADOR------------------->
    <!-- Footer-->
    <footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
    <!-- Footer-->
    </body>
    <script type="text/javascript" src="clientes.js"></script>
    </html>
    <?php
} else {header('location:../index.html');}?>