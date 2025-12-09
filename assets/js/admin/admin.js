// ===== FUNCIONES ADMIN =====

/**
 * Abrir modal para gestión
 */
function abrirModalAdmin(idModal, tipo = 'crear', id = null) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.add('show');
        
        // Si es editar o ver, cargar datos
        if ((tipo === 'editar' || tipo === 'ver') && id) {
            cargarDatosModal(idModal, id, tipo);
        }
        
        // Limpiar formulario si es crear
        if (tipo === 'crear') {
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
            }
        }
    }
}

/**
 * Cerrar modal
 */
function cerrarModalAdmin(idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.remove('show');
    }
}

/**
 * Cargar datos en modal
 */
function cargarDatosModal(idModal, id, tipo) {
    const modal = document.getElementById(idModal);
    const contenedor = modal.querySelector('.modal-body');
    
    fetch(`?accion=${tipo}&id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.text())
        .then(html => {
            if (contenedor) {
                contenedor.innerHTML = html;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarAlertaAdmin('error', 'Error al cargar los datos');
        });
}

/**
 * Mostrar alerta en admin
 */
function mostrarAlertaAdmin(tipo, mensaje) {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo}`;
    alerta.textContent = mensaje;
    alerta.style.cssText = 'position: fixed; top: 100px; right: 20px; z-index: 1001; max-width: 400px;';

    document.body.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 5000);
}

/**
 * Confirmar eliminación
 */
function confirmarEliminacion(id, tipo) {
    if (confirm(`¿Estás seguro de que deseas eliminar este ${tipo}?`)) {
        return true;
    }
    return false;
}

/**
 * Validar formulario admin
 */
function validarFormularioAdmin(formulario) {
    const campos = formulario.querySelectorAll('[required]');
    let valido = true;

    campos.forEach(campo => {
        if (!campo.value.trim()) {
            campo.classList.add('error');
            campo.style.borderColor = '#ff6b6b';
            valido = false;
        } else {
            campo.classList.remove('error');
            campo.style.borderColor = '#b3d1f7';
        }
    });

    return valido;
}

/**
 * Enviar formulario admin
 */
function enviarFormularioAdmin(formulario, callback) {
    if (!validarFormularioAdmin(formulario)) {
        mostrarAlertaAdmin('error', 'Por favor completa todos los campos requeridos');
        return;
    }

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
                mostrarAlertaAdmin('success', data.mensaje);
                if (typeof callback === 'function') {
                    setTimeout(callback, 1500);
                }
            } else {
                mostrarAlertaAdmin('error', data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarAlertaAdmin('error', 'Error al procesar la solicitud');
        });
}

// Cerrar modal al hacer clic fuera
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('show');
    }
});

// Cerrar modal con botón close
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('close-modal')) {
        const modal = event.target.closest('.modal');
        if (modal) {
            modal.classList.remove('show');
        }
    }
});