<?php
include ("con.php");

if(!isset($_POST['Submit'])){
?>

<form action="login_admin.php" method="POST">
  <table class=tabla align="center" width="225" cellspacing="2" cellpadding="2" border="0">
    <tr>
      
        <?php 
        if (isset($_GET["error"]) && $_GET["error"]=="data"){
          echo '<td colspan="2" align="center" bgcolor=red><span style="color:#fffff"><b>Inténtalo otra vez!! </b></span>';
        } elseif(isset($_GET["error"]) && $_GET["error"]=="user"){
          echo '<td colspan="2" align="center" bgcolor=purple><span style="color:#fffff"><b>No eres un usuario autorizado </b></span>';
        } else {
          echo '<td colspan="2" align="center"> <span class="Estilo3">Introduce tus datos</span>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td align="right" >Usr:</td>
      <td><input name="usuario" type="Text" maxlength="50"></td>
    </tr>
    <tr>
      <td align="right">Pwd:</td>
      <td><input name="pass" type="password"  maxlength="50"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="Submit" type="Submit" value="Enviar"></td>
    </tr>
  </table>
<?php
} else {
  $cifrada = hash('sha256',$_POST['pass']);
  $SQL = "SELECT * FROM usuarios";
  $RS = mysqli_query($con, $SQL);

  while($fila = mysqli_fetch_assoc($RS)){
    $usr = filter_var($fila['Nombre'], FILTER_SANITIZE_STRING);
    $pass = $fila['Contraseña'];
    $tipo = $fila['Tipo_Usr'];

    if ($_POST["usuario"] == $usr && $cifrada == $pass && $tipo =='ADMIN'){  
      session_start();
      $_SESSION["usuario"] = $usr;
      $_SESSION["autentificado"] = "SI";
      $_SESSION['type']= "ADMIN";
      header ("Location:".$_SESSION['php']."");
      exit;
    } elseif($_POST["usuario"] == $usr && $cifrada == $pass && $tipo !='ADMIN'){
      header("Location: login_admin.php?error=user");
    } else {
      header("Location: login_admin.php?error=data");
    }
  }
}
?>

