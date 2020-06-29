function ver_modal_inicio() {
    $("#modal_inicio_sesion").modal("toggle");
}

function validar_sesion() {
    if (document.form_inicio_sesion.email.value ===""){
        document.form_inicio_sesion.email.style.border="1px solid red";
        $("#alertIncompleto").show("fast");
    }
    if (document.form_inicio_sesion.password.value ===""){
        document.form_inicio_sesion.password.style.border="1px solid red";
        $("#alertIncompleto").show("fast");
    }

    if (document.form_inicio_sesion.email.valule !== "" &&
        document.form_inicio_sesion.password.value !== ""){

        if ($("#recordar_checkbox").prop("checked")){
               var crear_cookie = true;
        }else {var crear_cookie = false;}

        var email = document.form_inicio_sesion.email.value;
        var password = document.form_inicio_sesion.password.value;

        $.ajax({
            type: "POST",
            url: "clientes/inicio_sesion/validar_inicio.php",
            data: {"email":email,
                   "password":password,
                   "crear_cookie":crear_cookie},

            beforeSend:function () {
                $("#alertIncompleto").hide("fast");
                $("#resultado").html("Espera...");
            },

            success:function (resp) {
                if (resp === "exito"){
                    $("#alertIncompleto").hide("fast");
                    $("#resultado").html("encontramos el usuario");
                    location.href="clientes/zona_clientes/"
                }

                if (resp === "fracaso"){
                    $("#alertIncompleto").hide("fast");
                    $("#resultado").html("No existe el usuario");
                    $("#modal_inicio_sesion").effect("shake",{times:2},1000); /*Jquery UI*/
                }
            }
        })

    }
}

function link_password() {
    $("#link_pass").toggle("fast");
}
function recuperar_password() {
    var email = document.form_olvido_password.email.value;

    $.ajax({
        type: "POST",
        url:"clientes/inicio_sesion/recuperar_password.php",
        data:{"email":email},

        beforeSend:function () {
            $("#resultado").html("Espera...");
        },

        success:function (resp) {
            if (resp === "exito"){
                $("#resultado").hide("fast");
                alert("Hemos enviado un correo con tu contraseña.");
            }

            if (resp === "fracaso"){
                $("#resultado").hide("fast");
                alert("Este correo no esta en la base de datos o no ha sido validado.");
            }
        }
    })
}

function emailValidado() {
    $("#alertfracaso").hide("fast");
    document.form_inicio_sesion.email.style.border="1px solid green";
}
function passwordValidado() {
    $("#alertfracaso").hide("fast");
    document.form_inicio_sesion.password.style.border="1px solid green";
}
