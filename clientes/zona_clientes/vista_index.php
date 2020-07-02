<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../iconos/css/font-awesome.min.css">
    <link rel="stylesheet" href="zona_clientes.css">
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"><!-- JQuery Ui Acordeon -->



    <script src="../../css/wow.min.js"></script>
    <script>new WOW().init()</script>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <!-- Bootstrap-->

    <!-- MENU -->
    <link rel="stylesheet" href="../../menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- MENU -->

    <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
    <link rel="stylesheet" type="text/css" href="../../engine1/style.css"/>
    <!-- End WOWSlider.com HEAD section -->


</head>

<body>
<header> <!-- Header-->
    <div class="cabecera"></div>
    <nav class="wow bounceInDown" data-wow-duration="1.5s">
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a class="pressed" href="../../index.php" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/home.png" alt=""/>Home</a></li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/buy.png" alt=""/>Producto</a>

                <ul>
                    <?php
                    $registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC");
                    while($fila0=mysqli_fetch_array($registros0)){ ?>
                        <li><a href="../../mostrarproductos.php?id_categoria=<?php echo $fila0['id'];?>"><?php echo $fila0['categoria'];?></a></li>
                    <?php } ?>
                </ul>

            </li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/contact.png" alt=""/>Contacto</a></li>
        </ul>
    </nav> <!-- Menu-->

    <div style="margin: 0px auto 0 auto; max-width: 920px; padding-left: 20px;">
        <div style="float: right">
            <form class="form1" action="../../buscador.php" method="post">
                <fieldset class="fieldset1">
                    <input class="input1" type="search" name="buscar" placeholder="Buscar...">
                    <button class="button1" type="submit">
                        <i class="fa1 fa fa-search"></i>
                    </button>
                </fieldset>
            </form>
        </div>
            <div>
                <p class="fuente">
                    <a href="vista_index.php" style="text-decoration: none">
                    <span style="color: #e0a800">Bienvenido &nbsp;
                        <?php if (isset($_SESSION['nombre_cliente'])){echo "Hola por sesion ".$_SESSION['nombre_cliente'];}
                        if (!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])){
                            echo "Hola por cookie ".$_COOKIE['nombre_cliente'];
                        }?>
                    </span>
                </p></a>
            </div>
    </div>
</header>

<div class="main">
    <div class="divZC" id="botones">
        <div id="botonVer" class="fuente botonZC hvr-grow" onclick="ver_modificar_datos()">
            <strong style="color: white">VER / MODIFICAR DATOS</strong>
            <div class="textZC">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
        </div>

        <div class="fuente botonZC hvr-grow" onclick="ver_pedidos()">
            <strong style="color: white">VER PEDIDOS</strong>
            <div class="textZC" style="margin-top: 0px">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </div>
        </div>
        <a href="destruir_cookie_sesion.php" style="text-decoration: none">
            <div class="fuente botonZC hvr-grow">
                <strong style="color: white">DESCONECTAR</strong>
                <div class="textZC" style="margin-top: 0px">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </div>
            </div>
        </a>

    </div>
    <div class="limpiar"></div>

    <div align="center" class="ocultar" id="cargaImagen">
        <img src="../../imagenes/cargando.gif" alt="" style="margin: 10px auto 0 auto; text-align: center">
    </div>
    <div id="div_respuesta" style="display: none"></div>
    <div id="div_ver_pedidos" style="display: none"></div>
</div>


<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- JQuery UI -->
<script type="text/javascript" src="zona_clientes.js"></script>
</body>
</html>