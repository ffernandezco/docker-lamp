<?php
    session_start();
    session_destroy(); // Destruye la sesión actual
    header('Location: /'); // Redirige a la página de inicio de sesión
    exit();
?>