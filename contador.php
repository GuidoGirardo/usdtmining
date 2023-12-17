<?php

// Verifica si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();

    $json = file_get_contents("php://input"); // obtenemos el contenido json
    $data = json_decode($json, true); // lo decodificamos

    if ($data === null) {
        http_response_code(400);
        echo json_encode(['error' => 'Error en el formato JSON']);
    } else {
        $nombre = $data['nombre'];

        // hacer algo con los datos XD
        $con = mysqli_connect("localhost", "id21668284_user", "Guldo2004!", "id21668284_usdtmining");

        if ($con->connect_error) die("Error de conexión: " . $con->connect_error);

        $sql = "SELECT contador FROM participantes WHERE usuario = '$nombre'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $contador = $row["contador"];
        $contador++;

        if($contador >= 80000){
            $sql = "SELECT id, correo, billetera FROM participantes WHERE usuario = '$nombre'";
            $result = $con->query($sql);

            $row = $result->fetch_assoc();
            $id = $row["id"];
            $correo = $row["correo"];
            $billetera = $row["billetera"];
            $sql = "INSERT INTO ganadores (usuario, correo, billetera, identificador) VALUES ('$nombre', '$correo', '$billetera', '$id')";
            $con->query($sql);
            echo $contador;
            $contador = 0;
            $sql = "UPDATE participantes SET contador = '$contador' WHERE usuario = '$nombre'";
            $con->query($sql);
            exit();
        }else{
            $sql = "UPDATE participantes SET contador = '$contador' WHERE usuario = '$nombre'";
            $con->query($sql);
        }

        $con->close();
        
        echo $contador; // devolver respuesta
    }
} else {
    http_response_code(405); // método no permitido
    echo json_encode(['error' => 'Método no permitido']);
}
?>