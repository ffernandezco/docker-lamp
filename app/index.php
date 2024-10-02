<?php
    // Encabezado y navbar con Bootstrap
    include './templates/header.php'; 

    // Conexión a la base de datos
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Consulta a la base de datos
    $query = mysqli_query($conn, "SELECT * FROM usuarios")
        or die(mysqli_error($conn));
?>

<div class="container">
        <h1 class="text-center">Inventario de alimentos</h1>
        <div class="card shadow p-4 mt-5">
            <p class="text-center">Este Sistema Web permite gestionar un <a href="/items">listado de alimentos</a> con sus diferentes atributos: nombre, fecha de compra, fecha de caducidad, calorías y precio. Desde el listado, es posible ver todos los detalles, modificarlos o eliminar un alimento, además de añadir nuevos.</p>
            <div class="text-center mb-4">
                <a href="/items" class="btn btn-primary d-inline-flex align-items-center">Todos los alimentos</a>
                <a href="/add_item" class="btn btn-secondary d-inline-flex align-items-center">Añadir alimento</a>
            </div>
        </div>

        <div class="card shadow p-4 mt-5">
            <p class="text-center">Además, también se dispone de un sistema de usuarios, en el que actualmente puedes:</p>
            <p class="text-center">
            <?php if (isset($_SESSION['user_email'])): ?>
                <a href="/logout.php" class="btn btn-danger d-inline-flex align-items-center">Cerrar sesión</a>
            <?php else: ?>
                <a href="/login" class="btn btn-success d-inline-flex align-items-center">Iniciar sesión</a>
                <a href="/register" class="btn btn-secondary d-inline-flex align-items-center">Registrarte</a>
            <?php endif; ?>
            </p>
        </div>
</div>

<?php
    // Pie de página con Bootstrap
    include './templates/footer.php'; 
?>
