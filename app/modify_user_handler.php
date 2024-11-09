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
        // Recoger los datos enviados desde el formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $tel = $_POST['tel'];
        $fechanacimiento = $_POST['fechanacimiento'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Consulta SQL para actualizar los datos del alimento
        $query = "UPDATE usuarios 
                  SET nombre = ?, apellidos = ?, dni = ?, tel = ?, fechanacimiento = ?, email = ?, password = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssi', $nombre, $apellidos, $dni, $tel, $fechanacimiento, $email, $password, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir con un mensaje de éxito
            echo "<script>alert('El usuario ha sido actualizado correctamente.'); window.location.href = '/';</script>";
        } else {
            // Redirigir con un mensaje de error si falla
            echo "<script>alert('Hubo un error al actualizar el usuario.'); window.location.href = '/modify_user?user=$id';</script>";
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        // Evitar accesos no autorizados
        echo "<script>alert('Acceso no autorizado.'); window.location.href = '/';</script>";
        exit();
    }
?>
