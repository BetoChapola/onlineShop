function ver_modificar_datos() {
    $("#botones").animate({margin:"-20px auto 0px auto"},"fast");

    $.ajax({
        url:"ver_modificar_datos.php",

        beforeSend:function () {
            $("#cargaImagen").show("fast");
        },

        success:function (resp) {
            $("#cargaImagen").hide("fast");
            $("#div_ver_pedidos").hide("fast");
            $("#div_respuesta").html(resp);
            $("#div_respuesta").show("fast");
        }
    })
}

function ver_pedidos() {
    $("#botones").animate({margin:"-20px auto 0px auto"},"fast");

    $.ajax({
        url:"ver_pedidos.php",

        beforeSend:function () {
            $("#cargaImagen").show("fast");
        },

        success:function (resp) {
            $("#cargaImagen").hide("fast");
            $("#div_respuesta").hide("fast");

            $("#div_ver_pedidos").html(resp);

            $("#div_ver_pedidos").show("fast");
            $("#accordion").accordion({heightStyle:"content"}); //JQuery Ui Accordion
        }
    })
}

/*Para entender el funcionamiento de este script tenemos que saber los siguiente:
*
* clientes -> zona_clientes -> index.php, incluye el archivo vista_index.php
* Que a su vez incluye el script zona_clientes.js (vista_index.php incluye zona_clientes.js)
* Por eso no hay necesidad de crear un nuevo script para las funciones de ver_modificar_datos.php*/

function actualizar_datos() {
    var nombre = document.FormActualizarDatos.nombre.value;
    var apellido = document.FormActualizarDatos.apellido.value;
    var email = document.FormActualizarDatos.email.value;
    var direccion = document.FormActualizarDatos.direccion.value;
    var cp = document.FormActualizarDatos.cp.value;
    var ciudad = document.FormActualizarDatos.ciudad.value;
    var password = document.FormActualizarDatos.pass1.value;

    $.ajax({
        type: "POST",
        url: "actualizar_datos.php",
        data: {"nombre": nombre,"apellido": apellido,
               "email": email, "direccion": direccion,
               "cp": cp, "ciudad": ciudad, "password":password},
        
        beforeSend: function () {
            $("#exito").hide("fast");
            $("#imgCarga2").show("slow");
        },
        
        success: function () {
            $("#imgCarga2").hide("fast");
            $("#exito").show("fast");
        }
    })
}

