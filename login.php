<?php

$con = mysqli_connect("localhost", "id21668284_user", "Guldo2004!", "id21668284_usdtmining");

$link = "https://usdtwin.000webhostapp.com/";

session_start();

if(mysqli_connect_error()){
    $_SESSION["error"] = "Error: Conexion a la base de datos fallida";
    header("Location: $link");
    exit();
}


if(isset($_POST["usuario"]) && isset($_POST["contrasena"])){
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];

$stmt = mysqli_prepare($con, "SELECT usuario, salt, hash, contador FROM participantes WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) != 1){
    $_SESSION["error"] = "Error: Usuario o contraseña incorrectos";
    header("Location: $link");
    exit();
}

$existinginfo = mysqli_fetch_assoc($result);
$storedsalt = $existinginfo["salt"];
$hash = $existinginfo["hash"];
$contador = $existinginfo["contador"];

$loginhash = crypt($contrasena, $storedsalt);
if($hash != $loginhash){
    $_SESSION["error"] = "Error: Contraseña incorrecta";
    header("Location: $link");
    exit();
}

$_SESSION["error"] = "Ha iniciado sesion correctamente! :)";
$_SESSION["contador"] = $contador;
$_SESSION["usuario"] = $usuario;
header("Location: $link");

}else {
    $_SESSION["error"] = "Error: No se recibieron los datos de usuario y contraseña en el login";
    header("Location: $link");
    exit();
}

mysqli_close($con);


?>