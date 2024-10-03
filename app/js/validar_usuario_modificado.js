document.getElementById('user_modify_form').addEventListener('submit', function(event) {
    let dni = document.getElementById('dni').value;
    let tel = document.getElementById('tel').value;
    let email = document.getElementById('email').value;

    // Validar DNI
    if (!validarDni(dni)) {
        alert('DNI inválido. Debe seguir el formato 12345678A con letra correcta.');
        event.preventDefault();  // Prevenir el registro
        return;
    }

    // Validar teléfono
    if (!/^\d{9}$/.test(tel)) { // 9 dígitos
        alert('Número de teléfono inválido. Debe tener 9 dígitos.');
        event.preventDefault();  // Prevenir el registro
        return;
    }

    // Validar correo electrónico
    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        alert('Correo electrónico inválido.');
        event.preventDefault();  // Prevenir el registro
        return;
    }
});

// Función para validar la letra del DNI
// Fuente: https://localhorse.net/article/como-validar-dni-espanol-con-javascript
function validarDni(dni) {
    var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
    var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
    var nieRexp = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
    var str = dni.toString().toUpperCase();

    if (!nifRexp.test(str) && !nieRexp.test(str)) {
        return false;
    }

    var nie = str.replace(/^[X]/, '0').replace(/^[Y]/, '1').replace(/^[Z]/, '2');
    var letter = str.substr(-1);
    var charIndex = parseInt(nie.substr(0, 8)) % 23;

    if (validChars.charAt(charIndex) === letter) {
        return true;
    }

    return false;
}
