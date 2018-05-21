<?php
session_start();
if(isset($_SESSION['user'])){
    $usuario=$_SESSION['user'];
    $idUser = $_SESSION['idUser'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!--JOWL -->
    <link rel="stylesheet" href="jowl/css/jOWL.css" type="text/css"/>
	<script type="text/javascript" src="lib/jquery2.min.js"></script>
    <script type="text/javascript" src="jowl/scripts/jOWL.js"></script>
	<script type="text/javascript" src="jowl/scripts/jOWL_UI.js"></script>
	<script>
	    $(function(){
	        $("#cancelar").click(function(e){
                window.location.href="inicio.php";
            });
	    });
	</script>
    <?php
        include('conexion.php');
    //Esto es para que al cargar el archivo no se borre lo que hay en los input
        $archivo="";
        $nombreProyecto = "";
        $nombreEncuesta= "";
        $areaOntologia= "";
        $objetivoOntologia= "";
        $descripcion = "";
        if (isset($_POST['cargarFile'])){
            $nombreProyecto = $_POST['nombreProyecto'];
            $nombreEncuesta=$_POST['nombreEncuesta'];
            $areaOntologia=$_POST['areaOntologia'];
            $objetivoOntologia=$_POST['objetivoOntologia'];
            $descripcion = $_POST['descripcion'];
            if (isset($_POST['archivo'])){
                $archivo = $_POST['archivo'];
            }
        } 
    ?>
</head>
<body>
    <form action="" method="post" id="formProyecto" enctype="multipart/form-data">
        <input type="hidden" id="usuario" name="usuario" value="<?php echo $idUser ?>">
        
        <label for="nombreProyecto">Nombre del proyecto:</label><br>
        <input type="text" id="nombreProyecto" name="nombreProyecto" maxlength="45" value="<?php echo $nombreProyecto ?>">
        <br><br>
        
        <label for="nombreEncuesta">Nombre de la encuesta:</label><br>
        <input type="text" id="nombreEncuesta" name="nombreEncuesta" maxlength="45" value="<?php echo $nombreEncuesta ?>">
        <br><br>

        <label for="areaOntologia">Area de la Ontologia</label><br>
        <input type="text" id="areaOntologia" name="areaOntologia" maxlength="45" value="<?php echo $areaOntologia ?>">
        <br><br>

        <label for="ObjetivoOntologia">Objetivo de la Ontologia:</label><br>
        <textarea name="objetivoOntologia" id="objetivoOntologia" cols="21" rows="5" maxlength="300"><?php echo $objetivoOntologia ?></textarea>
        <br><br>
        
        

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion" cols="21" rows="5" maxlength="300"><?php echo $descripcion ?></textarea>
        <br><br>
        
        <label for="drop_zone">Ontología:</label><br>
        
        <?php
            //copiar el archivo
            if (isset($_POST['cargarFile'])){
                copy($_FILES['archivoOWL']['tmp_name'],$_FILES['archivoOWL']['name']);
                $archivo=$_FILES['archivoOWL']['name'];  
            }         
        ?> 
        <input value ='<?php echo $archivo ?>' name='archivo' id='archivo' readonly='readonly' type='text' >
        <input type="file" name="archivoOWL">
        <input type="submit" name="cargarFile" id="cargarFile" value="Cargar archivo">
        <br><br>
        
        <input type="button" value="Aceptar" name="enviar" id="enviar">   
        <input type="button" value="Cancelar" name="cancelar" id="cancelar"> 
    </form>
    <ol id="encuesta">
    </ol>
    <!--//CODIGO JS //-->
    <script type="text/javascript" src="leerArchivo.js"></script> 
</body>
</html>
<?php 
}else{
    echo'<script> window.location="login/login.php"; </script>';
    
}
?>

