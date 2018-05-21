$(function(){
    var cantCorreos=0;
    $("#enviar").click(function(e){
        var descripcion="";
        var liga="";
        var nomEncuesta="";
        var area="";
        var objetivo="";
        var correo="";
        liga = $('#liga').val();
        nomEncuesta = $('#nomEncuesta').val();
        area = $('#area').val();
        objetivo = $('#objetivo').val();
        descripcion = $('#descripcion').val();
        correo = $('#correo').val();

        var correo = [];
        $("#lista li").each(function(){
            correo.push($(this).text());
        });
        var camposVacios=false;

        if (nomEncuesta.trim()!="" && descripcion.trim()!="" && area.trim()!="" && objetivo.trim()!="" && liga.trim()!="" && correo.length > 0){
            camposVacios=true;//MODIFICAR
        }

        var parametros = { //se envian los arreglos y el nombre
            'liga':liga,
            'nomEncuesta':nomEncuesta,
            'area': area,
            'objetivo': objetivo,
            'descripcion': descripcion,
            'correo': JSON.stringify(correo)
        };
        if (camposVacios==true){
            $.ajax({ //LLAVES DE AJAX
            type: "POST",
            url: "enviarEncuesta.php", 
            data: parametros,
            success: function(respuesta){
                alert(respuesta);
            }
        });
        } else {
            alert("ERROR, llenar todos los campos");
        }
    });
    $("#cancelar").click(function(e){
        window.location.href='../inicio.php';
    });
    $("#agregar").click(function(e){
        var txtcorreo = ($('#correo').val()).trim();
        if (txtcorreo!=""){
            $("#lista").append("<li>"+txtcorreo+"<input type='button' class='borrar' value='Eliminar' onClick='eliminar(this)'></li>");
            cantCorreos=cantCorreos+1;
            $('#correo').val("");
        }else{
            alert("No se puede agregar correo");
        }
        
    });
});
function eliminar(x){
    padre = x.parentNode;
    padre2 = padre.parentNode;
    padre2.removeChild(padre);
}