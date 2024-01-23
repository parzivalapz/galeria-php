<?php
session_start();
include ("con.php");

if(!isset($_POST["Registrarme"])){
    $SQL="SELECT Nombre FROM usuarios";
    $RS=mysqli_query($con,$SQL);
?>
	<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme</title>
</head>
<body>
        <table align=center>
    <form action="registrar.php" method="post">
                <tr>
                    <td><label for="nombre">Nombre</label></td>
                    <td><input type="text" name="nombre" id="nombre" maxlength="10" required></td>
                </tr>
                <tr>
                    <td><label for="correo">Correo</label></td>
                    <td><input type="email" name="correo" id="correo" required></td>
                </tr>
                <tr>
                    <td><label for="contrasenya">Contraseña:</label></td>
                    <td><input type="password" name="contrasenya" id="contrasenya" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra mayúscula, una letra minúscula y al menos 8 o más caracteres" required>
                </tr>
                <tr>
                    <td><label for="tipo">¿Qué Soy?</label></td>
                    <td><select name="tipo">
                        <option id="tipo" selected disabled>Elige</option>
                        <option id="tipo" value="ARTIST">Artista</option>
                        <option id="tipo" value="USER">Usuario</option>
                    </select></td>
                </tr>
                <input type="hidden" name="estado" value=0>
                <tr>
                    <td><input rowspan=2 type="submit" name="Registrarme" value="Registrarme"></td>
                </tr>
        </table>    
    </form>
</body>
</html>
<?php 
}else{
    
$id=rand(10000000, 99999999);
$id_s=rand(10000000, 99999999);
$tipo=$_POST["tipo"];
$estado=$_POST["estado"];
$correo=filter_var($_POST["correo"], FILTER_SANITIZE_STRING);
$passf=filter_var($_POST["contrasenya"], FILTER_SANITIZE_STRING);
$nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);

if(strlen($nombre) > 10){
    echo "El nombre de usuario no puede tener más de 10 caracteres.";
    exit();
}

$SQL="SELECT Nombre FROM usuarios WHERE Nombre='$nombre'";
$RS=mysqli_query($con,$SQL);
if(mysqli_num_rows($RS) > 0){
    echo "El nombre de usuario ya existe.";
    exit();
}

$enpass=hash('sha256',$passf);
$date=date('Y-m-d H:i:s');

$SQL= "INSERT INTO usuarios VALUES ($id, '$nombre', '$correo', '$enpass', '$tipo', $estado)";
$SQL2= "INSERT INTO solicitudes VALUES ($id_s, $id, '$date', '$tipo', $estado)";

if(mysqli_query($con,$SQL) && mysqli_query($con,$SQL2)){ 
    echo "Verificando su información, podrá acceder a su cuenta en breves";
} else {
    echo "Error: " . mysqli_error($con);
}
}
mysqli_close($con);

?>
