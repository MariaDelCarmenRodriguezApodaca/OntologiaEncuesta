<?php
    session_start();
    include '../conexion.php';     
    if(isset($_SESSION['user'])) {
    $usuario=$_SESSION['user'];
    $idEncuesta = isset($_GET['id']) ? $_GET['id'] : null ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta | Vista previa</title>
    <script type="text/javascript" src="../lib/jquery2.min.js"></script>
    <script>
        $(function(){
            $("#regresar").click(function(e){
                window.location.href='../inicio.php';
            });
        });
    </script>
</head>
<body>
    <a href="#"><?php echo "Bienvenido : ",$_SESSION['user']?></a>
    <a href="../login/logout.php">Cerrar sesion</a>
    <br>
    <br>

    <ol>
        <?php
            $sentencia="SELECT * FROM pregunta WHERE id_encuesta='".$idEncuesta."'";
            $resultado=$conectar->query($sentencia) or die (mysqli_error($conectar));
            while($filas=$resultado->fetch_assoc())
            {
                echo "<li>"; echo $filas['descripcion']; echo "</li>";
            }
        ?>
    </ol>

    <input type="button" id="regresar" name="regresar" value="Regresar">
</body>
</html>
<?php
}else{
	echo '<script> window.location="../login/login.php"; </script>';
}
?>