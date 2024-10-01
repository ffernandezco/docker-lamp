<?php
    session_start();
    include 'templates/header.php';
?>

<div class="container mt-5 col-md-8">
    <h1 class="text-center">Añadir alimento</h1>
    <div class="card shadow mt-5 p-4">
        <form id="item_add_form" action="add_item_handler.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del alimento</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Alimento" required>
            </div>
            <div class="mb-3">
                <label for="fcompra" class="form-label">Fecha de compra</label>
                <input type="date" class="form-control" id="fcompra" name="fcompra" placeholder="XXXX-XX-XX" required>
            </div>
            <div class="mb-3">
                <label for="fcaducidad" class="form-label">Fecha de caducidad</label>
                <input type="date" class="form-control" id="fcaducidad" name="fcaducidad" placeholder="XXXX-XX-XX" required>
            </div>
            <div class="mb-3">
                <label for="calorias" class="form-label">Calorías</label>
                <input type="number" class="form-control" id="calorias" name="calorias" placeholder="XXX (kcal)" required min="0">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" id="precio" name="precio" required step="0.01" placeholder="X,XX (€) "min="0">
            </div>
            <button type="submit" id="item_add_submit" class="btn btn-primary w-100">Añadir alimento</button>
        </form>
    </div>

    <div class="mt-5 text-center">
            <a href="/items" class="text-dark">Volver al listado</a>
    </div>
</div>

<script src="./js/validar_item.js"></script>

<?php
    include 'templates/footer.php';
?>
