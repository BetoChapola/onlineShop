//Ir a div_2 desde div_1
function goto_div2() {
    if($("#envio1").prop("checked") || $("#envio2").prop("checked")){
        $("#div_1").hide("slide",500,show_div2);
    }else {
        alert("Debe elegir una opción")
    }
}

function show_div2() {
    $("#div_2").show("slide",500);
}

//Ir a div_1 desde div_2
function goto_div1() {
    $("#div_2").hide("slide",500,show_div1);
}

function show_div1() {
    $("#div_1").show("slide",500);
}

//Ir a div_3 desde div_2
function goto_div3() {
    if($("#efectivo").prop("checked") || $("#transferencia").prop("checked") || $("#tarjeta").prop("checked") || $("#contrareembolso").prop("checked")){
        $("#div_2").hide("slide",500,show_div3);
    }else {
        alert("Debe elegir una opción")
    }
}
function show_div3() {
    $("#div_3").show("slide",500);

    /**Refrescamos la página para mostrar cualquier cambio **/
    $(function () {
        $.ajax({
            url:"mostrar_compra.php",

            success:function (resp) {
                $("#mostrar_compra").html(resp);
                $("#mostrar_compra").show("fast");
            }
        });
    })
}

//Ir a div_2 desde div_3
function goto_div2b() {
    $("#div_3").hide("slide",500,show_div2b);
}
function show_div2b() {
    $("#div_2").show("slide",500);
}

// ######################################################################################

// ------------- Sumar envío --------------  //
function sumar_envio() {
    $.ajax({
        type:"POST",
        url:"sumar_envio.php"
    })
}

// ------------- Restar envío --------------  //
function restar_envio() {
    $.ajax({
        type:"POST",
        url:"restar_envio.php"
    })
}

// ------------- Mostrar datos transferencia //
function datos_transfer() {
    $("#alert_transferencia").show("fast");
}

// ------------- Mostrar compra --------------  //
$(function () {
    $.ajax({
        url:"mostrar_compra.php",

        success:function (resp) {
            $("#mostrar_compra").html(resp);
            $("#mostrar_compra").show("fast");
        }
    });
})

// ------------- Eliminar compra --------------  //
function eliminar_producto(indice) {
    $.ajax({
        url:"../eliminar.php",
        data:{"indice":indice},

        success:function (resp) {
            $.ajax({
                url:"mostrar_compra.php",

                success:function (resp){
                    $("#mostrar_compra").html(resp);
                    $("#mostrar_compra").show("fast");
                }
            });
        }
    });
}

// ------------- Forma de pago --------------  //
function forma_pago(pago) {
    $.ajax({
        type:"POST",
        url:"forma_pago.php",
        data:{"pago":pago}
    })
}