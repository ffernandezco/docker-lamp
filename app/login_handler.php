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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Comprobamos vía SQL si el login es correcto
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Obtenemos los datos del usuario desde el resultado
        $user = mysqli_fetch_assoc($result);

        // Guardamos el id y el email del usuario en la sesión
        $_SESSION['id'] = $user['id']; // Asegúrate de que el campo 'id' es correcto
        $_SESSION['user_email'] = $user['email'];
        

        echo "<script>alert('¡Bienvenido! Has iniciado sesión correctamente'); window.location.href = '/';</script>";
    } else {
        echo "<script>alert('¡Vaya! El usuario o la contraseña introducidos no son correctos. Inténtalo de nuevo.'); window.location.href = '/login';</script>";
    }
?>
