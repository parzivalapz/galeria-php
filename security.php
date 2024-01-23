<?php
//Inicio la sesi�n
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($_SESSION["autentificado"] != "SI" OR $_SESSION["type"]!="ADMIN") {
	//si no existe, envio a la p�gina de autentificacion
	header("Location: login_admin.php");
	//ademas salgo de este script
	exit();
} 
?>
