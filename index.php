<?php
include ("php/conexion.php");
$registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC");
$registros1 = mysqli_query($link,"select id_producto, precio, id_categoria from productos WHERE inicio = 1 LIMIT 0,12");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>

    <link rel="stylesheet" href="iconos/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/normalizar.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <link rel="stylesheet" href="css/animate.min.css">

    <script src="css/wow.min.js"></script>
    <script>new WOW().init()</script>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Bootstrap-->

    <!-- MENU -->
    <link rel="stylesheet" href="menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- MENU -->

    <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <!-- End WOWSlider.com HEAD section -->

</head>

<body>

<header> <!-- Header-->
    <div class="cabecera"></div>
    <nav class="wow bounceInDown" data-wow-duration="1.5s">
        <!-- Start css3menu.com BODY section -->
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a class="pressed" href="#" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/home.png" alt=""/>Home</a></li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/buy.png" alt=""/>Producto</a>

                <ul>
                    <?php while($fila0=mysqli_fetch_array($registros0)){ ?>
                    <li><a href="mostrarproductos.php?id_categoria=<?php echo $fila0['id'];?>"><?php echo $fila0['categoria'];?></a></li>
                    <?php } ?>
                </ul>

            </li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/contact.png" alt=""/>Contacto</a></li>
            <li class="toproot"><a href="#" style="width:223px;height:56px;line-height:56px;"><span><img src="menucss/menucss/register.png" alt=""/>Privado</span></a>
                <ul>
                    <li class="topmenu"><a href="#">Acces</a></li>
                    <li class="topmenu"><a href="#">Register Now</a></li>
                </ul></li>
        </ul>
        <!-- End css3menu.com BODY section -->
    </nav> <!-- Menu-->

    <!--------- BUSCADOR -------->
    <div style="margin: 0px auto 0 auto; width: 920px; padding-left: 20px;">
        <form class="form1" action="buscador.php" method="post">
            <fieldset class="fieldset1">
                <input class="input1" type="search" name="buscar" placeholder="Buscar...">
                <button class="button1" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </fieldset>
        </form>
    </div>
    <!--------- BUSCADOR -------->

    <div class="slider wow bounceInUp" data-wow-duration="1.5s">

        <!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                <li><img src="data1/images/lasmejoresofertas.jpg" alt="las-mejores-ofertas" title="las-mejores-ofertas" id="wows1_0"/></li>
                <li><img src="data1/images/transporte.jpg" alt="transporte" title="transporte" id="wows1_1"/></li>
            </ul></div>
            <div class="ws_bullets"><div>
                <a href="#" title="las-mejores-ofertas"><span><img src="data1/tooltips/lasmejoresofertas.jpg" alt="las-mejores-ofertas"/>1</span></a>
                <a href="#" title="transporte"><span><img src="data1/tooltips/transporte.jpg" alt="transporte"/>2</span></a>
            </div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">wowslider.net</a> by WOWSlider.com v8.5</div>
            <div class="ws_shadow"></div>
        </div>
        <script type="text/javascript" src="engine1/wowslider.js"></script>
        <script type="text/javascript" src="engine1/script.js"></script>
        <!-- End WOWSlider.com BODY section -->

    </div> <!-- Slider-->
</header>

    <div class="main">
        <?php while($fila1 = mysqli_fetch_array($registros1)) {
            $registros2 = mysqli_query($link,"select nombre from imagenes where id_producto = '$fila1[id_producto]' and prioridad = 1");
            $fila2 = mysqli_fetch_array($registros2)
            ?>
        <a href="detalleproducto.php?id_categoria=<?php echo $fila1['id_categoria'];?>&id_producto=<?php echo $fila1['id_producto'];?>">
                <div class="productosmain hvr-buzz-out">
                    <img src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros2) > 0) echo $fila2['nombre']; else echo "sinimagen.jpg"?>" width="100%" alt="portatil1">
                    <div class="precio">$<?php echo $fila1['precio']; ?> Pesos.</div>
                </div>
            <!-- el ancho al 100% de la imagen se adapta al 100% del div "productosmain"-->
            <?php
        }
        cerrarconexion();
        ?>
        <div class="limpiar"></div>
    </div>

<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
</body>
</html>