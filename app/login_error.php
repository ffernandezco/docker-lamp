<?php
session_start();
include 'templates/header.php';

// Obtener el mensaje de error de la URL
$error_message = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalid':
            $error_message = 'Por favor, introduce un correo y una contraseña válidos.';
            break;
        case 'prepare':
            $error_message = 'Error interno del servidor.';
            break;
        case 'password':
            $error_message = 'La contraseña introducida es incorrecta.';
            break;
        case 'user':
            $error_message = 'El usuario no existe. Por favor, revisa tu correo y vuelve a intentarlo.';
            break;
        case 'invaliddate':
            $error_message = 'Formato de fecha inválido. Use AAAA-MM-DD.';
            break;
        case 'general':
            $error_message = 'Datos inválidos o incompletos.';
            break;
        case 'update':
            $error_message = 'Hubo un problema al actualizar el usuario. Por favor, inténtalo más tarde.';
            break;
        default:
            $error_message = 'Ocurrió un error desconocido.';
    }
}
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Error</h1>
    <div class="alert alert-danger mt-5 p-4" role="alert">
        <?php echo $error_message; ?>
    </div>

    <div class="mt-5 text-center">
        <a href="/" class="btn btn-primary">Volver a inicio</a>
    </div>
</div>

<?php
include 'templates/footer.php';
?>
