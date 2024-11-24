<?php
session_start();
include 'templates/header.php';

// Obtener el mensaje de error de la URL
$error_message = '';
$redirect_url = '/'; // URL de redirección predeterminada

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'insert':
            $error_message = 'Error al añadir el alimento. Inténtalo de nuevo.';
            break;
        case 'prepare':
            $error_message = 'Error al preparar la consulta.';
            break;
        case 'emptyfields':
            $error_message = 'Deben completarse todos los campos.';
            break;
        case 'delete':
            $error_message = 'Error al eliminar el alimento. Inténtalo de nuevo.';
            $redirect_url = '/items';
            break;
        case 'invalidnumeric':
            $error_message = 'Datos inválidos: calorías o precio no son válidos.';
            $redirect_url = '/modify_item.php';
            break;
        case 'invaliddate':
            $error_message = 'Formato de fecha inválido. Use AAAA-MM-DD.';
            $redirect_url = '/modify_item.php';
            break;
        case 'update':
            $error_message = 'Hubo un error al actualizar el alimento.';
            $redirect_url = '/modify_item.php';
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
        <a href="<?php echo $redirect_url; ?>" class="btn btn-primary">Volver a inicio</a>
    </div>
</div>

<?php
include 'templates/footer.php';
?>
