<?php
session_start();

// Configuración de la base de datos
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Conexión a la base de datos
$conn = mysqli_connect($hostname, $username, $password, $db);
if (!$conn) {
    die("Error de conexión a la DB.");
}

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar el ID
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($id === false) {
        echo "<script>alert('ID inválido.'); window.location.href = '/items';</script>";
        exit();
    }

    // Recoger y sanitizar otros datos del formulario
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $fcompra = filter_var(trim($_POST['fcompra']), FILTER_SANITIZE_STRING);
    $fcaducidad = filter_var(trim($_POST['fcaducidad']), FILTER_SANITIZE_STRING);
    $calorias = filter_var($_POST['calorias'], FILTER_VALIDATE_INT);
    $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);

    // Validación adicional para los campos numéricos
    if ($calorias === false || $precio === false) {
        echo "<script>alert('Datos inválidos: calorías o precio no son válidos.'); window.location.href = '/modify_item?item=$id';</script>";
        exit();
    }

    // Validación de formato de fecha
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fcompra) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fcaducidad)) {
        echo "<script>alert('Formato de fecha inválido. Use AAAA-MM-DD.'); window.location.href = '/modify_item?item=$id';</script>";
        exit();
    }

    // Consulta SQL preparada para actualizar los datos del alimento
    $query = "UPDATE alimentos 
              SET nombre = ?, fcompra = ?, fcaducidad = ?, calorias = ?, precio = ? 
              WHERE id = ?";
    $stmt = $conn->prepare($query);

    // Verificación adicional en caso de que la preparación falle
    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        echo "<script>alert('Error interno del servidor.'); window.location.href = '/items';</script>";
        exit();
    }

    // Asociar parámetros a la consulta preparada
    $stmt->bind_param('sssidi', $nombre, $fcompra, $fcaducidad, $calorias, $precio, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mensaje de éxito
        echo "<script>alert('El alimento ha sido actualizado correctamente.'); window.location.href = '/items';</script>";
    } else {
        // Log interno del error y mensaje genérico
        error_log("Error al ejecutar la actualización: " . $stmt->error);
        echo "<script>alert('Hubo un error al actualizar el alimento.'); window.location.href = '/modify_item?item=$id';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Evitar accesos no autorizados
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '/items';</script>";
    exit();
}
?>

