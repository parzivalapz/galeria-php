
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" target="_blank" rel="noopener" href="style.css">
</head>
<body>

<header>
    <div id="title">
        <h1>Eliminar Publicación</h1>
    </div>
    <div id="search">
</header><br>
<footer>
	<div>
		Bienvenido <?php session_start(); echo $_SESSION['usuario']; ?>
	</div>
    <div id="footer-text">
        Videoteca de Vicente Solá
    </div>
    <div id="footer-exit">
        <a href="logout.php"><img src="recursos/exit.png" alt="salir"></a>
    </div>
</footer>
<section>
<?php
session_start();
$_SESSION['php']="eliminar.php";
include ("security_profile.php");
include ("con.php");
include ("user_filter.php");
$SQL="SELECT * FROM publicaciones WHERE ID_Usuario=".$_SESSION['IDU'];
$RS = mysqli_query($con, $SQL);
echo "<h1 align=center>¿Qué imagen quieres eliminar?</h1>";
echo '<table align=center>';
$contador = 0;

if (!isset($_GET["id"])){
    while ($fila = mysqli_fetch_assoc($RS)) {
        if ($contador % 3 == 0) { 
            echo '<tr>';
        }

        echo '<td><a href=eliminar.php?id='.$fila['ID_Publicación'].'><img width=150px length=100px src="' . $fila['Imagen'] . '" alt="Imagen"></a></td>';

        $contador++;

        if ($contador % 3 == 0) { 
            echo '</tr>';
        }
    }

    if ($contador % 3 != 0) { 
        echo '</tr>';
    }

    echo '</table>';
}elseif(isset($_GET['id'])){
			$SQL = "SELECT * FROM publicaciones  WHERE ID_Publicación=".$_GET['id'];
			$RS=mysqli_query($con,$SQL);
			$fila=mysqli_fetch_assoc($RS);
			?>
		<table>
		<tr><td>
		<h2>ELIMINAR PUBLICACIÓN</h2>
		<form  method="post" action="edieli.php">
					
						
			
			
					
		<p>¿Estas seguro que deseas eliminar <img width=10% src="<?php echo $fila['Imagen'];?>"></img> ? &nbsp;&nbsp;
			    
			
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <input type="hidden" name="file" value="<?php echo $fila['Imagen'];?>" />
        <input type=hidden name="qh" value="eliminar">
		<input type="submit" name="conf" value="Confirmar" />
		</form>	
 </td></tr></table>



<?php
}
mysqli_close($con);
?>
</section>
</body>
</html>
