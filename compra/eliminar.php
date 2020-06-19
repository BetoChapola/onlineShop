<?php
session_start();

/**  **/
$restar = $_SESSION['mi_carrito'][$_GET['indice']]['precio']*$_SESSION['mi_carrito'][$_GET['indice']]['cantidad'];

$_SESSION['total'] = $_SESSION['total'] - $restar;
array_splice($_SESSION['mi_carrito'],$_GET['indice'],1);

/** array_splice();
(PHP 4, PHP 5, PHP 7)

array_splice — Elimina una porción del array y la reemplaza con otra cosa

array_splice ( array &$input , int $offset [, int $length = 0 [, mixed $replacement = array() ]] ) : array

https://manuales.guebs.com/php/function.array-splice.html
https://www.w3schools.com/php/func_array_splice.asp
https://www.php.net/manual/es/function.array-splice.php
 **/