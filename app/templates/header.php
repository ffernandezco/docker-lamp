<?php
    session_start(); // Asegúrate de que la sesión se inicia antes de cualquier HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario de Alimentos</title>

    <!-- Bootstrap v5.3.3 - CSS - MIT License (https://github.com/twbs/bootstrap/blob/v5.3.3/LICENSE)-->
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navegación creada a partir de Bootstrap Examples: https://getbootstrap.com/docs/5.3/examples/headers/ -->
<nav class="py-2 bg-body-tertiary border-bottom">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><a href="/" class="nav-link link-body-emphasis px-2">Inicio</a></li>
        <li class="nav-item"><a href="/items" class="nav-link link-body-emphasis px-2">Alimentos</a></li>
        <li class="nav-item"><a href="/add_item" class="nav-link link-body-emphasis px-2">Añadir alimento</a></li>
      </ul>
      <ul class="nav">
        <?php if (isset($_SESSION['user_email'])): ?>
            <li class="nav-item"><a class="nav-link link-body-emphasis px-2" href="/show_user?user=<?php echo $_SESSION['id']; ?>">Ver perfil</a></li>
            <li class="nav-item"><a class="nav-link link-body-emphasis px-2" href="/modify_user?user=<?php echo $_SESSION['id']; ?>">Editar perfil</a></li>
            <li class="nav-item"><a class="nav-link link-body-emphasis px-2" href="/logout.php">Cerrar sesión</a></li>
        <?php else: ?>
            <li class="nav-item"><a href="/login" class="nav-link link-body-emphasis px-2">Iniciar sesión</a></li>
        <li class="nav-item"><a href="/register" class="nav-link link-body-emphasis px-2">Registrarse</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
<div class="container mt-4">
