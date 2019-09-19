<?php
session_start();
include ("../../php/conexion.php");
$registros=mysqli_query($link,'select * from categorias ORDER BY id DESC');
cerrarconexion();
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
        //Muestra los campos para agregar imagenes
        function mostrar() {
            $("#imagenes").show("fast");
        }
        //COMPRUEBA QUE LOS CAMPOS TENGAN CONTENIDO, DE NO SER ASI MANDA UN ALERT
        function validarform(){
            if(document.formproductos.nombreproducto.value===""){
                $("#alertnombre").show("fast");
                document.formproductos.nombreproducto.style.border="1px solid red";
            }
            if(document.formproductos.precioproducto.value===""){
                $("#alertprecio").show("fast");
                document.formproductos.precioproducto.style.border="1px solid red";
            }
            if(document.formproductos.descripcion.value===""){
                $("#alertdescripcion").show("fast");
                document.formproductos.descripcion.style.border="1px red solid";
            }
            if(document.formproductos.selectcategoria.value===""){
                $("#alertcategoria").show("fast");
                document.formproductos.selectcategoria.style.border="1px solid red";
            }

            if (document.formproductos.nombreproducto.value!=="" &&
                document.formproductos.precioproducto.value!=="" &&
                document.formproductos.descripcion.value!=="" &&
                document.formproductos.selectcategoria.value!==""){

                var nombrefr = document.formproductos.nombreproducto.value;
                var preciofr = document.formproductos.precioproducto.value;
                var descripcionfr = document.formproductos.descripcion.value;
                var idcategoriafr = document.formproductos.selectcategoria.value;

                $.ajax({
                    type: "POST",
                    url: "addproductos.php",
                    data: {nombreproducto:nombrefr, //a:b la variable "a" pertenece al argumento que recibe el archivo addproductos,
                           precioproducto:preciofr, //y el valor "b" es el valor que se envia por metodo POST desde el archivo formaddproductos.
                           descripcion:descripcionfr, //para AGREGAR OTRO ELEMENTO EN AJAX SE USA "," EL ";" ES PARA TERMINAR OTRO BLOQUE DE INSTRUCCION
                           selectcategoria:idcategoriafr},
                    
                    success:function (resp) {
                        $("#repetido").hide("fast");
                        $("#exito").hide("fast");

                        if (resp==="exito"){
                            $("#repetido").hide("fast");
                            $("#exito").show("slow");
                        }

                        if (resp==="repetido"){
                            $("#exito").hide("fast");
                            $("#repetido").show("slow");
                        }
                    }


                })
            }
        }

        //ZONA DE VALIDACION, DESAPARECE EL ALERT QUE SE GENERA CUANDO EL CAMPO NO CONTIENE NADA (SE NECESITA INGRESAR ALGO EN EL CAMPO)
        function nombrevalidado() {
            $("#alertnombre").hide("slow");
            document.formproductos.nombreproducto.style.border="1px solid green";
        }
        function preciovalidado() {
            $("#alertprecio").hide("slow");
            document.formproductos.precioproducto.style.border="1px solid green";
        }
        function descripcionvalidada() {
            $("#alertdescripcion").hide("slow");
            document.formproductos.descripcion.style.border="1px solid green";
        }

    </script>

</head>
<body>


<div class="tcat">AÑADIR PRODUCTO</div>
<!-- Formulario-->
<div class="formulario">
    <!-- estructura del form -->
    <form name="formproductos" method="post" action="addproductos.php" enctype="multipart/form-data">
        <!-- campo producto -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Producto</label>
            <div class="col-sm-10">
                <input onkeypress="nombrevalidado()" type="text" class="form-control" id="inputEmail3" placeholder="Nombre del Producto" name="nombreproducto">
            </div>
        </div>
        <div class="alert alert-warning ocultar" role="alert" id="alertnombre"> <!-- Alert: PRODUCTO-->
            <p class="centrar"><strong>¡Ups!</strong> Debes añadir un producto.</p>
        </div>
        <!-- campo precio -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-10">
                <input onkeypress="preciovalidado()" type="float" class="form-control" id="inputEmail3" placeholder="Precio del Producto" name="precioproducto">
            </div>
        </div>
        <div class="alert alert-warning ocultar" role="alert" id="alertprecio"> <!-- Alert: PRECIO-->
            <p class="centrar"><strong>¡Ups!</strong> Debes añadir un precio.</p>
        </div>
        <!-- Campo descripcion -->
        <div class="form-group row">
            <label for="Textarea1" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <textarea class="form-control" onkeyup="descripcionvalidada()" id="Textarea1" rows="3" placeholder="Descripción del producto" name="descripcion"></textarea>
            </div>
        </div>
        <!-- Alert descripcion-->
        <div class="alert alert-warning ocultar" role="alert" id="alertdescripcion">
            <p class="centrar"><strong>¡Ups!</strong> Debes añadir una descripción.</p>
        </div>
        <!-- Campo categoria -->
        <div class="form-group row">
            <label for="FormControlSelect1" class="col-sm-2 col-form-label">Categoría</label>
            <div class="col-sm-10">
                <select class="form-control" id="FormControlSelect1" name="selectcategoria">
                    <?php while ($fila=mysqli_fetch_array($registros)){ ?>
                        <option value="<?php echo $fila['id'] ?>"><?php echo utf8_encode($fila['categoria']); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- boton añadir imagenes -->
        <div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button onclick="mostrar()" type="button" class="btn btn-success" name="boton">Añadir imagenes</button><!--  -->
                </div>
            </div>
        </div>
        <!-- campo imagenes -->
        <div style="margin-top: 40px; display: none;" id="imagenes">

                <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 1 (principal)</label>
                    <input type="file" class="form-control-file" name="imagen1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 2 (secundaria)</label>
                    <input type="file" class="form-control-file" name="imagen2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 3 (secundaria)</label>
                    <input type="file" class="form-control-file" name="imagen3">
                </div>

        </div>
        <!-- Alert categoría-->
        <div class="alert alert-warning ocultar" role="alert" id="alertcategoria">
            <p class="centrar"><strong>¡Ups!</strong> Debes seleccionar una categoría. <strong><a target="_blank" href="../categorias/formaddcategoria.php">Añadir categoría</a></strong></p>
        </div>

        <!-- boton añadir -->
        <div class="form-group row">
            <div class="col-sm-10">
                <button onclick="validarform()" type="submit" class="btn btn-primary" name="boton">Añadir</button><!--  -->
            </div>
        </div>

        <!-- Alert EXITO al añadir "exito"-->
        <div class="alert alert-success ocultar" role="alert" id="exito"> <!-- Alert SE HA AÑADIDO EL producto -->
            <p class="centrar"><strong>¡Bien!</strong> Se ha añadido el artículo correctamente</p>
        </div>
        <!-- Alert el producto ya existe "repetido"-->
        <div class="alert alert-warning ocultar" role="alert" id="repetido"> <!-- Alert el producto ya existe -->
            <p class="centrar"><strong>¡Ups!</strong> El articulo ya existe</p>
        </div>
    </form>
</div>


</body>
    </html>
<?php }
else{header('location:../index.php');}
?>

