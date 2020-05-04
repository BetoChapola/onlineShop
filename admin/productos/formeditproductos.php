<?php
session_start();

if (isset($_SESSION['administrador']) && $_GET['idproducto'] != ""){
    include ("../../php/conexion.php");
    $registros = mysqli_query($link,"SELECT id_producto,nombre,precio,descripcion FROM productos WHERE id_producto= '$_GET[idproducto]'");
    $filas = mysqli_fetch_array($registros);
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

</head>
<body>

<div class="tcat">EDITAR PRODUCTO</div>
<div class="formulario">
    <form method="post" action="editproductos.php">
        <!-- campo producto -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Producto</label>
            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputEmail3" placeholder="Nombre del Producto" name="nombreproducto" value="<?php echo utf8_encode($filas['nombre']); ?>">
            </div>
        </div>
        <!-- campo precio -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-10">
                <input type="float" class="form-control" id="inputEmail3" placeholder="Precio del Producto" name="nuevoprecio" value="<?php echo $filas['precio']; ?>">
            </div>
        </div>
        <!-- Campo descripcion -->
        <div class="form-group row">
            <label for="Textarea1" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="Textarea1" rows="3" placeholder="Descripción del producto" name="nuevadescripcion"><?php echo utf8_encode($filas['descripcion']); ?></textarea>
            </div>
        </div>

        <input type="hidden" name='id_producto' value="<?php echo $filas['id_producto']; ?>">

        <!-- BOTON añadir -->
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="boton">Actualizar</button>
            </div>
        </div>
    </form>
</div>

</body>
    </html>

<?php
    cerrarconexion();
}
else{header('location:../index.php');}
?>
