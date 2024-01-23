<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Perfil </title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
    </header>
    <div class="contenedor">
        <section>
        <?php
    include ("con.php");
    include ("security_profile.php");
    include ("user_filter.php");
    $SQL = "SELECT * FROM publicaciones WHERE ID_Usuario=".$_SESSION['IDU']." ORDER BY RAND()";
    $RS=mysqli_query($con,$SQL);
    echo '<table align=center>';
    $contador = 0;
    if (!isset($_GET["id"])){
        while ($fila = mysqli_fetch_assoc($RS)) {
            if ($contador % 3 == 0) { 
                echo '<tr>';
            }
            echo '<td><img class=imgi src="' . $fila['Imagen'] . '" alt="Imagen"></td>';
    
            $contador++;
    
            if ($contador % 3 == 0) { 
                echo '</tr>';
            }
        }
    
        if ($contador % 3 != 0) { 
            echo '</tr>';
        }
    
        echo '</table>';
    }

    
    ?>
        </section>
        <aside>
            <?php
                $SQL2="SELECT a.Biografía FROM artistas a INNER JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario WHERE a.ID_Usuario=".$_SESSION["IDU"];
                $RS2=mysqli_query($con,$SQL2);
                $bio=mysqli_fetch_assoc($RS2);
                if(!isset($_POST['editar'])){
                echo '
                <form action="editar_perfil.php" method="post">
                    <label for="nombre">Usuario:</label><br>
                    <input type="text" id="nombre" name="nombre" value="'.$_SESSION["usuario"].'"><br>
                    <label for="biografia">Biografía:</label><br>
                    <textarea row=4 id="biografia" name="biografia">'.$bio["Biografía"].'</textarea><br>
                    <input type="submit" value="Editar" name="editar">
                </form>';
            } else {
                $nombre=$_POST["nombre"];
                $bio=$_POST["biografia"];
                $name="SELECT Nombre FROM usuarios WHERE Nombre='$nombre'";
                $r_name=mysqli_query($con,$name);
                if(strlen($nombre) > 10){
                    echo "El nombre de usuario no puede tener más de 10 caracteres.";
                    header("Location:editar_perfil.php");
                }elseif($_SESSION["usuario"]!=$nombre){
                    if(mysqli_num_rows($r_name) > 0){
                        echo "El nombre de usuario ya existe.";
                        header("Location:editar_perfil.php");
                    }else{
                        $ub="UPDATE artistas SET Biografía='".$_POST["biografia"]."' WHERE ID_Usuario=".$_SESSION["IDU"];
                        $un="UPDATE usuarios SET Nombre='".$_POST["nombre"]."' WHERE ID_Usuario=".$_SESSION["IDU"];
                    if(mysqli_query($con,$ub) && mysqli_query($con,$un)){
                        header("Location:perfil.php?s=ok");
                    }
                }
            }else{
                $ub="UPDATE artistas SET Biografía='".$_POST["biografia"]."' WHERE ID_Usuario=".$_SESSION["IDU"];
                $un="UPDATE usuarios SET Nombre='".$_POST["nombre"]."' WHERE ID_Usuario=".$_SESSION["IDU"];
            if(mysqli_query($con,$ub) && mysqli_query($con,$un)){
                header("Location:perfil.php?s=ok");
            }
        }
        }

                mysqli_close($con);
            ?>
        </aside>
    </div>
    <footer>
        <p>Este es el pie de página</p>
    </footer>

</body>

</html>
