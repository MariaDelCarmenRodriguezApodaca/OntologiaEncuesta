<?php
    
    include('conexion.php');
    //Se obtienen los arreglos y se realizan las preguntas
                            //stripcslashes elimina las barras invertidas
    $clases = json_decode(stripcslashes($_POST['array1']));
    $objProperty = json_decode(stripcslashes($_POST['array2']));
    $areaOntologia = $_POST['areaOntologia'];
    $nombreProyecto = $_POST['nombreProyecto'];
    $nombreEncuesta=$_POST['nombreEncuesta'];
    $objetivoOntologia=$_POST['objetivoOntologia'];
    $descripcion = $_POST['descripcion'];
    $usuario = $_POST['usuario'];

    $i=0;
    $arrayPreguntas = array();
    

    $sql="SELECT AUTO_INCREMENT FROM information_schema.TABLES
    WHERE  TABLE_NAME = 'encuesta'";
    $result=mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($result);
    $id_encuesta= (integer) $row['AUTO_INCREMENT'];
    

    //se generan las preguntas con relacion a las clases
    foreach ($clases as $datos){
        array_push ($arrayPreguntas, 'El concepto "'.$datos.'" pertenece al area "'.$areaOntologia.'"');
    }
    foreach ($objProperty as $datos){
        array_push ($arrayPreguntas, 'Existe una relación entre "'.$datos[1].'" y "'.$datos[2].'"');
    }
    foreach ($objProperty as $datos){
        array_push ($arrayPreguntas, 'El tipo de relación entre "'.$datos[1].'" y "'.$datos[2].'" es "'.$datos[0].'"'); 
    }




    foreach($arrayPreguntas as $pregunta){
        $sql="INSERT INTO pregunta (id_pregunta, id_encuesta, descripcion, totalmente_desacuerdo, desacuerdo, ninguno, acuerdo, totalmente_acuerdo)
        VALUES (NULL, '".$id_encuesta."','".$pregunta."','0','0','0','0','0')";
        $result= mysqli_query($conexion, $sql);
    }

    
    //guardar los datos de la encuesta:
    $sql="INSERT INTO encuesta (id_encuesta,nombre_encuesta,nombre_proyecto,area_ontologia,objetivo_ontologia,descripcion,usuario,numero_respuestas) 
        VALUES (NULL, '".$nombreEncuesta."', '".$nombreProyecto."', '".$areaOntologia."', '".$objetivoOntologia."', '".$descripcion."', '".$usuario."' ,'0' )";
    if (mysqli_query($conexion, $sql)) {
        echo json_encode($arrayPreguntas);
    }

    
    
?>
