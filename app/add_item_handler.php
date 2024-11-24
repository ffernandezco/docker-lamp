<?php
session_start();

ini_set('display_errors', 0);
error_reporting(0);

$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

$conn = mysqli_connect($hostname, $username, $password, $db);
if ($conn->connect_error) {
    error_log("Error de conexión a la DB: " . $conn->connect_error);
    header("Location: /error.php?error=connection");
    exit();
}

// Obtenemos los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fcompra = $_POST['fcompra'];
    $fcaducidad = $_POST['fcaducidad'];
    $calorias = $_POST['calorias'];
    $precio = $_POST['precio'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($fcompra) && !empty($fcaducidad) && !empty($calorias) && !empty($precio)) {
        
        // Preparar consulta SQL para evitar inyección
        $query = "INSERT INTO alimentos (nombre, fcompra, fcaducidad, calorias, precio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Asignar los parámetros
            $stmt->bind_param("sssdi", $nombre, $fcompra, $fcaducidad, $calorias, $precio);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                header("Location: /items");
                exit();
            } else {
                error_log("Error al ejecutar la consulta: " . $stmt->error);
                header("Location: /error.php?error=insert");
                exit();
            }

            $stmt->close();
        } else {
            error_log("Error al preparar la consulta: " . $conn->error);
            header("Location: /error.php?error=prepare");
            exit();
        }
        
    } else {
        header("Location: /");
        exit();
    }
}

$conn->close();
?>
