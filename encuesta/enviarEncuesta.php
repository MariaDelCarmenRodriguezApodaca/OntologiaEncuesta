<?php
    session_start();
    include '../conexion.php';     
    if(isset($_SESSION['user'])) {
        $liga = $_POST['liga'];
        $nomEncuesta = $_POST['nomEncuesta'];
        $area = $_POST['area'];
        $objetivo = $_POST['objetivo'];
        $descripcion = $_POST['descripcion'];

        //ENVIAR CORREO
        $correo = json_decode(stripcslashes($_POST['correo']));
        $para="";
        $x=1;
        
        foreach ($correo as $datos){
            if (count($correo) == $x){
                $para .= $datos;
            }else {
                $para .= $datos.", ";
            }
            $x++;
        }
    
        // título
        $título = 'Evaluar ontologia: '.$nomEncuesta;

        // Mensaje
        $mensaje='
        <html>
        <head></head>
        <body>
            <p>Se le ha enviado esa encuesta para evaluar una ontologia. A continuacion se muestran los detalles
            de la ontologia: </p>
            <b>Liga para contestar encuesta: </b><br>'.$liga.'<br><br>
            <b>Nombre de la ontologia: </b>'.$nomEncuesta.'<br>
            <b>Area de la ontologia: </b>'.$area.'<br>
            <b>Objetivo: </b>'.$objetivo.'<br>
            <b>Descripcion: </b>'.$descripcion.'<br>
        </body>
        </html>
        ';

        //Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: ontology-evaluation <encuesta.ontologia@gmail.com>' . "\r\n";
        // Enviarlo
        
        $verificar = mail($para, $título, $mensaje, $cabeceras);

        if ($verificar){
            echo "La encuesta ha sido enviada con exito.";
        } else {
            echo "Ocurrio un error.";
        }

    }else{
        echo '<script> window.location="../login/login.php"; </script>';
    }
?>