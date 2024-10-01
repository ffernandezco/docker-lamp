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

    // Obtener el ID del item desde la URL
    if (isset($_GET['item'])) {
        $item_id = $_GET['item'];

        $query = "SELECT * FROM alimentos WHERE id = $item_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $item = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('¡Vaya! No hay ningún alimento con el ID introducido.'); window.location.href = '/items';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Indica el alimento a través de la URL.'); window.location.href = '/items';</script>";
        exit();
    }

    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Eliminar alimento</h1>
    <div class="card shadow mt-5 p-5">
        <p>¿Estás seguro de que deseas eliminar el alimento <strong><?php echo $item['nombre']; ?></strong> (<em>ID: <?php echo $item['id']; ?></em>)?</p>

        <form id="item_delete_form" action="delete_item_handler.php" method="POST" class="mt-3">
            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
            <button type="submit" id="item_delete_submit" class="btn btn-danger">Confirmar eliminación</button>
        </form>
    </div>

    <div class="mt-5 text-center">
            <a href="/items" class="text-dark">Volver al listado</a>
    </div>

</div>


<?php
    include 'templates/footer.php';
?>
