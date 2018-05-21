<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<title>Validando...</title>
	<meta charset="utf-8">
</head>
</head>
<body>
		<?php
			include '../conexion.php';   
			if (mysqli_connect_errno()) {
				printf("Conexión fallida:");
				exit();
			}else{
				if(isset($_POST['login'])){
					$usuario = $_POST['usuario'];
					$pw = $_POST['pw'];
					$sql = mysqli_query($conectar,"SELECT * FROM usuario WHERE username='$usuario' AND password='$pw' AND estatus='1'");
					if(!$sql){
						echo "la consulta no se realizo";
					}
					if (mysqli_num_rows($sql)>0) {
						$row = mysqli_fetch_array($sql);
						$_SESSION["user"] = $row['username']; 
						$_SESSION["idUser"] = $row['id_usuario'];
								//verificamos la ejecucion
								
						echo '<script> window.location="../inicio.php"; </script>';
					}
					else{
						echo '<script> alert("Usuario o contraseña incorrectos.");</script>';
						echo '<script> window.location="login.php"; </script>';
					}
				}
			}
		?>	
</body>
</html>