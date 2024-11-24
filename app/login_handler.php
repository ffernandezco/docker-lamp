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
        header("Location: /login_error.php?error=invalid");
        exit();
    }

    // Consulta SQL preparada para evitar SQL Injection
    $query = "SELECT id, email, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        header("Location: /login_error.php?error=prepare");
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

            // Registrar el inicio de sesión en LogsUsuarios
            $logQuery = "INSERT INTO LogsUsuarios (id, correo, FechaHoraConexion, conectado) VALUES (?, ?, NOW(), 1)";
            $logStmt = $conn->prepare($logQuery);

            if ($logStmt) {
                $logStmt->bind_param('ss', $user['id'], $user['email']);
                $logStmt->execute();
                $logStmt->close();
            } else {
                error_log("Error al registrar el log: " . $conn->error);
            }

            header("Location: /");
            exit();
        } else {
            header("Location: /login_error.php?error=password");
            exit();
        }
    } else {
        header("Location: /login_error.php?error=user");
        exit();
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Redirigir si el acceso no es mediante POST
    header("Location: /login_error.php?error=unauthorized");
    exit();
}
?>
