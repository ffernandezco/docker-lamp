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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $item_id = $_POST['item_id'];

        // Ejecutar consulta SQL asegurándonos de que se ha indicado un ID correcto
        if (!empty($item_id)) {
            $query = "DELETE FROM alimentos WHERE id = $item_id";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Alimento eliminado.'); window.location.href = '/items';</script>";
            } else {
                echo "<script>alert('Error al eliminar el alimento.'); window.location.href = '/items';</script>";
            }
        } else {
            echo "<script>alert('ID del alimento no válido. Revisa la petición realizada.'); window.location.href = '/';</script>";
        }
    }

    $conn->close();
?>
