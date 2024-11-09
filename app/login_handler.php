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
    die("Error de conexión a la BD: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar el email y la contraseña
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Verificación básica del email y la contraseña
    if (!$email || empty($password)) {
        echo "<script>alert('Por favor, introduce un correo y una contraseña válidos.'); window.location.href = '/login';</script>";
        exit();
    }

    // Consulta SQL preparada para evitar SQL Injection
    $query = "SELECT id, email, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        echo "<script>alert('Error interno del servidor.'); window.location.href = '/login';</script>";
        exit();
    }

    // Asociar parámetros a la consulta preparada
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con el email proporcionado
    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $user = $result->fetch_assoc();

        // Verificar la contraseña encriptada
        if (password_verify($password, $user['password'])) {
            // Guardar los datos del usuario en la sesión
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            echo "<script>alert('¡Bienvenido! Has iniciado sesión correctamente'); window.location.href = '/';</script>";
        } else {
            echo "<script>alert('La contraseña introducida es incorrecta.'); window.location.href = '/login';</script>";
        }
    } else {
        echo "<script>alert('El usuario no existe. Por favor, revisa tu correo y vuelve a intentarlo.'); window.location.href = '/login';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Redirigir si el acceso no es mediante POST
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '/login';</script>";
    exit();
}
?>

