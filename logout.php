<?php
/*
Si existe la sesion, la destruye! 
*/
session_start();
session_destroy();
session_start();
header("Location:index.php")
?>