<?php
session_start();
if (isset($_SESSION['id_cliente'])){header('location:zona_clientes/index.php');}
include ("../php/conexion.php");
$registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC");
$registros1 = mysqli_query($link,"select id_producto, precio, id_categoria from productos");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>

    <link rel="stylesheet" href="../iconos/css/font-awesome.min.css">
    <link rel="stylesheet" href="clientes.css">
    <link rel="stylesheet" href="../css/normalizar.css">
    <link rel="stylesheet" href="../css/hover-min.css">
    <link rel="stylesheet" href="../css/animate.min.css">

    <script src="css/wow.min.js"></script>
    <script>new WOW().init()</script>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap-->

    <!-- MENU -->
    <link rel="stylesheet" href="../menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- MENU -->

    <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
    <link rel="stylesheet" type="text/css" href="../engine1/style.css"/>
    <!-- End WOWSlider.com HEAD section -->



</head>

<body>
<header> <!-- Header-->
    <div class="cabecera"></div>
    <nav class="wow bounceInDown" data-wow-duration="1.5s">
        <input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
        <ul id="css3menu1" class="topmenu">
            <li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
            <li class="topmenu"><a class="pressed" href="#" style="width:224px;height:56px;line-height:56px;"><img src="../menucss/menucss/home.png" alt=""/>Home</a></li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../menucss/menucss/buy.png" alt=""/>Producto</a>

                <ul>
                    <?php while($fila0=mysqli_fetch_array($registros0)){ ?>
                        <li><a href="../mostrarproductos.php?id_categoria=<?php echo $fila0['id'];?>"><?php echo $fila0['categoria'];?></a></li>
                    <?php } ?>
                </ul>

            </li>
            <li class="topmenu"><a href="#" style="width:224px;height:56px;line-height:56px;"><img src="../menucss/menucss/contact.png" alt=""/>Contacto</a></li>
            <li class="toproot"><a href="#" style="width:223px;height:56px;line-height:56px;"><span><img src="../menucss/menucss/register.png" alt=""/>Privado</span></a>
                <ul>
                    <li class="topmenu"><a href="#">Acces</a></li>
                    <li class="topmenu"><a href="#">Register Now</a></li>
                </ul>
            </li>
        </ul>
    </nav> <!-- Menu-->
</header>

<!--------- ALERT CADUCADO ------>
<?php if(isset($_GET['alert']) && $_GET['alert'] == 'caducado'){?>
    <div class="alert alert-warning" role="alert" id="exito">
        <p class="centrar"><strong>¡Ups!</strong> Tu código de activación ha caducado, registrate nuevamente.</p>
    </div>
<?php }?>
<!--------- ALERT CADUCADO -------->

<div class="main">
    <form name="clienteForm" method="post">
        <div class="form-group" id="clienteNombre">
            <label>Nombre*</label>
            <input onkeypress="camposListos()" onkeyup="validadoNombre()" type="text" class="form-control" placeholder="Nombre(s)" name="nombre">
        </div>
        <div class="form-group" id="clienteApellido">
            <label>Apellido(s)*</label>
            <input onkeypress="camposListos()" onkeyup="validadoApellido()" type="text" class="form-control" placeholder="Apellido(s)" name="apellido">
        </div>
        <div class="form-group" id="clienteEmail">
            <label>Email*</label>
            <input onkeypress="camposListos()" onkeyup="validadoEmail()" type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-inline" style="margin-bottom: 10px">
            <div class="form-group">
                <label>Dirección*&nbsp;&nbsp;</label>
                <input onkeypress="camposListos()" onkeyup="validadoDireccion()" type="text" class="form-control" placeholder="Dirección" name="direccion">
            </div>
            <div class="form-group">
                <label>&nbsp;&nbsp;C.P.*&nbsp;&nbsp;</label>
                <input onkeypress="camposListos()" onkeyup="validadoCP()" type="text" class="form-control" placeholder="C.P." name="cp">
            </div>
            <div class="form-group">
                <label>&nbsp;&nbsp;Ciudad*&nbsp;&nbsp;</label>
                <select onchange="camposListos()" onclick="validadoCiudad()" class="form-control" name="ciudad">
                    <option value=""></option>
                    <option value="CC">Cancun</option>
                    <option value="DF">D.F.</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="clientePass1">
            <label>Password*</label>
            <input onkeypress="camposListos()" onblur="validadoPass1()" type="password" class="form-control" placeholder="Password" name="pass1">
        </div>
        <div class="form-group" id="clientePass2">
            <label>Confirmar Password*</label>
            <input onkeypress="camposListos()" onkeyup="validadoPass2()" type="password" class="form-control" placeholder="Password" name="pass2">
        </div>

        <div class="checkbox">
            <label>
                <input onclick="validadoPolitica()" type="checkbox" id="acepto" name="aceptar"> Acepto políticas de privacidad. <a href="#">Leer.</a>
            </label>
        </div>

        <button class="btn btn-primary" onclick="validar()" type="button">Enviar</button>
        <br><br>


        <!------- ALERTS ------->
        <div class="alert alert-danger ocultar" role="alert" id="avisomail">
            <p class="centrar"><strong>¡Wow!</strong> El formato del correo no es correcto.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="alertLlenar">
            <p class="centrar"><strong>¡Wow!</strong> Los campos con "*" deben ser llenados.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="alertPolitica">
            <p class="centrar"><strong>¡Wow!</strong> Debes aceptar las políticas.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="alertPass">
            <p class="centrar"><strong>¡Wow!</strong> El password debe coincidir.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="alertPass2">
            <p class="centrar"><strong>¡Wow!</strong> La contraseña debe tener 8 caracteres como mínimo, un número y no debe tener espacios en blanco.</p>
        </div>
        <div class="alert alert-success ocultar" role="alert" id="exito">
            <p class="centrar"><strong>¡Bien!</strong> El nuevo cliente se agrego correctamente. Para terminar tu registro
            haz revisa tu correo y sigue el link. De lo contrario tu registro se eliminara despues de 24 horas.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="emailrepetido">
            <p class="centrar"><strong>¡Wow!</strong> Este correo ya esta registrado.</p>
        </div>
        <div class="alert alert-danger ocultar" role="alert" id="noenviado">
            <p class="centrar"><strong>¡Wow!</strong> Se ha Presentado un problema con el servicio de correo,
                contacta al servicio a clientes.</p>
        </div>


    </form>
</div>


<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
</body>
<script type="text/javascript" src="clientes.js"></script>
</html>