<?php
    session_start();
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id'])) {
        echo "<script>alert('Debes iniciar sesión para acceder a esta página.'); window.location.href = '/login';</script>";
        exit();
    }

    // Conexión a la base de datos
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Error de conexión a la DB: " . $conn->connect_error);
    }

    // Obtener el ID del usuario a partir de la URL
    if (isset($_GET['user'])) {
        $user_id = $_GET['user'];

        // Verificar si el usuario es correcto
        if ($user_id != $_SESSION['id']) {
            echo "<script>alert('No tienes permiso para modificar este usuario. Inicia sesión con el mismo usuario que quieres modificar.'); window.location.href = '/';</script>";
            exit();
        }

        // Obtener información del usuario
        $query = "SELECT * FROM usuarios WHERE id = $user_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $item = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('¡Vaya! No hay ningún usuario con el ID introducido.'); window.location.href = '/';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Indica el usuario a través de la URL.'); window.location.href = '/';</script>";
        exit();
    }

    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Modificar usuario "<?php echo $item['nombre']; ?> <?php echo $item['apellidos']; ?>"</h1>
    <div class="card shadow mt-5 p-4">
        <form id="user_modify_form" action="modify_user_handler.php" method="POST" class="mt-4">
            <!-- El ID del usuario es un campo oculto para enviarlo al handler -->
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $item['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $item['apellidos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $item['dni']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $item['tel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fechanacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="<?php echo $item['fechanacimiento']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $item['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" id="user_modify_submit" class="btn btn-primary w-100">Modificar datos</button>
        </form>
    </div>
</div>

<script src="./js/validar_usuario_modificado.js"></script>

<?php
    include 'templates/footer.php';
?>
