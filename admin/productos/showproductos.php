<?php
session_start();
?>
<?php
if (isset($_SESSION['administrador'])){
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
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/normalizar.css">
    <link rel="stylesheet" href="../admin.css">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>

    <!-- Bootstrap-->


    <script>
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
    </script>

</head>

<body>
<div class="tcat">PRODUCTOS</div>
<?php if(isset($_GET['alert'])){ ?>
<!-- Alert EXITO al añadir "exito"-->
<div class="alert alert-success alert-dismissible fade show" role="alert" id="exito"> <!-- Alert SE HA MODIFICADO EL producto -->
    <p class="centrar"><strong>¡Bien!</strong> Se ha modificado el artículo correctamente</p>
</div>
<?php } ?>

<div class="showcategorias">

    <?php
    include ("../../php/conexion.php");
    $registros1 = mysqli_query($link,"SELECT * FROM productos order by nombre ASC");
    //cerrarconexion();
    ?>

    <table class="table table-hover">
        <!--<thead>
        <tr>
            <th scope="colgroup">ID</th>
            <th scope="col">Categoria</th>
            <th scope="colgroup">Acciones</th>
        </tr>
        </thead>-->

        <?php
        while($fila1=mysqli_fetch_array($registros1)){
            $registros2 = mysqli_query($link,"SELECT nombre from imagenes WHERE id_producto = '$fila1[id_producto]' and prioridad ='1'");

            $fila2 = mysqli_fetch_array($registros2);
            ?>

            <tbody>
            <tr id="<?php echo $fila1['id']; ?>">
                <th scope="row"><?php echo $fila1['id_producto']; ?></th>
                <td><img width="70px" src="imagenes/<?php
                    if (mysqli_num_rows($registros2) != 0){
                        echo utf8_encode($fila2['nombre']);
                    }else {echo "sin_imagen/sin_imagen.jpg";} ?>">
                </td>
                <td><?php echo utf8_encode($fila1['nombre'])."<br>"; ?></td>
                <td><button type="button" onclick="modalVer('<?php echo $fila1['id_producto'];?>')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Ver</button></td>
                <td><a href="formeditproductos.php?idproducto=<?php echo $fila1['id_producto']?>"><button type="button" class="btn btn-success">Editar</button></a></td>
                <td><a onclick="eliminar()"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
            </tr>
            </tbody>

            <?php
        }
        ?>
    </table>
</div>

<!-- Modal -->
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
                <div id="divResultados">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</body>
    </html>
<?php
    cerrarconexion();
}
else{header('location:../index.php');}
?>