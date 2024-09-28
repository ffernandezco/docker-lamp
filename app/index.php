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
  <h1 class="text-center">Bienvenido al Inventario de Alimentos</h1>
  <p class="text-center">Gestiona tus alimentos de forma sencilla y rápida.</p>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    // Pie de página con Bootstrap
    include './templates/footer.php'; 
?>
