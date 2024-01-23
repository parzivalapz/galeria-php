<?php
include ("con.php");
include ("security_profile.php");
include ("user_filter.php");

if(!isset($_POST["Publicar"])){
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Publicación</title>
</head>
<body>
    <table align=center>
    <form action="publicar.php" method="post" ENCTYPE="multipart/form-data">
        <tr>
            <td><label for="titulo">Título:</label></td>
            <td><input type="text" name="titulo" id="titulo" required></td>
        </tr>
         <tr>
            <td><label for="imagen">Imagen:</label></td>
            <td><input type="file" size="44" name="imagen" id="imagen" accept=".jpeg, .png, .gif, .jpg" required></td>
        </tr>
        <tr>
            <td><label for="descripcion">Descripción:</label></td>
            <td><textarea name="descripcion" id="descripcion" required></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="Publicar" value="Publicar"></td>
        </tr>
    </form>
    </table>
</body>
</html>
<?php 
}else{
    
$id_publicacion=rand(10000000, 99999999);
$id_usuario=$_SESSION['IDU'];
$usuario=$_SESSION['usuario'];

if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "img/".$usuario."-".$id_usuario."/";
    $nombreFichero = $_FILES['imagen']['name'];
    $extensionArchivo = pathinfo($nombreFichero, PATHINFO_EXTENSION);
    $extensionesPermitidas = array('jpg', 'jpeg', 'png', 'gif');
    $nombreFichero = $usuario."-".$id_publicacion."." . $extensionArchivo;
    $nombreCompleto = $nombreDirectorio . $nombreFichero;

    if(in_array($extensionArchivo, $extensionesPermitidas)){
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreCompleto)) {
            echo "Error al mover el archivo.";
        }
    } else { 
        echo "Extensión no permitida.";
    }
}

$titulo=filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
$descripcion=filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
$date=date('Y-m-d H:i:s');
$SQL="INSERT INTO publicaciones VALUES ($id_publicacion, $id_usuario, '$titulo','$nombreCompleto','$date','$descripcion')";

if(mysqli_query($con,$SQL)){
    echo "Publicación hecha con exito :D";
} else {echo "error";}

mysqli_close($con);
}
?>
