// ===== FUNCIONES PARA MODAL DE LOGIN =====

function abrirModalLogin(event) {
    event.preventDefault();
    document.getElementById('loginModal').classList.add('show');
}

function cerrarModalLogin() {
    document.getElementById('loginModal').classList.remove('show');
}

// Cerrar modal al hacer clic fuera del contenido
window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target == modal) {
        cerrarModalLogin();
    }
}

// ===== VALIDACIÓN DE FORMULARIOS =====

function validarFormulario(formulario) {
    const campos = formulario.querySelectorAll('[required]');
    let valido = true;

    campos.forEach(campo => {
        if (!campo.value.trim()) {
            campo.classList.add('error');
            valido = false;
        } else {
            campo.classList.remove('error');
        }
    });

    return valido;
}
