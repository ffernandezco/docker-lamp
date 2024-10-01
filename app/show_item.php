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
            echo"<script>alert('¡Vaya! No hay ningún alimento con el ID introducido'); window.location.href = '/';</script>";
            exit();
        }
    } else {
        echo"<script>alert('Indica el alimento a través de la URL.'); window.location.href = '/';</script>";
        exit();
    }

    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Información del alimento</h1>
    <div class="card shadow mt-5 p-5">
        <p><strong>ID:</strong> <?php echo $item['id']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $item['nombre']; ?></p>
        <p><strong>Fecha de compra:</strong> <?php echo $item['fcompra']; ?></p>
        <p><strong>Fecha de caducidad:</strong> <?php echo $item['fcaducidad']; ?></p>
        <p><strong>Calorías:</strong> <?php echo $item['calorias']; ?> kcal</p>
        <p><strong>Precio:</strong> <?php echo $item['precio']; ?> €</p>

        <div class="d-flex gap-2 justify-content-center">
            <a href="/modify_item?item=<?php echo $item['id']; ?>" class="btn btn-primary d-inline-flex align-items-center" role="button">Modificar alimento</a>
            <a href="/delete_item?item=<?php echo $item['id']; ?>" class="btn btn-danger d-inline-flex align-items-center" role="button">Eliminar alimento</a>
        </div>
        <div class="mt-3 text-center">
            <a href="/items" class="text-dark">Volver al listado</a>
        </div>
    </div>
</div>

<?php
    include 'templates/footer.php';
?>
