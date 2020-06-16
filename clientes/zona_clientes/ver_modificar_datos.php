<?php
session_start();
include ("../../php/conexion.php");

if (isset($_SESSION['nombre_cliente'])) {
    $registros = mysqli_query($link,"select * from clientes WHERE id_cliente = '$_SESSION[id_cliente]'");
    $filas = mysqli_fetch_array($registros);
    ?>
    <div class="alert alert-success ocultar" role="alert" id="exito"style="margin-top: 15px">
        <p class="centrar"><strong>¡Bien!</strong> Tus datos se han actualizado.</p>
    </div>
    <div class="main">
    <form name="FormActualizarDatos" method="post">
        <div class="form-group" id="clienteNombre">
            <label>Nombre*</label>
            <input type="text" class="form-control" placeholder="Nombre(s)" name="nombre" value="<?php echo $filas['nombre'] ?>">
        </div>
        <div class="form-group" id="clienteApellido">
            <label>Apellido(s)*</label>
            <input type="text" class="form-control" placeholder="Apellido(s)" name="apellido" value="<?php echo $filas['apellido'] ?>">
        </div>
        <div class="form-group" id="clienteEmail">
            <label>Email*</label>
            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $filas['email'] ?>">
        </div>
        <div class="form-inline" style="margin-bottom: 10px">
            <div class="form-group">
                <label>Dirección*&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Dirección" name="direccion" value="<?php echo $filas['direccion'] ?>">
            </div>
            <div class="form-group">
                <label>&nbsp;&nbsp;C.P.*&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="C.P." name="cp" value="<?php echo $filas['cp'] ?>">
            </div>
            <div class="form-group">
                <label>&nbsp;&nbsp;Ciudad*&nbsp;&nbsp;</label>
                <select class="form-control" name="ciudad">
                    <option value="<?php echo $filas['ciudad']?>"><?php echo $filas['ciudad']?></option>
                    <option value="Cancun">Cancun</option>
                    <option value="D.F.">D.F.</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="clientePass1">
            <label>Password*</label>
            <input type="password" class="form-control" placeholder="Password" name="pass1" value="<?php echo $filas['password'] ?>">
        </div>
        <div class="form-group" id="clientePass2">
            <label>Confirmar Password*</label>
            <input type="password" class="form-control" placeholder="Password" name="pass2" value="<?php echo $filas['password'] ?>">
        </div>

        <button class="btn btn-primary" onclick="actualizar_datos()" type="button">Actualizar</button>
        <br>
        <div id="imgCarga2" align="center" class="ocultar"><img src="../../imagenes/cargando.gif" alt=""></div>
    </form>
</div>

<?php }

else if (!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])){
    $email = $_COOKIE["email_cliente"];
    $password = $_COOKIE["password_cliente"];
    $registros = mysqli_query($link,"select * from clientes
                              WHERE email = '$email' AND password = '$password'");
    if (mysqli_num_rows($registros) === 0){ header("location:../../index.php");}
    else {
        $filas = mysqli_fetch_array($registros);?>
        <div class="alert alert-success ocultar" role="alert" id="exito">
            <p class="centrar"><strong>¡Bien!</strong> Tus datos se han actualizado.</p>
        </div>
        <div class="main">
            <form name="FormActualizarDatos" method="post">
                <div class="form-group" id="clienteNombre">
                    <label>Nombre*</label>
                    <input type="text" class="form-control" placeholder="Nombre(s)" name="nombre" value="<?php echo $filas['nombre'] ?>">
                </div>
                <div class="form-group" id="clienteApellido">
                    <label>Apellido(s)*</label>
                    <input type="text" class="form-control" placeholder="Apellido(s)" name="apellido" value="<?php echo $filas['apellido'] ?>">
                </div>
                <div class="form-group" id="clienteEmail">
                    <label>Email*</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $filas['email'] ?>">
                </div>
                <div class="form-inline" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label>Dirección*&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" placeholder="Dirección" name="direccion" value="<?php echo $filas['direccion'] ?>">
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;C.P.*&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" placeholder="C.P." name="cp" value="<?php echo $filas['cp'] ?>">
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;Ciudad*&nbsp;&nbsp;</label>
                        <select class="form-control" name="ciudad">
                            <option value="<?php echo $filas['ciudad']?>"><?php echo $filas['ciudad']?></option>
                            <option value="Cancun">Cancun</option>
                            <option value="D.F.">D.F.</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="clientePass1">
                    <label>Password*</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass1" value="<?php echo $filas['password'] ?>">
                </div>
                <div class="form-group" id="clientePass2">
                    <label>Confirmar Password*</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass2" value="<?php echo $filas['password'] ?>">
                </div>

                <button class="btn btn-primary" onclick="actualizar_datos()" type="button">Actualizar</button>
                <br>
                <div id="imgCarga2" align="center" class="ocultar"><img src="../../imagenes/cargando.gif" alt=""></div>
            </form>

        </div>
   <?php }
    cerrarconexion();
}else {header("location:../../index.php");}
?>


