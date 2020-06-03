<?php
if(!isset($_POST['buscar'])){
    header("location:index.php");
}else{
    include ("php/conexion.php");
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


    <header> <!-- Header-->
        <div class="cabecera"></div>
        <nav class="wow bounceInDown" data-wow-duration="1.5s">
            <!-- Start css3menu.com BODY section -->
            <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
            <ul id="css3menu1" class="topmenu">
                <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
                <li class="topmenu"><a class="pressed" href="index.php" style="width:224px;height:56px;line-height:56px;"><img src="menucss/menucss/home.png" alt=""/>Home</a></li>
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
                        <li class="topmenu" onclick="ver_modal_inicio()"><a href="#">Entrar</a></li>
                        <li class="topmenu"><a href="clientes/formregistro.php">Registrate</a></li>
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

    </header>

    <div class="main">
        <!-------img PRODUCTOS -------->
        <?php
        //VER VIDEO 86: mysqli_real_escape_string();
        if ($_POST['buscar'] != ""){
            $buscar = mysqli_real_escape_string($link,$_POST['buscar']);
            $registros1 = mysqli_query($link,"SELECT id_producto, precio, id_categoria, nombre FROM productos INNER JOIN categorias 
                                                ON id_categoria=id WHERE nombre LIKE '%$buscar%' or categoria LIKE '%$buscar%'");
            if (mysqli_num_rows($registros1)>0){
                while($fila1 = mysqli_fetch_array($registros1)) {
                    $registros2 = mysqli_query($link,"select nombre from imagenes where id_producto = '$fila1[id_producto]' and prioridad = 1");
                    $fila2 = mysqli_fetch_array($registros2)
                    ?>
                    <a href="detalleproducto.php?id_categoria=<?php echo $fila1['id_categoria'];?>&id_producto=<?php echo $fila1['id_producto'];?>">
                        <div class="productosmain hvr-float-shadow" style="border-top: 2px solid #6699ff; border-left: 2px solid #6699ff; margin-bottom: 20px">
                            <img src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros2) > 0) echo $fila2['nombre']; else echo "sinimagen.jpg"?>" width="100%" alt="portatil1">
                            <div class="precio fuente">$<?php echo $fila1['precio']; ?> Pesos.</div>
                            <div class="fuente" style="padding:0px 3px 0px 3px;position: absolute;height: 30px;width: 100%;background-color: #282828;top: 10px;opacity: 0.7; color: gold"><?php echo $fila1['nombre'] ?></div>
                        </div>
                    </a>
                    <?php
                }
            }else{
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                  <p class=\"centrar\"><strong>¡Hey!</strong> No se han encontrado coincidencias en su busqueda.</p>
              </div>";
            }
        }else{
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                  <p class=\"centrar\"><strong>¡Hey!</strong> Escribe el nombre de un producto o categoría.</p>
              </div>";
        }
        cerrarconexion();
        ?>
        <!-------img PRODUCTOS -------->

        <div class="limpiar"></div>
    </div>

    <!-- Footer-->
    <footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>

    <script type="text/javascript" src="clientes/inicio_sesion/inicio_sesion.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- JQuery UI -->

    </body>
    </html>
<?php
}
    ?>