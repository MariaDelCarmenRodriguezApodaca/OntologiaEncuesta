<?php
	session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="text/javascript" src="../lib/jquery2.min.js"></script>
    <script>
        $(function(){
            $("#registrar").click(function(e){
                window.location.href='registrar.php';
            });
        });
    </script>
</head>
<body>
    <div>
        <form action="validarUsuario.php" method="post">
            <label for="usuario">Usuario:</label><br>
            <input id="usuario" name="usuario" type="text"autocomplete="off" placeholder="Usuario" required><br><br>

            <label for="pw">Contraseña:</label><br>
            <input id="pw" name="pw" type="password" autocomplete="off" placeholder="Contraseña" required><br><br>

            <input type="submit" name="login" id="login" value="Entrar">
        </form>
        <br>
        <input type="button" name="registrar" id="registrar" value="Registrarte">
    </div>
</body>
</html>