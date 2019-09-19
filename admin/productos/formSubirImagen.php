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


    <div class="tcat">AÑADIR PRODUCTO</div>
    <!-- Formulario-->
    <div class="formulario">
        <!-- estructura del form -->
        <form enctype="multipart/form-data" action="subirImagen.php" method="post" name="formproductos">

            <!-- campo imagenes -->
            <div style="margin-top: 40px;" id="imagenes">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Imagen 1 (principal)</label>
                        <input type="file" class="form-control-file" name="imgform">
                    </div>
            </div>
            <!-- boton añadir -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="boton">Añadir</button><!--  -->
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>