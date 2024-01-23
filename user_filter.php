<?php
session_start();
if ($_SESSION["tipo"]=="USER") {
	header("Location: index.php");
	exit();
} 
?>