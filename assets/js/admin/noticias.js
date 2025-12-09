// ===== FUNCIONES PARA GESTIÓN DE NOTICIAS =====

/**
 * Cargar datos del modal para editar/ver
 */
function cargarDatosNoticia(idModal, id, tipo) {
    const modal = document.getElementById(idModal);
    if (!modal) return;

    fetch(`?accion=${tipo}&id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.text())
        .then(html => {
            const modalBody = modal.querySelector('.modal-body');
            if (modalBody) {
                modalBody.innerHTML = html;
            }
            abrirModalAdmin(idModal);
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarAlertaAdmin('error', 'Error al cargar la noticia');
        });
}