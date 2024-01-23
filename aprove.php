<?php
$_SESSION['php']="aprove.php";
include("con.php");
include("security.php");
include ("user_filter.php");

if(isset($_GET['a'])){
    if($_GET['a']=='si'){
        $SQL="UPDATE usuarios SET Estado=1 WHERE ID_Usuario=".$_GET["ID_Usuario"];
        $SQL2="DELETE FROM solicitudes WHERE ID_Usuario=".$_GET["ID_Usuario"];
        if($_GET["tipo"]=="ARTIST"){
        mkdir("img/".$_GET['usr']."-".$_GET['ID_Usuario']."", 0777);}
    } elseif($_GET['a']=='no') {
        $SQL="DELETE FROM usuarios WHERE ID_Usuario=".$_GET["ID_Usuario"];
        $SQL2="DELETE FROM solicitudes WHERE ID_Usuario=".$_GET["ID_Usuario"];
    }
}
if(mysqli_query($con,$SQL2) && mysqli_query($con,$SQL)){
    header ("Location:gestion_cuentas.php");
} else {echo "ERROR";}
mysqli_close($con);
?>