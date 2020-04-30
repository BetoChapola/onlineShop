<?php
session_start();
?>
<?php
if (isset($_SESSION['administrador'])){
?>

<!doctype html>
<html lang="en">
<head>

    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
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
        function eliminar(id) {
            if (confirm("Se eliminará la categoría con TODOS los producto, ¿eliminar?")){
                //location.href="deletecategoria.php?idcategoria="+id;
                $.ajax({
                    type: "POST",
                    url: "deletecategoria.php",
                    data: 'idcategoria='+id
                });

                $("#"+id).hide("slow");
            }
        }
    </script>

</head>
<body>

<!-- Alerts -->

<?php  if (isset($_GET['alert'])) {
    $alert = $_GET['alert'];
    switch ($alert){


        case 1: ?>
        <div class="alert alert-success" role="alert"> <!-- Alert 1: SE HA AÑADIDO EL ARTICULO-->
            <p class="centrar"><strong>¡Bien!</strong> Se ha añadido el artículo
                <strong><?php echo ($_GET['categoria']) ?></strong></p>
        </div>
        <?php
        break;

        case 2: ?>
        <div class="alert alert-warning" role="alert"> <!-- Alert 2: DEBES AÑADIR UNA CATEGORIA-->
            <p class="centrar"><strong>¡Ups!</strong> Debes añadir una categoría.</p>
        </div>
        <?php
         break;

        case 3: ?>
        <div class="alert alert-danger" role="alert"> <!-- Alert 3: LA CATEGORIA YA EXISTE-->
            <p class="centrar"><strong>¡Mira!</strong> La categoría ya existe.</p>
        </div>
        <?php
         break;

        case 4: ?>
        <div class="alert alert-success" role="alert"> <!-- Alert 4: SE MODIFICO LA CATEGORA-->
            <p class="centrar"><strong>¡Bien!</strong> Modificaste <strong><?php echo ($_GET['categoriavieja']) ?>
                </strong> por <strong><?php echo ($_GET['categorianueva']) ?></strong></p>
        </div>
        <?php
            break;

        case 5: ?>
        <div class="alert alert-danger" role="alert"> <!-- Alert 5: NO SE ACTUALIZO NINGUNA CATEGORIA-->
            <p class="centrar"><strong>¡Oye!</strong> No se ha actualizado ninguna categoría.</p>
        </div>
        <?php
            break;
    }
}?>

<?php // if (isset($_GET['alert'])) {
//
//    if ($_GET['alert'] == 1) { ?>
<!--        <div class="alert alert-success" role="alert"> <!-- Alert 1-->
<!--            <p class="centrar"><strong>¡Bien!</strong> Se ha añadido el artículo-->
<!--                <strong>--><?php //echo utf8_encode($_GET['categoria']) ?><!--</strong></p>-->
<!--        </div>-->
<!--        --><?php
//    }elseif ($_GET['alert'] == 2){ ?>
<!--        <div class="alert alert-warning" role="alert"> <!-- Alert 2-->
<!--            <p class="centrar"><strong>¡Ups!</strong> Debes añadir una categoría.</p>-->
<!--        </div>-->
<!--        --><?php
//    }elseif ($_GET['alert'] == 3){ ?>
<!--        <div class="alert alert-danger" role="alert"> <!-- Alert 3-->
<!--            <p class="centrar"><strong>¡Mira!</strong> La categoría ya existe.</p>-->
<!--        </div>-->
<!--        --><?php
//    }elseif ($_GET['alert'] == 4){ ?>
<!--        <div class="alert alert-success" role="alert"> <!-- Alert 4-->
<!--            <p class="centrar"><strong>¡Bien!</strong> Modificaste <strong>--><?php //echo utf8_encode($_GET['categoriavieja']) ?>
<!--                </strong> por <strong>--><?php //echo utf8_encode($_GET['categorianueva']) ?><!--</strong></p>-->
<!--        </div>-->
<!--        --><?php
//    }elseif ($_GET['alert'] == 5){ ?>
<!--        <div class="alert alert-danger" role="alert"> <!-- Alert 5-->
<!--            <p class="centrar"><strong>¡Oye!</strong> No se ha actualizado ninguna categoría.</p>-->
<!--        </div>-->
<!--        --><?php
//    }
//}?>

<div class="tcat">AÑADIR CATEGORIA</div>
<!-- Formulario-->
<div class="formulario">

    <form method="post" action="addcategoria.php">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Categoria</label> <!--en el ejemplo se usa name en vez de user-->
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Categoria" name="categoria"><!--en el ejemplo se usa name en vez de user-->
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="boton">Añadir</button><!--en el ejemplo original el boton no tiene el atributo name-->
            </div>
        </div>
    </form>
</div>

<!-- TABAL DE CATEGORIAS-->
<div class="showcategorias">

    <?php
    include ("../../php/conexion.php");
    $registros = mysqli_query($link,"SELECT * FROM categorias order by id DESC ");
    cerrarconexion();
    ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="colgroup">ID</th>
            <th scope="col">Categoria</th>
            <th scope="colgroup" align="center">Acciones</th>
        </tr>
        </thead>

        <?php
        while($fila=mysqli_fetch_array($registros)){ ?>

        <tbody>
        <tr id="<?php echo $fila['id']; ?>">
            <th scope="row"><?php echo $fila['id']; ?></th>
            <td><?php echo ($fila['categoria'])."<br>"; ?></td>
            <td><a href="formeditcategoria.php?categoriavieja=<?php echo $fila['categoria']; ?>">
                    <button type="button" class="btn btn-success">Editar</button>
                </a>
            </td>
            <td><a onclick="eliminar('<?php echo $fila['id']; ?>')">
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </a>
            </td>
        </tr>
        </tbody>

            <?php
        }
        ?>
    </table>

</div>

</body>
</html>
<?php }
else{header('location:../index.php');}
?>

