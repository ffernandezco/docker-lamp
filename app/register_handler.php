<?php
header('X-Frame-Options: DENY');
session_start();

// Configuración de la base de datos
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);
if ($conn->connect_error) {
    // Log interno del error sin mostrar detalles al usuario
    error_log("Error de conexión a la base de datos: " . $conn->connect_error);
    echo "<script>alert('Error de conexión. Por favor, inténtalo más tarde.'); window.location.href = '/register';</script>";
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
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptación de la contraseña

    // Validación adicional de formato de fecha
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechanacimiento)) {
        echo "<script>alert('Formato de fecha inválido. Use AAAA-MM-DD.'); window.location.href = '/register';</script>";
        exit();
    }

    // Comprobación de campos obligatorios
    if (!$nombre || !$apellidos || !$dni || !$tel || !$fechanacimiento || !$email || !$password) {
        echo "<script>alert('Todos los campos son obligatorios y deben tener un formato válido.'); window.location.href = '/register';</script>";
        exit();
    }

    // Consulta SQL preparada para insertar el nuevo usuario
    $query = "INSERT INTO usuarios (nombre, apellidos, dni, tel, fechanacimiento, email, password) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Verificación adicional en caso de que la preparación falle
    if (!$stmt) {
        // Log interno del error y mensaje de error genérico al usuario
        error_log("Error al preparar la consulta de inserción: " . $conn->error);
        echo "<script>alert('Error interno del servidor. Por favor, inténtalo más tarde.'); window.location.href = '/register';</script>";
        exit();
    }

    // Asociar parámetros a la consulta preparada
    $stmt->bind_param('sssssss', $nombre, $apellidos, $dni, $tel, $fechanacimiento, $email, $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        echo "<script>alert('Usuario añadido. Ahora puedes iniciar sesión'); window.location.href = '/login';</script>";
    } else {
        // Log interno del error y mensaje genérico al usuario
        error_log("Error al ejecutar la inserción del usuario: " . $stmt->error);
        echo "<script>alert('Hubo un problema al crear el usuario. Por favor, inténtalo más tarde.'); window.location.href = '/register';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Evitar accesos no autorizados
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '/register';</script>";
    exit();
}
?>
