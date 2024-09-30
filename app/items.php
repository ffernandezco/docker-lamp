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
    <h1 class="text-center">Lista de alimentos</h1>
    <p class="text-center">A continuación se muestra el listado completo de alimentos junto con su fecha de caducidad. Puedes obtener más información pulsando sobre su nombre, o bien modificarlo o eliminarlo con los accesos que aparecen.</p>
    <div class="text-center mb-4">
        <a href="/add_item" class="btn btn-primary d-inline-flex align-items-center">Añadir Alimento</a>
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
