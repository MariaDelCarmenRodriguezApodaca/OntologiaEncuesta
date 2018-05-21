<?php
    include '../conexion.php';
    $idEncuesta = isset($_GET['id']) ? $_GET['id'] : null ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta | Contestar encuesta</title>
    <script type="text/javascript" src="../lib/jquery2.min.js"></script>
    <style>
    input[type="radio"]{
        margin: 0 10 0 0;
    }
    </style>
    <script>
        $(function(){
            $("#enviar").click(function(e){
                //window.location.href='../inicio.php';
            });
        });
    </script>
</head>
<body>
    <form action="" method="post"></form>
        <ol>
            <?php
                $sentencia="SELECT * FROM pregunta WHERE id_encuesta='".$idEncuesta."'";
                $resultado=$conectar->query($sentencia) or die (mysqli_error($conectar));
                while($filas=$resultado->fetch_assoc())
                {
                    echo "<li>"; echo $filas['descripcion']; 
                    echo "<br>";
                    echo '<input type="radio" name="q'.$filas['id_pregunta'].'" value="td"> Totalmente en desacuerdo ';
                    echo '<input type="radio" name="q'.$filas['id_pregunta'].'" value="d"> En desacuerdo ';
                    echo '<input type="radio" name="q'.$filas['id_pregunta'].'" value="nad"> Ni de acuerdo ni en desacuerdo ';
                    echo '<input type="radio" name="q'.$filas['id_pregunta'].'" value="a"> De acuerdo ';
                    echo '<input type="radio" name="q'.$filas['id_pregunta'].'" value="ta"> Totalmente de acuerdo ';
                    echo "</li>";
                    echo "<br><br>";
                }
            ?>
        </ol>
    </form>
    <input type="button" id="enviar" name="enviar" value="Enviar">
</body>
</html>