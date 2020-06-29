<?php
session_start();
if (!isset($_SESSION['nombre_cliente'])){
    if (!isset($_COOKIE['nombre_cliente'])){
        header("location:../../clientes/formregistro.php");
    }
}

include ("../../php/conexion.php");
$registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC");
?>

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
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../../css/hover-min.css">
    <link rel="stylesheet" href="../../css/animate.min.css">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <!-- Bootstrap-->

    <!-- MENU -->
    <link rel="stylesheet" href="../../menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- MENU -->

</head>

<body>
<header>
    <!-- Start css3menu.com BODY section -->
    <div class="cabecera"></div>
    <nav class="wow bounceInDown" data-wow-duration="1.5s">
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a class="pressed" href="../../index.php" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/home.png" alt=""/>Home</a></li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/buy.png" alt=""/>Producto</a>

                <ul>
                    <?php while($fila0=mysqli_fetch_array($registros0)){ ?>
                        <li><a href="../../mostrarproductos.php?id_categoria=<?php echo $fila0['id'];?>"><?php echo $fila0['categoria'];?></a></li>
                    <?php } ?>
                </ul>

            </li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../../menucss/menucss/contact.png" alt=""/>Contacto</a></li>
        </ul>
    </nav>
    <!-- End css3menu.com BODY section -->
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


<div id="principal" style="margin: 65px auto 45px auto; width: 90%; max-width: 1000px">
    <div id="div_1" style="border: 1px solid #6f42c1; min-height: 450px;"> <!-- Forma de envío -->
        <div style="min-height: 380px;  margin-left: 15px; margin-right: 15px">
            <p  class="fuente" style="font-size: 20px; font-weight: bold; color: goldenrod; margin-left: 0px">Forma de envío</p>
            <table class="table table-light fuente" style="font-size: 17px">
                <tr>
                    <td align="center"><input type="radio" name="envio" id="envio1" onclick="restar_envio()"></td>
                    <td><label for="envio1">Recoger en tienda (Gratis)</label></td>
                </tr>
                <tr>
                    <td align="center"><input type="radio" name="envio" id="envio2" onclick="sumar_envio()"></td>
                    <td><label for="envio2">Envío (+3 Euros)</label></td>
                </tr>
            </table>
        </div>
        <div style=" margin-left: 15px" class="fuente">
            <a href="../../index.php">
                <button type="button" class="btn btn-success">Seguir comprando</button>
            </a>
            <button type="button" onclick="goto_div2()" class="btn btn-success">Siguiente</button>
        </div>
    </div>
    <div id="div_2" class="ocultar" style="border: 1px solid #6f42c1; min-height: 450px;"><!-- Forma de pago -->
        <div style="min-height: 380px;  margin-left: 15px; margin-right: 15px">
            <p  class="fuente" style="font-size: 20px; font-weight: bold; color: goldenrod; margin-left: 0px">Forma de pago</p>
            <table class="table table-light fuente" style="font-size: 17px">
                <tr>
                    <td align="center"><input type="radio" name="pago" id="efectivo" onclick="forma_pago('Efectivo')"></td>
                    <td><label for="efectivo">Efectivo (Solo en tienda)</label></td>
                </tr>
                <tr onmouseover="datos_transfer()">
                    <td align="center"><input id="transferencia" type="radio" name="pago" onclick="forma_pago('Tranferencia')"></td>
                    <td><label for="transferencia">Transferencia bancaria
                        <div id="alert_transferencia" class="alert alert-success ocultar fuente" role="alert" style="margin-top: 10px; font-size: 15px">
                            Número de cuenta: 000000000000000
                        </div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="center"><input type="radio" name="pago" id="tarjeta" onclick="forma_pago('Tarjeta')"></td>
                    <td><label for="tarjeta">Tarjeta de crédito</label></td>
                </tr>
                <tr>
                    <td align="center"><input type="radio" name="pago" id="contrareembolso" onclick="forma_pago('Contrareembolso')"></td>
                    <td><label for="contrareembolso">Pago contrareembolso</label></td>
                </tr>
            </table>
        </div>
        <div style=" margin-left: 15px" class="fuente">
            <button type="button" onclick="goto_div1()" class="btn btn-success">Atrás</button>
            <button type="button" onclick="goto_div3()" class="btn btn-success">Siguiente</button>
        </div>
    </div>
    <div id="div_3" class="ocultar" style="border: 1.5px solid #6f42c1; min-height: 450px;"><!-- Finalizar compra -->
        <div style="min-height: 380px;  margin-left: 15px; margin-right: 15px">
            <div id="mostrar_compra"></div>
        </div>
        <div style=" margin-left: 15px" class="fuente">
            <button type="button" onclick="goto_div2b()" class="btn btn-success">Atrás</button>
            <a href="crear_pedido.php">
                <button type="button" class="btn btn-success">Finalizar compra</button>
            </a>
        </div>
    </div>
</div>

<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
<!-- Footer-->
<script type="text/javascript" src="../../clientes/inicio_sesion/inicio_sesion.js"></script>
<script type="text/javascript" src="../../compra/compra.js"></script>
<script type="text/javascript" src="proceso_compra.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- JQuery UI -->
</body>
</html>