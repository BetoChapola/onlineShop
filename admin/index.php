<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"> <!-- dns para font Ubuntu -->
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/normalizar.css">
    <link rel="stylesheet" href="admin.css">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap-->

</head>
<body>
<div class="tadministrador">ADMINISTRACIÓN</div>
<!-- Formulario-->
<div class="formulario">
    <form method="post" action="validar.php">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">User</label> <!--en el ejemplo se usa name en vez de user-->
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="User" name="user"><!--en el ejemplo se usa name en vez de user-->
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pass">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <div class="form-check ajusteEspecial">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                        Remember me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="boton">Sign in</button><!--en el ejemplo original el boton no tiene el atributo name-->
            </div>
        </div>
    </form>
</div>
</body>
</html>