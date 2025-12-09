<?php
// ===== FUNCIONES GLOBALES =====

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Verificar si el usuario está autenticado
 */
function estoy_autenticado() {
    return isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true;
}

/**
 * Obtener nombre del usuario autenticado
 */
function obtener_usuario_nombre() {
    return isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : '';
}

/**
 * Obtener rol del usuario autenticado
 */
function obtener_usuario_rol() {
    return isset($_SESSION['usuario_rol']) ? $_SESSION['usuario_rol'] : '';
}
?>
