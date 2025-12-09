<?php
// ===== CONFIGURACIÓN DE BASE DE DATOS =====
// Cambiar estos valores según tu configuración

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'club_bolivar';

// ===== CONFIGURACIÓN GENERAL =====
const APP_NAME = 'Club Bolívar';
const APP_URL = 'http://localhost/ClubBolivar';
const UPLOAD_PATH = __DIR__ . '/../assets/img/uploads/';
const UPLOAD_URL = '/ClubBolivar/assets/img/uploads/';

// ===== CREAR CONEXIÓN A LA BASE DE DATOS =====
$conn = null;
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verificar conexión
    if ($conn->connect_error) {
        // No lanzar excepción, solo establecer $conn = null
        $conn = null;
    } else {
        // Establecer charset a UTF-8
        $conn->set_charset('utf8mb4');
    }
    
} catch (Exception $e) {
    // Si hay error, dejar $conn como null
    $conn = null;
}

// ===== CONFIGURACIÓN DE SESIÓN =====
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== FUNCIONES ÚTILES =====

/**
 * Validar si el usuario está autenticado
 */
function estoy_autenticado() {
    return (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) || 
           (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_rol']));
}

/**
 * Validar si el usuario es administrador
 */
function es_admin() {
    return estoy_autenticado() && $_SESSION['usuario_rol'] === 'admin';
}

/**
 * Redirigir a login si no está autenticado
 */
function requerir_autenticacion() {
    if (!estoy_autenticado()) {
        $_SESSION['error'] = 'Debes iniciar sesión para acceder a esta página.';
        header('Location: /ClubBolivar/index.php');
        exit();
    }
}

/**
 * Redirigir a login si no es admin
 */
function requerir_admin() {
    if (!es_admin()) {
        $_SESSION['error'] = 'No tienes permisos para acceder a esta página.';
        header('Location: /ClubBolivar/index.php');
        exit();
    }
}

/**
 * Escapar entrada del usuario
 */
function escapar($datos) {
    global $conn;
    return $conn->real_escape_string($datos);
}

/**
 * Mostrar mensaje flash
 */
function obtener_mensaje($tipo = 'info') {
    if (isset($_SESSION[$tipo])) {
        $mensaje = $_SESSION[$tipo];
        unset($_SESSION[$tipo]);
        return $mensaje;
    }
    return null;
}

/**
 * Establecer mensaje flash
 */
function establecer_mensaje($tipo, $mensaje) {
    $_SESSION[$tipo] = $mensaje;
}

/**
 * Validar token CSRF
 */
function generar_token_csrf() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verificar token CSRF
 */
function verificar_token_csrf($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Cargar usuario de la sesión - versión compatible con BD
 */
function cargar_usuario_bd() {
    if (!estoy_autenticado()) {
        return null;
    }
    
    global $conn;
    if ($conn === null) return null;
    
    $usuario_id = $_SESSION['usuario_id'];
    $resultado = $conn->query("SELECT * FROM usuarios WHERE id = $usuario_id LIMIT 1");
    
    if ($resultado && $resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    }
    
    return null;
}

/**
 * Obtener datos completos del usuario autenticado
 * Compatible con ambos sistemas: BD y sesión local
 */
function obtener_usuario_actual() {
    $usuario = [
        'id' => isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '',
        'nombre' => isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : 'Usuario',
        'usuario' => isset($_SESSION['usuario_usuario']) ? $_SESSION['usuario_usuario'] : '',
        'rol' => isset($_SESSION['usuario_rol']) ? $_SESSION['usuario_rol'] : 'usuario'
    ];
    return $usuario;
}
?>