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
        die("Error de conexión a la DB: " . $conn->connect_error);
    }

    // Verificar si el formulario fue enviado mediante POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recoger los datos enviados desde el formulario
        $id = $_POST['id']; // El ID del alimento
        $fcompra = $_POST['fcompra'];
        $fcaducidad = $_POST['fcaducidad'];
        $calorias = $_POST['calorias'];
        $precio = $_POST['precio'];

        // Consulta SQL para actualizar los datos del alimento
        $query = "UPDATE alimentos 
                  SET fcompra = ?, fcaducidad = ?, calorias = ?, precio = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssiii', $fcompra, $fcaducidad, $calorias, $precio, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir con un mensaje de éxito
            echo "<script>alert('¡El alimento ha sido actualizado correctamente!'); window.location.href = '/items';</script>";
        } else {
            // Redirigir con un mensaje de error si falla
            echo "<script>alert('Hubo un error al actualizar el alimento.'); window.location.href = '/modify_item?item=$id';</script>";
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        // Evitar accesos no autorizados
        echo "<script>alert('Acceso no autorizado.'); window.location.href = '/items';</script>";
        exit();
    }
?>
