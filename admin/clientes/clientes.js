function eliminar(id) {
    if (confirm("¿eliminar?")){
        $.ajax({
            type: "POST",
            url: "eliminar_clientes.php",
            data: 'idcliente='+id,
            
            success:function (resp) {
                if (resp === "exito"){
                    /**location.reload();  Este método sirve para recargar la página.**/
                    $("#exito").show("fast");
                }
            }
        });

        $("#"+id).hide("slow");
    }
}