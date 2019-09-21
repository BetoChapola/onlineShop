<?php
session_start();
include ("../../php/conexion.php");

if(isset($_SESSION['administrador']) && isset($_POST['nombreproducto'])){
    $nombre = utf8_decode($_POST['nombreproducto']);
    $precio = $_POST['precioproducto'];
    $descripcion = utf8_decode($_POST['descripcion']);
    $idcategoria = $_POST['selectcategoria'];

    $registros=mysqli_query($link,"SELECT nombre from productos WHERE nombre='$nombre'");

    if (mysqli_num_rows($registros)==0){

        //Subida de imagenes
        //IMAGEN 1
        if ($_FILES['imagen1']['size']!== 0){

            $ext = explode (".",$_FILES['imagen1']['name']);
            $extension = end($ext);
            $_FILES ['imagen1']['name'] = $nombre."_01.".$extension;

            $permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
            $limite_kb = 1000; //1024 bytes (1 kilobyte)

            if (in_array($_FILES['imagen1']['type'],$permitidos) &&
                         $_FILES['imagen1']['size'] <= $limite_kb * 1024){ // $limite_kb (1 kilobyte) * 1024 = 1 megabyte

                $ruta = "imagenes/".$_FILES['imagen1']['name'];
                $resultado = move_uploaded_file($_FILES['imagen1']['tmp_name'],$ruta);
            }else{echo "errorimagen";
                  exit();}
            //Analizando el código: si las condiciones para subir una imagén se cumplen, la siguiente instrucción del código es
            //agregar a la base de datos el producto. SI NO se cumplen las condiciones para agregar una imagen se devolverá "errorimagen" y
            //después el códgigo continuara con la query de agregar el producto por lo cual aunque no haya nada que agregar se devolvera "exito".
            //Entonces estariamos devolviendo 2 valores al mismo tiempo "errorimagen" y "exito", esto creara conflicto si estamos usando Ajax.
            //Para evitar eso debemos detener el programa y salir de la ejecucion del codigo con "exit();"
        }
        //IMAGEN 2
        if ($_FILES['imagen2']['size'] !==0){

            $ext = explode(".",$_FILES['imagen2']['name']);
            $extension = end($ext);
            $_FILES['imagen2']['name'] = $nombre."_02.".$extension;

            $permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
            $limite_kb = 1000; //1024 bytes (1 kilobyte)

            if (in_array($_FILES['imagen2']['type'],$permitidos) &&
                $_FILES['imagen2']['size'] <= $limite_kb * 1024){ // $limite_kb (1 kilobyte) * 1024 = 1 megabyte

                $ruta = "imagenes/".$_FILES['imagen2']['name'];
                $resultado = move_uploaded_file($_FILES['imagen2']['tmp_name'],$ruta);
            }else{echo "errorimagen";
                exit();}
        }
        //IMAGEN 3
        if ($_FILES['imagen3']['size'] !==0){

            $ext = explode(".",$_FILES['imagen3']['name']);
            $extension = end($ext);
            $_FILES['imagen3']['name'] = $nombre."_03.".$extension;

            $permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
            $limite_kb = 1000; //1024 bytes (1 kilobyte)

            if (in_array($_FILES['imagen3']['type'],$permitidos) &&
                $_FILES['imagen3']['size'] <= $limite_kb * 1024){ // $limite_kb (1 kilobyte) * 1024 = 1 megabyte

                $ruta = "imagenes/".$_FILES['imagen3']['name'];
                $resultado = move_uploaded_file($_FILES['imagen3']['tmp_name'],$ruta);
            }else{echo "errorimagen";
                exit();}
        }

        //Query para INSERTAR PRODUCTOS a la tabla
        mysqli_query($link,"insert into productos (nombre, precio, descripcion, id_categoria) VALUES ('$nombre','$precio','$descripcion','$idcategoria')");

        //Zona de llenado de la tabla IMAGENES
        $registros = mysqli_query($link,"SELECT id_producto from productos WHERE nombre = '$nombre'");
        $fila = mysqli_fetch_array($registros);
        //IMAGEN 1
        if ($_FILES['imagen1']['size'] !== 0){
            $nombreImagen = $_FILES['imagen1']['name'];
            mysqli_query($link,"insert into imagenes (nombre,prioridad,id_producto) VALUES ('$nombreImagen','1','$fila[id_producto]')");
        }
        //IMAGEN 2
        if ($_FILES['imagen2']['size'] !== 0){
            $nombreImagen = $_FILES ['imagen2']['name'];
            mysqli_query($link,"INSERT INTO imagenes (nombre, prioridad, id_producto) VALUES ('$nombreImagen','2','$fila[id_producto]')");
        }
        //IMAGEN 3
        if ($_FILES['imagen3']['size'] !== 0){
            $nombreImagen = $_FILES ['imagen3']['name'];
            mysqli_query($link,"INSERT INTO imagenes (nombre, prioridad, id_producto) VALUES ('$nombreImagen','3','$fila[id_producto]')");
        }

        cerrarconexion();
        echo "exito";



    }else {
        echo "repetido";
    };
}
else{
    header('location:../index.php');
}

//en el video 43 se enseña a usar el sleep y el beforesend() de ajax.