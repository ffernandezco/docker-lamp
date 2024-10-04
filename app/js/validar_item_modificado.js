document.getElementById('item_modify_form').addEventListener('submit', function (event) {

    // Obtener valores del formulario
    const nombre = document.getElementById('nombre').value.trim();
    const fcompra = document.getElementById('fcompra').value;
    const fcaducidad = document.getElementById('fcaducidad').value;
    const calorias = document.getElementById('calorias').value;
    const precio = document.getElementById('precio').value;

    // Comprobar que todos los campos se han rellenado correctamente y que son superiores a 0 en caso de los números
    if (!nombre || !fcompra || !fcaducidad || calorias <= 0 || precio <= 0) {
        alert('Por favor, rellena todos los campos correctamente. Todos son obligatorios y las calorías y el precio deben ser superiores a 0.');
        event.preventDefault();
    }

    // Fechas de caducidad
    if (new Date(fcaducidad) < new Date(fcompra)) {
        alert('La fecha de caducidad no debe ser anterior a la fecha de compra. Por favor, comprueba el campo.');
        event.preventDefault();
    }
});
