<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Vicent Smith</title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
    </header>
    <div class="contenedor">
        <section>
        <?php
include("con.php");
$SQL ="SELECT * FROM publicaciones ORDER BY RAND()";
    $RS=mysqli_query($con,$SQL);
    $RS = mysqli_query($con, $SQL);
    echo '<table align=center>';
    $contador = 0;
    
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
    
    echo "</tr>";
    echo "</table><br><br>";
?>
        </section>
        <aside>
            <?php if($_SESSION["usuario"]==""){echo "
                <p>¿Quieres subir tu arte y compartirlo con el mundo?</p>
                <a href='registrar.php'>Crea Tu Usuario</a>
                <p>¿Ya tienes una cuenta?</p>
                <a href='perfil.php'>Inicia Sesión</a>";
            } elseif($_SESSION["tipo"]!="USER") {echo "<br><br><br><br><br><br>
                <p>Hola ".$_SESSION["usuario"]."<br>¿Quiéres ir a tu perfil? </p>
                <a href='perfil.php'>Ir al Perfil</a>";
            }else{echo "<br><br><br><br><br><br><p>Hola ".$_SESSION["usuario"]."<br>Esperemos que te guste nuestra galería </p>";}
            ?>
        </aside>
    </div>
    <footer>
        <p>Este es el pie de página</p>
    </footer>

</body>

</html>
