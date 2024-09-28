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
$query = mysqli_query($conn, "SELECT id, nombre, fcaducidad FROM alimentos");
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<div class="container">
    <h1 class="text-center">Lista de Alimentos</h1>
    <!-- Botones para añadir y eliminar alimentos -->
    <div class="text-center mb-4">
        <a href="añadir_alimento.php" class="btn btn-success">Añadir Alimento</a>
        <a href="eliminar_alimento.php" class="btn btn-danger">Eliminar Alimento</a>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de Caducidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>
                            <td>
                                <a href='alimento.php?id=" . htmlspecialchars($row['id']) . "' class='text-dark' style='text-decoration: none;'>"
                                    . htmlspecialchars($row['nombre']) . 
                                "</a>
                            </td>
                            <td>" . htmlspecialchars($row['fcaducidad']) . "</td>
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
