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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];

    // Validar que el ID no esté vacío
    if (!empty($item_id)) {
        // Preparar consulta SQL para evitar inyección
        $query = "DELETE FROM alimentos WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Asociar el parámetro como entero
            $stmt->bind_param("i", $item_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<script>alert('Alimento eliminado.'); window.location.href = '/items';</script>";
            } else {
                echo "<script>alert('Error al eliminar el alimento.'); window.location.href = '/items';</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Error al preparar la consulta.'); window.location.href = '/items';</script>";
        }
    } else {
        echo "<script>alert('ID del alimento no válido. Revisa la petición realizada.'); window.location.href = '/';</script>";
    }
}

$conn->close();
?>
