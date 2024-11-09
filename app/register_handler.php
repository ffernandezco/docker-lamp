<?php
    header('X-Frame-Options: DENY');
    session_start();

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Error de conexión a la DB: " . $conn->connect_error);
    }

    // Obtenemos los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $tel = $_POST['tel'];
        $fechanacimiento = $_POST['fechanacimiento'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validar que los campos no estén vacíos
        if (!empty($nombre) && !empty($apellidos) && !empty($dni) && !empty($tel) && !empty($fechanacimiento) && !empty($password) && !empty($email)) {
            // Ejecutar consulta SQL
            $query = "INSERT INTO usuarios (nombre, apellidos, dni, tel, fechanacimiento, email, password) VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fechanacimiento', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Usuario añadido. Ahora puedes iniciar sesión'); window.location.href = '/login';</script>";
            } else {
                echo "<script>alert('Error al añadir el usuario'); window.location.href = '/register';</script>";
            }
        } else {
            echo "<script>alert('Deben rellenarse todos los campos'); window.location.href = '/register';</script>";
        }
    }

    $conn->close();
?>
