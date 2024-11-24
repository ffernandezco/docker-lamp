<?php
session_start();

// Configuración de la base de datos
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);
if ($conn->connect_error) {
    error_log("Error de conexión a la base de datos: " . $conn->connect_error);
    header("Location: /login_error.php?error=prepare");
    exit();
}

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar los datos del formulario
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $apellidos = filter_var(trim($_POST['apellidos']), FILTER_SANITIZE_STRING);
    $dni = filter_var(trim($_POST['dni']), FILTER_SANITIZE_STRING);
    $tel = filter_var(trim($_POST['tel']), FILTER_SANITIZE_STRING);
    $fechanacimiento = filter_var(trim($_POST['fechanacimiento']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validación adicional de formato de fecha
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechanacimiento)) {
        header("Location: /login_error.php?error=invaliddate");
        exit();
    }

    // Comprobación de campos obligatorios
    if (!$nombre || !$apellidos || !$dni || !$tel || !$fechanacimiento || !$email || !$password) {
        header("Location: /login_error.php?error=general");
        exit();
    }

    // Consulta SQL preparada para insertar el nuevo usuario
    $query = "INSERT INTO usuarios (nombre, apellidos, dni, tel, fechanacimiento, email, password) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Error al preparar la consulta de inserción: " . $conn->error);
        header("Location: /login_error.php?error=prepare");
        exit();
    }

    // Asociar parámetros a la consulta preparada
    $stmt->bind_param('sssssss', $nombre, $apellidos, $dni, $tel, $fechanacimiento, $email, $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: /login");
        exit();
    } else {
        error_log("Error al ejecutar la inserción del usuario: " . $stmt->error);
        header("Location: /login_error.php?error=register");
        exit();
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    header("Location: /login_error.php?error=unauthorized");
    exit();
}
?>
