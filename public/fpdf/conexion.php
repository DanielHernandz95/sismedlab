
<?php
     //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli = new mysqli("localhost", "Admin", "T3cnolog14", "dba_rei", "3306"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
