<?php
    session_start();
    $_SESSION['php']="edieli.php";
    include ("con.php");
    include ("security_profile.php");
    include ("user_filter.php");
   
    if($_POST['qh']=="editar"){
        $titulo=$_POST['Título'];
        $descripcion=$_POST['Descripción'];
        $idp=$_POST['ID_Publicación'];
        $idu=$_POST['ID_Usuario'];
        $img=$_POST['Imagen']; 
        $date=$_POST['date'];
        $SQL="UPDATE publicaciones SET Título='$titulo', Imagen='$img', Fecha='$date', Descripción='$descripcion' WHERE ID_Publicación=$idp";
    } elseif($_POST['qh']=="eliminar"){
        $SQL= "DELETE FROM publicaciones WHERE ID_Publicación=".$_POST['id'];
        unlink($_POST['file']);
    }
    if(mysqli_query($con,$SQL)){
        header("Location: perfil.php");
    } else {echo "ERROR";}
?>