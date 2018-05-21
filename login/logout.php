<?php
    session_start();
    session_destroy();
    echo "<script>alert('Cerraste sesión'); </script>";
    echo '<script> window.location="login.php"; </script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cerrando...</title>
</head>
<body>
    
</body>
</html>