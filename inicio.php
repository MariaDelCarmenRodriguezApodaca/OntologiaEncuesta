<?php
    session_start();
    include 'conexion.php';     
    if(isset($_SESSION['user'])) {
    $usuario=$_SESSION['user'];
    $id_usuario=$_SESSION['idUser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <style>
    table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <script type="text/javascript" src="lib/jquery2.min.js"></script>
    <script>
        $(function(){
            $("#nuevo").click(function(e){
                window.location.href='nuevoProyecto.php';
            });
        });
    </script>
</head>
<body>
    <a href="#"><?php echo "Bienvenido : ",$_SESSION['user']?></a>
    <a href="login/logout.php">Cerrar sesion</a>
    <br>
    <br>

    <input type="button" id="nuevo" name="nuevo" value="Nuevo"><br><br>

    <?php
        $sentencia="SELECT * FROM encuesta WHERE usuario='".$id_usuario."'";
        $resultado=$conectar->query($sentencia) or die (mysqli_error($conectar));
        $numFilas = mysqli_num_rows($resultado);
        if ($numFilas!=0){
    ?>
    <table id="datos">
        <tr>
        <th>ID</th>
        <th>Nombre de encuesta</th>
        <th>Nombre de proyecto</th>
        <th>Area de la Ontologia</th>
        <th>Objetivo</th>
        <th>Descripcion</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        </tr> 
        <?php
            while($filas=$resultado->fetch_assoc())
            {
                echo "<tr>";
                    echo "<td>"; echo $filas['id_encuesta']; echo "</td>";
                    echo "<td>";  echo $filas['nombre_encuesta']; echo "</td>";
                    echo "<td>";  echo $filas['nombre_proyecto']; echo "</td>";
                    echo "<td>";  echo $filas['area_ontologia']; echo "</td>";
                    echo "<td>"; echo $filas['objetivo_ontologia']; echo "</td>";
                    echo "<td>"; echo $filas['descripcion']; echo "</td>";
                    echo "<td><a href='encuesta/verEncuesta.php?id=".$filas['id_encuesta']."'>Ver encuesta</a></td> ";					
                    echo "<td><a href='estadisticas.php?id=".$filas['id_encuesta']."'>Estadisticas</a></td> ";
                    echo "<td><a href='encuesta/compartirEncuesta.php?id=".$filas['id_encuesta']."'>Compartir</a></td> ";
                    echo "<td><a href='encuesta/eliminar.php?id=".$filas['id_encuesta']."'>Eliminar</a></td> ";			
                echo "</tr>";
            }
        ?>
    </table>

    <?php
        }else {
            echo "No se encontro ningun proyecto";
        }
    ?>
</body>
</html>
<?php
}else{
	echo '<script> window.location="login/login.php"; </script>';
}
?>