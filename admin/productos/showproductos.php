<?php
session_start();
?>
<?php
if (isset($_SESSION['administrador'])){

    include ("../../php/conexion.php");
    ?>

    <!doctype html>
    <html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Shop</title>

        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"> <!-- dns para font Ubuntu -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../css/estilos.css">
        <link rel="stylesheet" href="../../css/normalizar.css">
        <link rel="stylesheet" href="../admin.css">

        <!-- Bootstrap-->
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

        <!-- Bootstrap-->


        <script>
            function enchufe(id) {
                var name = document.getElementsByName(id)
                for(var i=0;i<name.length;i++){
                    if (name[i].checked){
                        name = name[i].value;
                    }
                }


                $.ajax({
                    type: "POST",
                    url: "interruptor.php",
                    data: {"id_producto":id,
                            "interruptor":name},

                    //antes de enviar (beforeSend) datos al servidor.
                    beforeSend:function () {
                        $("#carga").show("fast");
                    },
                    //cuando obtenemos exitosamente la respuesta del servidor
                    success:function (respuesta) {
                        $("#carga").hide("fast");
                        $("#divResultados2").html(respuesta);
                        $("#myModal2").modal("toggle");
                    }

                });
            }

            function modalVer(id){
                $.ajax({

                    type: 'POST',
                    url: 'verproducto.php',
                    data: 'idproducto='+id,

                    success: function (resp) {
                        $('#divResultados').html(resp);
                    }

                })
            }

            function eliminar(id) {
                if (confirm("¿eliminar?")){
                    $.ajax({
                        type: "POST",
                        url: "deleteproducto.php",
                        data: 'idproducto='+id
                    });

                    $("#"+id).hide("slow");
                }
            }
        </script>

    </head>

    <body>
    <!----------------------  CARGA.GIF  --------------------->
    <div class="ocultar absoluta" id="carga"><img src="../../imagenes/cargando3.gif"></div>
    <!----------------------  CARGA.GIF  --------------------->

    <div class="tcat">PRODUCTOS</div>
    <!------------------------  ALERT  ----------------------->
    <?php if(isset($_GET['alert'])){ ?><!-- Alert EXITO al añadir "exito"-->
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="exito"> <!-- Alert SE HA MODIFICADO EL producto -->
        <p class="centrar"><strong>¡Bien!</strong> Se ha modificado el artículo correctamente</p>
    </div>
    <?php } ?>
    <!------------------------  ALERT  ----------------------->

    <div class="showcategorias">
        <?php $total_productos = mysqli_query($link,"select count(*) as total from productos") or die("Error al conectar con la tabla".mysqli_error($link));
        $total_filas = mysqli_fetch_array($total_productos);
        ?>
        <p class="fuente"><span style="color: dodgerblue">Total: </span><?php echo $total_filas ['total']?> productos.</p>
        <!---------------------- PAGINADOR-------------------->
        <?php

        $registros = mysqli_query($link,"select id_producto from productos") or die("Error al conectar con la tabla".mysqli_error($link));
        $total_registros = mysqli_num_rows($registros);

        $TAMAÑO_PAGINA = 10;
        $pagina = false;

        if (isset($_GET["pagina"])){$pagina = $_GET["pagina"];}

        if(!$pagina){
            $inicio = 0;
            $pagina = 1;
        }
        else {$inicio = ($pagina - 1) * $TAMAÑO_PAGINA;}

        $total_paginas = ceil($total_registros / $TAMAÑO_PAGINA);

        $registros1 =mysqli_query($link,"select * from productos ORDER BY id_producto ASC LIMIT ".$inicio.","."$TAMAÑO_PAGINA")
        or die("Error al conectar con ls tabla".mysqli_error($link));

        ?>
        <!---------------------- PAGINADOR-------------------->

        <!------------------------ TABLA --------------------->
        <table class="table table-hover">
            <?php
            while($fila1=mysqli_fetch_array($registros1)){
                $registros2 = mysqli_query($link,"SELECT nombre from imagenes WHERE id_producto = '$fila1[id_producto]' and prioridad ='1'");
                $fila2 = mysqli_fetch_array($registros2);
                ?>

                <tbody>
                <tr id="<?php echo $fila1['id_producto']; ?>">
                    <!--<th scope="row"><?php echo $fila1['id_producto']; ?></th> -->
                    <td><img width="70px" src="imagenes/<?php
                        if (mysqli_num_rows($registros2) != 0){
                            echo ($fila2['nombre']);
                        }else{
                            echo "sin_imagen/sin_imagen.jpg";} ?>"></td>
                    <td><?php echo utf8_encode($fila1['nombre'])."<br>"; ?></td>
                    <td><button type="button" onclick="modalVer('<?php echo $fila1['id_producto'];?>')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Ver</button></td>
                    <td><a href="formeditproductos.php?idproducto=<?php echo $fila1['id_producto']?>"><button type="button" class="btn btn-success">Editar</button></a></td>
                    <td><a onclick="eliminar('<?php echo $fila1['id_producto']; ?>')"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
                    <!-- CheckBox -->
                        <?php
                        $registros3 = mysqli_query($link,"select inicio from productos where id_producto = '$fila1[id_producto]'");
                        $fila3 = mysqli_fetch_array($registros3);?>
                    <form>
                        <td><input type="radio" onclick="enchufe('<?php echo $fila1['id_producto']?>')" name="<?php echo $fila1['id_producto']?>" value="activado"<?php if ($fila3['inicio'] == 1){echo "checked";} ?>>On</td>
                        <td><input type="radio" onclick="enchufe('<?php echo $fila1['id_producto']?>')" name="<?php echo $fila1['id_producto']?>" value="desactivado"<?php if ($fila3['inicio'] == 0){echo "checked";} ?>>Off</td>
                    </form>
                    <!-- CheckBox -->
                </tr>
                </tbody>

                <?php
            }
            ?>
        </table>
        <!------------------------ TABLA --------------------->
    </div>

    <!--------------------BOTONES PAGINADOR------------------->
    <div style="margin-top: 150px"><nav><?php
            if ($total_paginas > 1){

                if($pagina != 1){echo '<a href = "showproductos.php?pagina='.($pagina - 1).'"> Anterior </a>';}

                for ($i = 1; $i <= $total_paginas; $i++){
                    if ($pagina == $i){echo $pagina;} else {echo '<a href = "showproductos.php?pagina='.$i.'">'.$i.' </a>';}
                }

                if ($pagina != $total_paginas){echo '<a href = "showproductos.php?pagina='.($pagina + 1).'"> Siguiente </a>';}
            }

            echo '</p>'
            ?></nav></div>
    <!--------------------BOTONES PAGINADOR------------------->

    <!------------------------  MODAL 1  ----------------------->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detalle del producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="divResultados"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!------------------------  MODAL 1  ----------------------->
    <!------------------------  MODAL 2  ----------------------->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Información:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="divResultados2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!------------------------  MODAL 2  ----------------------->
    </body>

    </html>
    <?php
    cerrarconexion();
}
else{header('location:../index.php');}
?>