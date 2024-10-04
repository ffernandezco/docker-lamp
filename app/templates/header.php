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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Inventario de Alimentos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_email'])): ?>
                <li class="nav-item">
                <a class="nav-link" href="/logout.php">Cerrar sesión</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                <a class="nav-link" href="/login">Iniciar sesión</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="/items">Alimentos</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-4">
