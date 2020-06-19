function volar() {
    $("#imgPrincipal").effect('transfer',{to:$('#carrito')},500, add_producto);
}

function add_producto() {
    $("#carrito").effect("bounce",1500);
    document.getElementById('player').play();

    var $cantidad = document.formCompra.cantidad_producto.value;
    var $nombre = document.formCompra.nombre_producto.value;
    var $precio =document.formCompra.precio_producto.value;

    $.ajax({
        type:"POST",
        url:"compra/mostrar_compra.php",
        data:{"cantidad_producto":$cantidad,
              "nombre_producto":$nombre,
              "precio_producto":$precio},

        success:function (resp) {
            $("#mostrar_compra").html(resp);
            $("#mostrar_compra").show("fast");
        }
    });
    /* Tambien se puede usar la sintáxis:
    * $("#elemento").load("ruta_del_archivo",data,callback);
    * $("#mostrar_compra").load("compra/mostrar_compra.php");
    * https://www.w3schools.com/jquery/jquery_ajax_load.asp*/
}

/*Esta función "$(function){}" se cargará al momento de cargar la página:.
* Lo que quiere decir, que cuando se cargue detalleproducto.php, se ejecutará esta función, y si ya existe
* una sesión creada ($SESSION['mi_carrito']) mostrará el contenido guardado en el array*/
$(function () {
    $.ajax({
        url:"compra/mostrar_compra.php",

        success:function (resp) {
            $("#mostrar_compra").html(resp);
            $("#mostrar_compra").show("fast");
        }
    });
});

function eliminar_producto(indice) {
    $.ajax({
        url:"compra/eliminar.php",
        data:{"indice":indice},

        success:function (resp) {
            $.ajax({
                url:"compra/mostrar_compra.php",

                success:function (resp){
                    $("#mostrar_compra").html(resp);
                    $("#mostrar_compra").show("fast");
                }
            });
        }
    });
}