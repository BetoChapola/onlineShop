<?php
session_start();

if(!isset($_SESSION['envio'])){
    $_SESSION['envio'] = 3;
    $_SESSION['total'] = $_SESSION['total'] + 3;

    //Le sumamos 3 solo para el ejercicio. En realidad debe ser la cantidad sin IVA.
}