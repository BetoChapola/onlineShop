<?php

$carpeta = "imagenes/";
opendir($carpeta);

$destino = $carpeta.$_FILES['imgform']['name'];
copy($_FILES['imgform']['tmp_name'],$destino);

echo "Exito";