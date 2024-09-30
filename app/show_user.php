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

    // Obtener el ID del usuario desde la URL
    if (isset($_GET['user'])) {
        $user_id = $_GET['user'];
        
        $query = "SELECT * FROM usuarios WHERE id = $user_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        } else {
            echo"<script>alert('¡Vaya! No hay ningún usuario con el ID introducido'); window.location.href = '/';</script>";
            exit();
        }
    } else {
        echo"<script>alert('Indica el usuario a través de la URL.'); window.location.href = '/';</script>";
        exit();
    }

    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Información del usuario</h1>
    <div class="card shadow mt-5 p-5">
        <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $user['nombre']; ?></p>
        <p><strong>Apellidos:</strong> <?php echo $user['apellidos']; ?></p>
        <p><strong>DNI:</strong> <?php echo $user['dni']; ?></p>
        <p><strong>Correo electrónico:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $user['tel']; ?></p>
        <p><strong>Fecha de nacimiento:</strong> <?php echo $user['fechanacimiento']; ?></p>

        <div class="d-flex gap-2 justify-content-center">
            <a href="/modify_user?user=<?php echo $user['id']; ?>" class="btn btn-primary d-inline-flex align-items-center" role="button">Modificar usuario</a>
        </div>
    </div>
</div>

<?php
    include 'templates/footer.php';
?>
