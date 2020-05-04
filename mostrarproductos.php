<?php
include ("php/conexion.php");
//---------------------- PAGINADOR-------------------->

        $registros = mysqli_query($link,"select id_producto from productos WHERE id_categoria='$_GET[id_categoria]'") or die("Error al conectar con la tabla".mysqli_error($link));
        $total_registros = mysqli_num_rows($registros);

        $TAMAÑO_PAGINA = 4;
        $pagina = false;

        if (isset($_GET["pagina"])){$pagina = $_GET["pagina"];}

        if(!$pagina){
            $inicio = 0;
            $pagina = 1;
        }
        else {$inicio = ($pagina - 1) * $TAMAÑO_PAGINA;}

        $total_paginas = ceil($total_registros / $TAMAÑO_PAGINA);

//---------------------- PAGINADOR-------------------->

$registros0 = mysqli_query($link,"SELECT * FROM categorias order by categoria ASC ");

if (isset($_GET['name']) && $_GET['name'] == "mayorMenor"){
    $registros1 = mysqli_query($link,"select id_producto, precio from productos 
                                            WHERE id_categoria = '$_GET[id_categoria]' ORDER BY precio DESC LIMIT ".$inicio.","."$TAMAÑO_PAGINA");
}else{
    $registros1 = mysqli_query($link,"select id_producto, precio from productos 
                                            WHERE id_categoria = '$_GET[id_categoria]' ORDER BY precio ASC LIMIT ".$inicio.","."$TAMAÑO_PAGINA");
}

$registros3 = mysqli_query($link,"select categoria from categorias where id= '$_GET[id_categoria]'");
$fila3 = mysqli_fetch_array($registros3);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/normalizar.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Bootstrap-->
    <!-- Estilos MENU -->
    <link rel="stylesheet" href="menucss/menucss/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
    <!-- Estilos MENU -->

    <script type="text/javascript">
        function ordenarProductos(id) {
            var name = document.formOrdenar.selectOrdenar.value;
            location.href = "mostrarproductos.php?name="+name+"&id_categoria="+id;
        }
    </script>
</head>
<body>
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
                    <li class="topmenu"><a href="#">Acces</a></li>
                    <li class="topmenu"><a href="#">Register Now</a></li>
                </ul></li>
        </ul>
        <!-- MENU -->
    </nav>
</header>
<!----------------- PRODUCTOS ---------------->
<div class="main">
    <p class="fuente"><span style="color: dodgerblue">Inicio -> </span><?php echo $fila3['categoria'];?></p>
    <!------- FORM ORDENAR ------->
    <p><form name="formOrdenar">
        <select onchange="ordenarProductos(<?php echo $_GET['id_categoria']; ?>)" class="form-control" name="selectOrdenar">
            <option>Ordenar por...</option>
            <option value="menorMayor">Precio (menor a mayor) </option>
            <option value="mayorMenor">Precio (mayor a menor)</option>
        </select>
    </form></p>
    <!------- FORM ORDENAR ------->
    <!-------img PRODUCTOS -------->
    <?php while($fila1 = mysqli_fetch_array($registros1)) {
        $registros2 = mysqli_query($link,"select nombre from imagenes where id_producto = '$fila1[id_producto]' and prioridad = 1");
        $fila2 = mysqli_fetch_array($registros2)
        ?>
        <a href="detalleproducto.php?id_categoria=<?php echo $_GET['id_categoria'];?>&id_producto=<?php echo $fila1['id_producto'];?>">
            <div class="productosmain hvr-float-shadow">
                <img src="admin/productos/imagenes/<?php if(mysqli_num_rows($registros2) > 0) echo $fila2['nombre']; else echo "sinimagen.jpg"?>" width="100%" alt="portatil1">
                <div class="precio fuente">$<?php echo $fila1['precio']; ?> Pesos.</div>
            </div> <!-- el ancho al 100% de la imagen se adapta al 100% del div "productosmain"-->
        </a>
        <?php
    }
    cerrarconexion();
    ?>
    <!-------img PRODUCTOS -------->
    <div class="limpiar"></div>
</div>
<!----------------- PRODUCTOS ---------------->

<!--------------------BOTONES PAGINADOR------------------->
<div style="margin-top: 150px"><nav><?php
        if (isset($_GET['name'])){
            if ($total_paginas > 1){

                if($pagina != 1){echo '<a href = "mostrarproductos.php?name='.$_GET['name'].'&id_categoria='.$_GET['id_categoria'].'&pagina='.($pagina - 1).'"> Anterior </a>';}

                for ($i = 1; $i <= $total_paginas; $i++){
                    if ($pagina == $i){echo $pagina;} else {echo '<a href = "mostrarproductos.php?name='.$_GET['name'].'&id_categoria='.$_GET['id_categoria'].'&pagina='.$i.'">'.$i.' </a>';}
                }

                if ($pagina != $total_paginas){echo '<a href = "mostrarproductos.php?name='.$_GET['name'].'&id_categoria='.$_GET['id_categoria'].'&pagina='.($pagina + 1).'"> Siguiente </a>';}
            }
        }else{
            if ($total_paginas > 1){

                if($pagina != 1){echo '<a href = "mostrarproductos.php?id_categoria='.$_GET['id_categoria'].'&pagina='.($pagina - 1).'"> Anterior </a>';}

                for ($i = 1; $i <= $total_paginas; $i++){
                    if ($pagina == $i){echo $pagina;} else {echo '<a href = "mostrarproductos.php?id_categoria='.$_GET['id_categoria'].'&pagina='.$i.'">'.$i.' </a>';}
                }

                if ($pagina != $total_paginas){echo '<a href = "mostrarproductos.php?id_categoria='.$_GET['id_categoria'].'&pagina='.($pagina + 1).'"> Siguiente </a>';}
            }
        }


        echo '</p>'
        ?></nav></div>
<!--------------------BOTONES PAGINADOR------------------->

<!-- Footer-->
<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados onlineshop.com</p></footer>
</body>
</html>