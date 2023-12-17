<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>verified usdt cloud crypto mining</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>

    <p id="error">
        <?php
            echo isset($_SESSION["error"]) ? $_SESSION["error"] : "";

            isset($_SESSION["usuario"]) ? $user = $_SESSION["usuario"] : $user = "";
            echo '<p id="usuario">' . $user . '</p>';
        ?>
    </p>

    <header>
        <h1>usdt <span>verified</span> cloud mining</h1>
        <?php
            if($user == ""){
                echo
                    '<div>
                        <button id="btniniciarsesion">iniciar sesión</button>
                        <button id="btnregistrarme">registrarme</button>
                    </div>';
            }else echo '';
        ?>
    </header>

    <div id="iniciarsesion" class="logeo">
        <button id="cerrariniciarsesion" class="btncerrarlogeo" onclick="cerrarIniciarSesion()">X</button>
        <p>iniciar sesión</p>
        <form action="https://usdtwin.000webhostapp.com/login.php" method="post">
            <input type="text" name="usuario" placeholder="nombre">
            <input type="text" name="contrasena" placeholder="contrasena">
            <button type="submit" class="send">send</button>
        </form>
    </div>

    <div id="registrarme" class="logeo">
        <button id="cerrarregistrarme" class="btncerrarlogeo" onclick="cerrarRegistrarme()">X</button>
        <p>registrarme</p>
        <form action="https://usdtwin.000webhostapp.com/register.php" method="post">
            <input type="text" name="usuario" placeholder="nombre">
            <input type="text" name="correo" placeholder="correo">
            <input type="text" name="contrasena" placeholder="contraseña">
            <input type="text" name="billetera" placeholder="billetera usdt bep20">
            <button type="submit" class="send">send</button>
        </form>
    </div>

    <div id="cryptozone">
        <p id="contador"><?php
            echo isset($_SESSION["contador"]) ? $_SESSION["contador"] : "-";
        ?></p>
    </div>

    <p id="info">80.000 = 1 usdt</p>
    <p id="discord"><a href="https://discord.gg/XTcu97qGut">discord</a></p>

    <script async="async" data-cfasync="false" src="//pl21770313.toprevenuegate.com/59145d108470b0292868944a193f2023/invoke.js"></script>
    <div id="container-59145d108470b0292868944a193f2023"></div>

    <script type='text/javascript' src='//pl21770339.toprevenuegate.com/bd/81/82/bd818202025a3a9eea286ec481e04d31.js'></script>

    <?php if($user != "") echo '<button id="cerrarsesion" onclick="cerrarSesion()">cerrar sesion</button>'; ?>
    
    <script src="script.js"></script>
</body>
</html>