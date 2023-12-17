<?php

$con = mysqli_connect("localhost", "id21668284_user", "Guldo2004!", "id21668284_usdtmining");

$link = "https://usdtwin.000webhostapp.com/";

session_start();

if(mysqli_connect_error()){
    $_SESSION["error"] = "Error: Conexion a la base de datos fallida";
    header("Location: $link");
    exit();
}

if(isset($_POST["usuario"]) && isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_POST["billetera"])){
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $billetera = $_POST["billetera"];

    // Verificar si el usuario ya existe
    $stmt = mysqli_prepare($con, "SELECT usuario FROM participantes WHERE usuario = ?");
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        $_SESSION["error"] = "Error: Usuario ya existente";
        header("Location: $link");
        exit();
    }

    // Verificar si el correo ya existe
    $stmt = mysqli_prepare($con, "SELECT correo FROM participantes WHERE correo = ?");
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        $_SESSION["error"] = "Error: Correo ya existente";
        header("Location: $link");
        exit();
    }

    // Verificar si billetera ya existe
    $stmt = mysqli_prepare($con, "SELECT billetera FROM participantes WHERE billetera = ?");
    mysqli_stmt_bind_param($stmt, "s", $billetera);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        $_SESSION["error"] = "Error: Billetera usdt ya utilizada";
        header("Location: $link");
        exit();
    }

    // Encriptar contrasena
    $salt = "\$5\$rounds=3000\$" . "xd" . $usuario . "\$";
    $hash = crypt($contrasena, $salt);

    // Insertar el nuevo usuario
    $stmt = mysqli_prepare($con, "INSERT INTO participantes (usuario, hash, salt, correo, billetera) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $usuario, $hash, $salt, $correo, $billetera);
    mysqli_stmt_execute($stmt);

    $_SESSION["error"] = "Ha creado un usuario correctamente! :)";

    header("Location: $link");
} else {
    $_SESSION["error"] = "Error: No se recibieron los datos de usuario y contraseña en el register";
    header("Location: $link");
    exit();
    
}

mysqli_close($con);

?>