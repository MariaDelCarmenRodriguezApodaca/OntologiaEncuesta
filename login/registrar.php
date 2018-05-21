<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
</head>
<body>
<?php
    include '../conexion.php'; 

    if (isset($_POST['enviar'])) {
        $nom=$_POST['nombre'];
        $user=$_POST['usuario'];
        $password=$_POST['contra'];

        //**MODIFICAR */
    }
?>
    <form action="registrar.php" method="post">

        <label for="nombre">Nombre:</label><br>
        <input id="nombre" name="nombre" type="text" autocomplete="off" value=""><br><br>
        
        <label for="usuario">Usuario:</label><br>
        <input id="usuario" name="usuario" type="text" autocomplete="off" value=""><br><br>
        
        <label for="pw">Password:</label><br>
        <input id="pw" name="pw" type="password" value=""><br><br>
        
        <input type="submit" name="enviar" id="enviar" value="Enviar">
        
    </form>
    <br>
    <a href="login.php">Iniciar sesion</a>
</body>
</html>