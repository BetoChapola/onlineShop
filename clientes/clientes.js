function validar() {
    if (document.clienteForm.nombre.value===""){
        document.clienteForm.nombre.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }
    if (document.clienteForm.apellido.value===""){
        document.clienteForm.apellido.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }

    if (document.clienteForm.email.value===""){
        document.clienteForm.email.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }

    if (document.clienteForm.direccion.value===""){
        document.clienteForm.direccion.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }
    if (document.clienteForm.cp.value===""){
        document.clienteForm.cp.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }
    if (document.clienteForm.ciudad.value===""){
        document.clienteForm.ciudad.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }

    if (document.clienteForm.pass1.value===""){
        document.clienteForm.pass1.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }
    if (document.clienteForm.pass2.value===""){
        document.clienteForm.pass2.style.border="1px solid red";
        $("#alertLlenar").show("fast");
    }

    if (!$("#acepto").prop("checked")){
        $("#alertPolitica").show("fast");
    }

    //Enviar datos:
    if (document.clienteForm.nombre.value!=="" &&
        document.clienteForm.apellido.value!=="" &&
        document.clienteForm.email.value!=="" &&
        document.clienteForm.direccion.value!=="" &&
        document.clienteForm.cp.value!=="" &&
        document.clienteForm.ciudad.value!=="" &&
        document.clienteForm.pass1.value!=="" &&
        document.clienteForm.pass2.value!==""){

        if ($("#acepto").prop("checked")){

            if(validadoEmail() && validadoPass1() & validadoPass2()){
                var nombre = document.clienteForm.nombre.value;
                var apellido = document.clienteForm.apellido.value;
                var email = document.clienteForm.email.value;
                var direccion = document.clienteForm.direccion.value;
                var cp = document.clienteForm.cp.value;
                var ciudad = document.clienteForm.ciudad.value;
                var password = document.clienteForm.pass1.value;

                $.ajax({
                    type: "POST",
                    url: "registroclientes.php",
                    data: {"nombre":nombre,
                        "apellido":apellido,
                        "email":email,
                        "direccion":direccion,
                        "cp":cp,
                        "ciudad":ciudad,
                        "password":password},

                    success:function(resp) {
                        if (resp==="exito"){
                            $("#exito").show("fast");
                            $("#emailrepetido").hide("fast");
                        }

                        if (resp==="emailrepetido"){
                            $("#exito").hide("fast");
                            $("#emailrepetido").show("fast");
                        }

                        if (resp==="noenviado"){
                            $("#noenviado").show("fast");
                        }
                    }

                })
            }
        }
    }
}

function validadoNombre() {
    document.clienteForm.nombre.style.border="1px solid green";
}
function validadoApellido() {
    document.clienteForm.apellido.style.border="1px solid green";
}
function validadoEmail() {
    var correo=document.clienteForm.email.value;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (expr.test(correo) ){

        document.clienteForm.email.style.border="1px solid green";
        $("#avisomail").hide("fast");
        return true;

    }

    else{

        document.clienteForm.email.style.border="1px solid red";
        $("#avisomail").show("fast");
        return false;

    }
}
function validadoDireccion() {
    document.clienteForm.direccion.style.border="1px solid green";
}
function validadoCP() {
    document.clienteForm.cp.style.border="1px solid green";
}
function validadoCiudad() {
    document.clienteForm.ciudad.style.border="1px solid green";
}
function validadoPass1() {
    var pass_largo = true;
    var sin_espacio = true;
    var tiene_numero = false;
    var pass = document.clienteForm.pass1.value;
    var total_caracteres = pass.length;
    var i = 0;

    if(total_caracteres<8){pass_largo = false;}

    for (i; i<total_caracteres; i++){
        if(pass.charAt(i) == " "){sin_espacio = false;}

        if(pass.charAt(i) == "0" || pass.charAt(i) == "1" || pass.charAt(i) == "2"||
            pass.charAt(i) == "3" || pass.charAt(i) == "4" || pass.charAt(i) == "5" ||
            pass.charAt(i) == "6" || pass.charAt(i) == "7" || pass.charAt(i) == "8" ||
            pass.charAt(i) == "9"){ tiene_numero = true;}
    }

    if (!pass_largo || !sin_espacio || !tiene_numero){
        $("#alertPass2").show("fast");
        return false;
    }else {
        $("#alertPass2").hide("fast");
        document.clienteForm.pass1.style.border="1px solid green";
        return true;
    }
}

function validadoPass2() {
    if (document.clienteForm.pass1.value !== document.clienteForm.pass2.value){
        document.clienteForm.pass2.style.border="1px solid red";
        $("#alertPass").show("fast");
        return false;
    }else{
        document.clienteForm.pass2.style.border="1px solid green";
        $("#alertPass").hide("fast");
        return true;
    }
}
function validadoPolitica() {
    if ($("#acepto").prop("checked")){
        $("#alertPolitica").hide("fast");
    }
}

function camposListos() {
    if (document.clienteForm.nombre.value!=="" &&
        document.clienteForm.apellido.value!=="" &&
        document.clienteForm.email.value!=="" &&
        document.clienteForm.direccion.value!=="" &&
        document.clienteForm.cp.value!=="" &&
        document.clienteForm.ciudad.value!=="" &&
        document.clienteForm.pass1.value!=="" &&
        document.clienteForm.pass2.value!==""){
        $("#alertLlenar").hide("fast");
    }
}
