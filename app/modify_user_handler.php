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
    die("Error de conexión a la DB: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar los datos del formulario
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $apellidos = filter_var(trim($_POST['apellidos']), FILTER_SANITIZE_STRING);
    $dni = filter_var(trim($_POST['dni']), FILTER_SANITIZE_STRING);
    $tel = filter_var(trim($_POST['tel']), FILTER_SANITIZE_STRING);
    $fechanacimiento = filter_var(trim($_POST['fechanacimiento']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptación de la contraseña

    // Validación adicional de formato de fecha
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechanacimiento)) {
        echo "<script>alert('Formato de fecha inválido. Use AAAA-MM-DD.'); window.location.href = '/modify_user?user=$id';</script>";
        exit();
    }

    // Comprobación de campos obligatorios
    if ($id === false || !$nombre || !$apellidos || !$dni || !$tel || !$email || !$password) {
        echo "<script>alert('Datos inválidos o incompletos.'); window.location.href = '/modify_user?user=$id';</script>";
        exit();
    }

    // Consulta SQL preparada para actualizar los datos del usuario
    $query = "UPDATE usuarios 
              SET nombre = ?, apellidos = ?, dni = ?, tel = ?, fechanacimiento = ?, email = ?, password = ?
              WHERE id = ?";
    $stmt = $conn->prepare($query);

    // Verificación adicional en caso de que la preparación falle
    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        echo "<script>alert('Error interno del servidor.'); window.location.href = '/';</script>";
        exit();
    }

    // Asociar parámetros a la consulta preparada
    $stmt->bind_param('sssssssi', $nombre, $apellidos, $dni, $tel, $fechanacimiento, $email, $password, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        echo "<script>alert('El usuario ha sido actualizado correctamente.'); window.location.href = '/';</script>";
    } else {
        // Log interno del error y mensaje genérico
        error_log("Error al ejecutar la actualización: " . $stmt->error);
        echo "<script>alert('Hubo un error al actualizar el usuario.'); window.location.href = '/modify_user?user=$id';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Evitar accesos no autorizados
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '/';</script>";
    exit();
}
?>
