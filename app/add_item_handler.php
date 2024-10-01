<?php
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
        $fcompra = $_POST['fcompra'];
        $fcaducidad = $_POST['fcaducidad'];
        $calorias = $_POST['calorias'];
        $precio = $_POST['precio'];

        // Validar que los campos no estén vacíos
        if (!empty($nombre) && !empty($fcompra) && !empty($fcaducidad) && !empty($calorias) && !empty($precio)) {
            // Ejecutar consulta SSL
            $query = "INSERT INTO alimentos (nombre, fcompra, fcaducidad, calorias, precio) VALUES ('$nombre', '$fcompra', '$fcaducidad', '$calorias', '$precio')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Alimento añadido correctamente'); window.location.href = '/items';</script>";
            } else {
                echo "<script>alert('Error al añadir el alimento'); window.location.href = '/add_item';</script>";
            }
        } else {
            echo "<script>alert('Deben rellenarse todos los campos'); window.location.href = '/add_item';</script>";
        }
    }

    $conn->close();
?>
