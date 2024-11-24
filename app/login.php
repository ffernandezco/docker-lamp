<?php
session_start(); // Inicia o reanuda la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $email = htmlentities($_POST['email']);
    
    // Simula autenticación (valida email y password - ajusta esto según tu lógica real)
    $password = $_POST['password']; 
    if (isset($_SESSION['id'])) { // Cambia esto por la validación real
        // Configura cookie con HttpOnly y SameSite (opcional)
        setcookie('email', $email, time() + 3600, "/; SameSite=Strict", "", true, true);

        // Establece variables de sesión
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;

        // Redirige a index.php
        header("Location: /");
        exit();
    } else {
        $error_message = "Credenciales inválidas, por favor inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6">
        <div class="card shadow p-5">
            <h1 class="text-center mb-4">¡Hola!</h1>
            <p class="text-center">Inicia sesión con tu correo electrónico y contraseña</p>

            <!-- Mensaje de error (opcional, usando un parámetro GET) -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?php echo htmlentities($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/login_handler.php">
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="usuario@dominio.com" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
                </div>

                <!-- Token CSRF para mayor seguridad -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                <button type="submit" name="enviar" class="btn btn-primary w-100 mt-3" value="enviar" id="login_submit">Iniciar sesión</button>
            </form>
            <div class="mt-5 text-center text-dark">
                <p>¿No tienes cuenta? <a href="/register">Regístrate ahora</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap v5.3.3 - JS -->
    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>

