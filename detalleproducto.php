<?php
session_start();
include ("php/conexion.php");

$registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC ");
$registros1 = mysqli_query($link,"select categoria from categorias WHERE id ='$_GET[id_categoria]'");
$fila1 = mysqli_fetch_array($registros1);
$registros2 = mysqli_query($link,"select * from productos WHERE id_producto = '$_GET[id_producto]'");
$fila2 = mysqli_fetch_array($registros2);
$registros3 = mysqli_query($link,"select nombre from imagenes WHERE id_producto = '$_GET[id_producto]' AND prioridad=1");
$fila3 = mysqli_fetch_array($registros3);
$registros4 = mysqli_query($link,"select nombre from imagenes WHERE id_producto = '$_GET[id_producto]' AND prioridad=2");
$fila4 = mysqli_fetch_array($registros4);
$registros5 = mysqli_query($link,"select nombre from imagenes WHERE id_producto = '$_GET[id_producto]' AND prioridad=3");
$fila5 = mysqli_fetch_array($registros5);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/normalizar.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <link rel="stylesheet" href="iconos/css/font-awesome.min.css">
    <!-- Estilo para ver el borde del efecto "transfer" -->
    <style>
        .ui-effects-transfer{
            border: 3px darkcyan solid;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-image: url("admin/productos/imagenes/<?php if(mysqli_num_rows($registros3) > 0) echo $fila3['nombre']; else echo "sinimagen.jpg"?>");
            opacity: 0.7;
        }
    </style>
    <!-- Estilo para ver el borde del efecto "transfer" -->

    <!-- Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Bootstrap-->
    <!-- Estilos MENU -->
    <link rel="stylesheet" href="menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- Estilos MENU -->
    <!---- LIGHTBOX ---->
    <link rel="stylesheet" href="lightbox/vlb_files1/vlightbox1.css" type="text/css">
    <link rel="stylesheet" href="lightbox/vlb_files1/visuallightbox.css" type="text/css" media="screen">
    <script src="lightbox/vlb_engine/visuallightbox.js" type="text/javascript"></script>
    <script src="lightbox/vlb_engine/vlbdata1.js" type="text/javascript"></script>
    <!---- LIGHTBOX ---->

    <script type="text/javascript">

        function mostrarText(){
            $("#btnmostrarmas").hide("fast");
            $("#descripcionTxt").show("fast");
            $("#btnmostrarmenos").show("fast");
        }

        function ocultarText(){
            $("#btnmostrarmenos").hide("fast");
            $("#descripcionTxt").hide("fast");
            $("#btnmostrarmas").show("fast");
        }
    </script>
    <!-- Audio cuando se presiona el boton comprar -->
    <audio id="player" src="compra/click-comprar.mp3"></audio>
    <!-- Audio cuando se presiona el boton comprar -->
</head>
<body>

<!----- MODAL LOGIN ----->
<div class="modal fade fuente" id="modal_inicio_sesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form name="form_inicio_sesion" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Email</label>
                        <input onkeypress="emailValidado()" type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Password:</label>
                        <input onkeypress="passwordValidado()" type="text" class="form-control" name="password">
                    </div>
                </form>
            </div>
            <div><span id="resultado"></span></div>
            <br><br>
            <div class="modal-footer">
                <button onclick="validar_sesion()" type="button" class="btn btn-primary">Ingresar</button>
            </div>
            <div class="alert alert-danger ocultar" role="alert" id="alertIncompleto">
                <p class="centrar"><strong>¡Ups!</strong> Debes ingresar tu email y tu password.</p>
            </div>
        </div>
    </div>
</div>
<!----- MODAL LOGIN ----->


<header>
    <div class="cabecera"></div>
    <nav class="wow bounceInDown" data-wow-duration="1.5s">
        <!-- MENU -->
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a href="index.php" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/home.png" alt=""/>Home</a></li>
            <li class="topmenu"><a class="pressed" href="#" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/buy.png" alt=""/>Producto</a>

                <ul>
                    <?php while($fila0=mysqli_fetch_array($registros0)){ ?>
                        <li><a href="mostrarproductos.php?id_categoria=<?php echo $fila0['id'];?>"><?php echo $fila0['categoria'];?></a></li>
                    <?php } ?>
                </ul>

            </li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/contact.png" alt=""/>Contacto</a></li>
            <li class="toproot"><a href="#" style="width:223px;height:56px;line-height:56px;"><span><img src="menucss/menucss/register.png" alt=""/>Privado</span></a>
                <ul>
                    <li class="topmenu" onclick="ver_modal_inicio()"><a href="#">Entrar</a></li>
                    <li class="topmenu"><a href="clientes/formregistro.php">Registrate</a></li>
                </ul></li>
        </ul>
        <!-- MENU -->
    </nav>

    <div style="margin: 0px auto 0 auto; max-width: 920px; padding-left: 20px;">
        <div style="float: right">
            <form class="form1" action="buscador.php" method="post">
                <fieldset class="fieldset1">
                    <input class="input1" type="search" name="buscar" placeholder="Buscar...">
                    <button class="button1" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </fieldset>
            </form>
        </div>
        <?php if (isset($_SESSION['nombre_cliente']) || isset($_COOKIE['nombre_cliente'])){ ?>
            <div>
                <p class="fuente">
                    <a href="#" style="text-decoration: none">
                    <span style="color: #e0a800">Bienvenido &nbsp;
                        <?php if (isset($_SESSION['nombre_cliente'])){echo "Hola por sesion ".$_SESSION['nombre_cliente'];}
                        if (!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])){
                            echo "Hola por cookie ".$_COOKIE['nombre_cliente'];
                        }?>
                    </span>
                </p></a>
            </div>
        <?php } ?>
    </div>
</header>

<div class="main">
    <p class="fuente"><span style="color: dodgerblue">Inicio -> </span><?php echo $fila1['categoria'];?> -> <?php echo $fila2['nombre'];?></p>
    <div style="margin: 40px auto 0 auto">
        <!------ LIGHTBOX ------->
        <div style="float: left; margin-right: 30px">
            <div id="imgPrincipal">
                <a class="vlightbox1" href="admin/productos/imagenes/<?php if(mysqli_num_rows($registros3) > 0) echo $fila3['nombre']; else echo "sinimagen.jpg"?>" title="<?php echo $fila2['nombre'];?>">
                    <img width="330px" height="247" src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros3) > 0) echo $fila3['nombre']; else echo "sinimagen.jpg"?>">
                </a>
            </div>
            <a class="vlightbox1" href="admin/productos/imagenes/<?php if(mysqli_num_rows($registros4) > 0) echo $fila4['nombre']; else echo "sinimagen.jpg"?>" title="<?php echo $fila2['nombre'];?>">
                <img width="160px" height="120" src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros4) > 0) echo $fila4['nombre']; else echo "sinimagen.jpg"?>"></a>
            <a class="vlightbox1" href="admin/productos/imagenes/<?php if(mysqli_num_rows($registros5) > 0) echo $fila5['nombre']; else echo "sinimagen.jpg"?>" title="<?php echo $fila2['nombre'];?>">
                <img width="160px" height="120" src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros5) > 0) echo $fila5['nombre']; else echo "sinimagen.jpg"?>" alt=""></a>
        </div>
        <!------ LIGHTBOX ------->
        <!------ PRECIO Y CARACTERISTICAS ------->
        <p class="fuente" style="font-size: 30px"><?php echo $fila2['nombre'];?></p>
        <form name="formCompra">
            <span class="fuente" style="font-size: 25px">
                <span style="color: goldenrod">$<?php echo $fila2['precio'];?>.00 m.n.</span> &nbsp;X&nbsp;&nbsp;
                <input style="width: 45px; color: dodgerblue" type="number" min="1" max="10" value="1" name="cantidad_producto">
                <input type="hidden" name="nombre_producto" value="<?php echo $fila2['nombre']; ?>">
                <input type="hidden" name="precio_producto" value="<?php echo $fila2['precio']; ?>">
                <button type="button" onclick="volar()" class="btn btn-success">Comprar</button>
            </span>
        </form>
        <p class="fuente" style="font-size: 20px; margin-top: 25px">&nbsp;&nbsp;Características:&nbsp;&nbsp;</p>
        <div class="fuente">
            <div>
                <?php
                $array = explode(" ",$fila2['descripcion']);
                if (count($array)<35){
                    for ($i = 0;$i<count($array);$i++){
                        echo $array[$i]." ";
                    }
                }else{
                    for ($i = 0;$i<35;$i++){
                        echo $array[$i]." ";
                    }echo "...";
                ?>
            </div>
            <div class="ocultar" id="descripcionTxt">
                <?php
                for ($i = 35;$i<count($array);$i++){
                    echo $array[$i]." ";
                } ?>
            </div><br>
            <button id="btnmostrarmas" onclick="mostrarText()" type="button" class="btn btn-default">Mas...</button>
            <div id="btnmostrarmenos" class="ocultar"><button  onclick="ocultarText()" type="button" class="btn btn-default">Menos...</button></div>
            <?php } ?>
        </div>
        <!------ PRECIO Y CARACTERISTICAS ------->
    </div>
</div>
<?php cerrarconexion(); ?>
<div class="limpiar"></div>
<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
<!-- Footer-->

<!------- CARRITO ------->
<div id="carrito" class="carrito">
    <div class="icono-shop" align="center">
        <i style="color: gold; font-size: 45px; margin-top: 30px; margin-left: 203px" class="fa fa-shopping-cart"></i>
    </div>
    <div id="mostrar_compra" class="content-shop fuente">
    </div>
</div>
<!------- CARRITO ------->
<script type="text/javascript" src="clientes/inicio_sesion/inicio_sesion.js"></script>
<script type="text/javascript" src="compra/compra.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- JQuery UI -->
</body>
</html>