<?php
    session_start(); // Inicia la sesión
    if (isset($_SESSION['user_email'])) {
        header('Location: /'); // Redirige si ya está logueado
        exit();
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
            <form id="login_form" action="login_handler.php" method="POST">
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="usuario@dominio.com" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3" id="login_submit">Iniciar sesión</button>
            </form>
            <div class="mt-5 text-center text-dark">
                <p>¿No tienes cuenta? <a href="/register">Regístrate ahora</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap v5.3.3 - JS - MIT License (https://github.com/twbs/bootstrap/blob/v5.3.3/LICENSE)-->
    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
