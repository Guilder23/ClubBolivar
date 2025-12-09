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

// ===== FUNCIONES PARA MODALES GENERALES =====

function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.add('show');
    }
}

function cerrarModal(idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.remove('show');
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

// ===== MANEJO DE RESPUESTAS DEL SERVIDOR =====

function mostrarAlerta(tipo, mensaje) {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo}`;
    alerta.textContent = mensaje;

    const container = document.querySelector('main') || document.body;
    container.insertBefore(alerta, container.firstChild);

    // Auto-remover después de 5 segundos
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}

// ===== CARGAR DATOS VÍA AJAX =====

function cargarDatos(url, callback) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => callback(data))
        .catch(error => {
            console.error('Error:', error);
            mostrarAlerta('error', 'Error al cargar los datos');
        });
}

// ===== ENVIAR FORMULARIO VÍA AJAX =====

function enviarFormulario(formulario, callback) {
    const formData = new FormData(formulario);
    const action = formulario.getAttribute('action');
    const method = formulario.getAttribute('method') || 'POST';

    fetch(action, {
        method: method,
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                mostrarAlerta('success', data.mensaje);
                if (typeof callback === 'function') {
                    callback(data);
                }
            } else {
                mostrarAlerta('error', data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarAlerta('error', 'Error al procesar la solicitud');
        });
}