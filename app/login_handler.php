<?php
    session_start();

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";
    
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Error de conexión a la BD: " . $conn->connect_error);
    }

    // Obtenemos los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Comprobamos vía SQL si el login es correcto
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Iniciar la sesión
        $_SESSION['user_email'] = $email;
        echo "<script>alert('¡Bienvenido! Has iniciado sesión correctamente'); window.location.href = '/';</script>";
    } else {
        echo "<script>alert('¡Vaya! El usuario o la contraseña introducidos no son correctos. Inténtalo de nuevo.'); window.location.href = '/login';</script>";
    }
?>
