function ver_detalles(id_cliente,pedido) {
    $.ajax({
        type:"POST",
        url:"ver_detalles.php",
        data:{"id_cliente":id_cliente,"pedido":pedido},

        success:function (resp) {
            $("#divDetalles").html(resp);
        }
    })
}