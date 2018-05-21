

    $("#enviar").click(function(e){
        
        var nombreProyecto="";
        var nombreEncuesta="";
        var areaOntologia="";
        var objetivoOntologia="";
        var descripcion="";
        var nomArchivo="";
        var usuario="";

        nombreProyecto = ($('#nombreProyecto').val()).trim();
        nombreEncuesta = ($('#nombreEncuesta').val()).trim();
        areaOntologia = ($('#areaOntologia').val()).trim();
        objetivoOntologia = ($('#objetivoOntologia').val()).trim();
        descripcion = ($('#descripcion').val()).trim();
        nomArchivo = ($('#archivo').val()).trim();
        usuario= ($('#usuario').val()).trim();
        
        
        
        var camposVacios=true;//MODIFICAR, ponerle false

        if (nombreProyecto!="" && nombreEncuesta!=""&& areaOntologia!=""&& objetivoOntologia!=""&&  descripcion!="" && nomArchivo!="" && usuario!=""){
            camposVacios=false;
        }
        
        if (camposVacios==false){
            //LEER ARCHIVO

            //poner la variable "nomArchivo" en vez de "carreras.owl", esta directamente para pruebas 
            jOWL.load(nomArchivo, function(){ 
                
                //Consulta para obtener clases
                jOWL.SPARQL_DL("Class(?x)").execute({
                    onComplete : function(results) {
                        clases = results.jOWLArray("?x");
                        //console.log(clases);
                }});
                //Consulta para obtener ObjectProperty(relaciones), ejemplo: cursa, pertenece, etc
                jOWL.SPARQL_DL("ObjectProperty(?x)").execute({
                    onComplete : function(results) {
                        objProperty = results.jOWLArray("?x");
                }});
                //Consulta para obtener DatatypeProperty(los que son como atributos), ejemplo: estudianteID, estudianteNombre, etc
                jOWL.SPARQL_DL("DatatypeProperty(?x)").execute({
                    onComplete : function(results) {
                        dataProperty = results.jOWLArray("?x");
                }});
                
                //Llama a funcion para obtener Clases del objeto
                longitud = Object.keys(clases.items).length; //obtenemos la longitud del objeto
                var arrClases= [];//declaramos un arreglo
                arrClases=obtenerClases(longitud, clases);
                console.log(arrClases);

                //Llama a funcion para obtener ObjectProperty del objeto
                longitud = Object.keys(objProperty.items).length;
                var arrObjProperty= [];
                arrObjProperty=obtenerObjProperty(longitud, objProperty);
                console.log(arrObjProperty);
                
                //Llama a funcion para obtener DatatypeProperty del objeto
                longitud = Object.keys(dataProperty.items).length;
                var arrDataProperty= [];
                arrDataProperty=obtenerObjProperty(longitud, dataProperty);
                console.log(arrDataProperty);

                var parametros = { //se envian los arreglos y el nombre
                    'array1':JSON.stringify(arrClases),
                    'array2':JSON.stringify(arrObjProperty),
                    'nombreProyecto':nombreProyecto,
                    'nombreEncuesta':nombreEncuesta,
                    'objetivoOntologia':objetivoOntologia,
                    'descripcion':descripcion,
                    'areaOntologia': areaOntologia,
                    'usuario' : usuario
                };


                //ejecutamos una promesa
                var promiseGenerarEncuesta= new Promise(function(resolve, reject){ 
                    $.ajax({ //LLAVES DE AJAX
                        type: "POST",//se manda por metodo post
                        url: "generarEncuesta.php", //se manda a generar encuesta.php
                        data: parametros, //se mandan los datos de arriba

                        success: function(respuesta){
                            console.log('respuesta de generar encuesta: '+respuesta);
                            $("#encuesta li").remove();
                            //MOSTRAR ENCUESTA
                            var preguntas=JSON.parse(respuesta);
                            longitud = Object.keys(preguntas).length;
                            for (i = 0; i < longitud; i++){
                                $("#encuesta").append("<li>"+preguntas[i]+"</li>");
                            }
                            /*
                            if(respuesta==1){
                                document.getElementById('alert').className="alert alert-success";
                                $('#tituloMensaje').html('Exito! ');
                                $('#mensajes').html('¡Cambios guardados con éxito!'); 
                                
                            }else if (respuesta==0){
                                $('#mensajes').html('Ocurrió un error con la conexión.');
                                error();
                            }*/
                            resolve(true);
                        }
                    })
                });

                var parametros1 = { //se envian los arreglos y el nombre
                    'nombre': nomArchivo
                };
                //para borrar el archivo una vez generado
                promiseGenerarEncuesta.then(function(){
                    $.ajax({
                        type: "POST",//se manda por metodo post
                        url: "borrarArchivo.php", //se manda a generar encuesta.php
                        data: parametros1, //se mandan los datos de arriba
                        success: function(res){
                            
                        }
                    })
                });
            });
        } else {
            alert("ERROR, llenar todos los campos");
        }
    });

//FUNCIONES
function obtenerClases(longitud, clases){
    var arrClases= [];
    for (i = 0; i < longitud; i++){
        name = clases.items[i].name;
        arrClases.push(name);
    }
    return arrClases;
}

function obtenerObjProperty(longitud, objProperty){
    var arrObjProperty= [];
    for (i = 0; i < longitud; i++){
        domain = (objProperty.items[i].domain).split("#");
        range = (objProperty.items[i].range).split("#");
        name = objProperty.items[i].name;
        arrObjProperty.push([name,domain[1],range[1]]);
    }
    return arrObjProperty;
}

function obtenerObjProperty(longitud, dataProperty){
    var arrDataProperty= [];
    for (i = 0; i < longitud; i++){
        domain = (dataProperty.items[i].domain).split("#");
        range = (dataProperty.items[i].range).split("#");
        name = dataProperty.items[i].name;
        arrDataProperty.push([name,domain[1],range[1]]);
        //console.log(arrDataProperty[i]);
    }
    return arrDataProperty;
}