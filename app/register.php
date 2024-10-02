<?php
    session_start();
    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Regístrate</h1>
    <div class="card shadow mt-5 p-4">
        <form id="register_form" action="register_handler.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Jon" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="García" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="11111111A" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="612345678" required>
            </div>
            <div class="mb-3">
                <label for="fechanacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="XXXX-XX-XX" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@servidor.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" id="register_submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>
    <div class="mt-3 text-center">
            <a href="/" class="text-dark">Volver a inicio</a>
    </div>
</div>

<script src="./js/validar_usuario.js"></script>

<?php
    include 'templates/footer.php';
?>
