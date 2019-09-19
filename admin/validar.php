<?php
session_start(); //Iniciamos una sesion

//1)Este es el codigo del ejercicio original
//if ($_POST['user']=="admin" && $_POST['pass']=="123"){
//    echo "Hola";
//}else{header('location:index.php');}

//2)Este es el codigo utilizando la funcion isset, no es el original pero funciona.
//if (isset($_POST['boton'])){
//    echo "Hola ".$_POST['user'];
//}

//3)Este ejemplo hace uso de los dos ejemplos anteriores
//if (isset($_POST['boton']) && $_POST['user'] && $_POST['pass']){
//
//    if ($_POST['user']=="admin" && $_POST['pass']=="123"){
//
//        $_SESSION['administrador']=$_POST['user'];
//
//        if (isset($_SESSION['administrador'])){
//            echo "Hola ".$_SESSION['administrador'];
//        }
//
//    }else{echo "Incorrecto";}
//}else{header("location:index.php");}

//4) Variante del codigo original (video 18)

if (!isset($_SESSION['administrador'])){//Si no esta definida la session de administrador
    if (isset($_POST['boton']) && $_POST['user'] && $_POST['pass']){//verificar SI se pulsa el "boton" y si estan definidas las variables "user" y "pass"
        if ($_POST['user']=="admin" && $_POST['pass']=="123"){//SI estan definidas entonces, validar que user=admin y pass=123
            $_SESSION['administrador']=$_POST['user'];//Si la validacion es correcta entonces iniciar session
            if (isset($_SESSION['administrador'])){//Si la session es administrador entonces:
                echo "Hola ".$_SESSION['administrador']."<br>";//imprimir Hola admin
                echo "<a href='categorias/formaddcategoria.php?'>Categorías</a><br>";
                echo "<a href='productos/formaddproductos.php'>Productos</a>";
            }
        }else{echo "incorrecta";}//Si el user y pass son incorrectos, entonces
    }else{header("location:index.php");}//Si uno de los campos o los dos estan vacios entonces, redirigir al formulario.
}