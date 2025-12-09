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
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception('Error de conexión: ' . $conn->connect_error);
    }
    
    // Establecer charset a UTF-8
    $conn->set_charset('utf8mb4');
    
} catch (Exception $e) {
    die('Error en la configuración de base de datos: ' . $e->getMessage());
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
    return isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_rol']);
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
 * Cargar usuario de la sesión
 */
function obtener_usuario_actual() {
    if (!estoy_autenticado()) {
        return null;
    }
    
    global $conn;
    $usuario_id = $_SESSION['usuario_id'];
    $resultado = $conn->query("SELECT * FROM usuarios WHERE id = $usuario_id LIMIT 1");
    
    if ($resultado && $resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    }
    
    return null;
}
?>