<?php
    session_start();
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    // Conexión a la base de datos
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Error de conexión a la DB: " . $conn->connect_error);
    }

    // Obtener el ID del item desde la URL
    if (isset($_GET['item'])) {
        $item_id = $_GET['item'];
        
        // Consulta para obtener la información del alimento
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
    <h1 class="text-center">Modificar alimento</h1>
    <h3 class="text-center mt-3">Alimento: <?php echo $item['nombre']; ?> (ID: <?php echo $item_id; ?>)</h3> <!-- Nombre e ID del alimento -->
    <div class="card shadow mt-5 p-4">
        <form id="item_modify_form" action="modify_item_handler.php" method="POST" class="mt-4">
            <!-- El ID del alimento es un campo oculto para enviarlo al handler -->
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <div class="mb-3">
                <label for="fcompra" class="form-label">Fecha de compra</label>
                <input type="date" class="form-control" id="fcompra" name="fcompra" value="<?php echo $item['fcompra']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fcaducidad" class="form-label">Fecha de caducidad</label>
                <input type="date" class="form-control" id="fcaducidad" name="fcaducidad" value="<?php echo $item['fcaducidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="calorias" class="form-label">Calorías</label>
                <input type="number" class="form-control" id="calorias" name="calorias" value="<?php echo $item['calorias']; ?>" required min="0">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $item['precio']; ?>" required step="0.01" min="0">
            </div>
            <button type="submit" id="item_modify_submit" class="btn btn-primary w-100">Modificar alimento</button>
        </form>
    </div>

    <div class="mt-5 text-center">
            <a href="/items" class="text-dark">Volver al listado</a>
    </div>
</div>

<script src="./js/validar_item.js"></script>

<?php
    include 'templates/footer.php';
?>
