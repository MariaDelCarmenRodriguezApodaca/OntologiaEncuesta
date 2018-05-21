<?php
    session_start();
    include '../conexion.php';     
    if(isset($_SESSION['user'])) {
    $usuario=$_SESSION['user'];
    $id_usuario=$_SESSION['idUser'];
    $idEncuesta = isset($_GET['id']) ? $_GET['id'] : null ;
    $url = $_SERVER['SERVER_NAME'];
    $liga = $url."/ontologia/encuesta/encuesta.php?id=".$idEncuesta;

    $sentencia="SELECT * FROM encuesta WHERE id_encuesta='".$idEncuesta."' ";
    if ($resultado = $conectar->query($sentencia)) {
      $fila = $resultado->fetch_row();
      $resultado->close();
  
      $consulta= [
          $fila[0],
          $fila[1],
          $fila[2],
          $fila[3],
          $fila[4],
          $fila[5],
          $fila[6],
          $fila[7]
      ];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta | Compartir encuesta</title>
    <script type="text/javascript" src="../lib/jquery2.min.js"></script>
    <script type="text/javascript" src="compEncuesta.js"></script>
</head>
<body>
    <a href="#"><?php echo "Bienvenido : ",$_SESSION['user']?></a>
    <a href="../login/logout.php">Cerrar sesion</a>
    <br>
    <br>

    <form action="post"></form><a href=""></a>
        <label for="liga">Liga:</label><br>    
        <?php echo $liga; ?><br> 
        <input type="hidden" id="liga" name="liga" value="<?php echo $liga; ?>">
        <br>
        
        <label for="nomEncuesta">Nombre de encuesta:</label> <br>
        <input type="text" name="nomEncuesta" id="nomEncuesta" value="<?php echo $consulta[1]; ?>" disabled>
        <br><br>

        <label for="area">Area de la ontologia:</label> <br>
        <input type="text" name="area" id="area" value="<?php echo $consulta[3]; ?>" disabled>
        <br><br>

        <label for="objetivo">Objetivo:</label> <br>
        <textarea name="objetivo" id="objetivo" cols="60" rows="5" disabled><?php echo $consulta[4]; ?></textarea>
        <br><br>
        
        <label for="descripcion">Descripcion:</label> <br>
        <textarea name="descripcion" id="descripcion" cols="60" rows="5" disabled><?php echo $consulta[5]; ?></textarea>
        <br><br>

        <label for="correo">Correos:</label> <br>
        <input type="text" id="correo" name="correo" value="" autocomplete="off"><input type="button" name="agregar" id="agregar" value="Agregar">
        
        <!--LISTA DONDE SE VAN AGREGANDO CORREOS-->
        <ol id=lista>
        </ol>
        <br><br>

        <input type="button" name="enviar" id="enviar" value="Enviar">
        <input type="button" id="cancelar" name="cancelar" value="Cancelar">
    </form>  

    <br><br>
</body>
</html>
<?php
}else{
	echo '<script> window.location="../login/login.php"; </script>';
}
?>