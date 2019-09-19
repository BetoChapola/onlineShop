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

    </head>
    <body>
    <div class="tcat">ACTUALIZAR CATEGORIA</div>
    <!-- Formulario-->
    <div class="formulario">
        <form method="post" action="editcategoria.php">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Categoria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $_GET['categoriavieja'] ?>" name="categorianueva">
                    <input type="hidden" name="categoriavieja" value="<?php echo $_GET['categoriavieja'] ?>"> <!-- otra manera de mandar datos, no es el metodo de la url-->
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="boton">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>
<?php }
else{header('location:../index.php');}
?>