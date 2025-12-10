<?php
// Incluir configuración
require_once __DIR__ . '/../config/database.php';

// ===== PROCESAR LOGIN =====
$error_login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'login') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    
    if (empty($usuario) || empty($contrasena)) {
        $error_login = 'Usuario y contraseña son requeridos.';
    } else {
        // ===== CREDENCIALES TEMPORALES (HARDCODEADAS) =====
        // Para desarrollo/pruebas mientras se configura la BD
        $usuarios_temp = [
            'admin' => [
                'id' => 1,
                'nombre' => 'Administrador',
                'contrasena' => 'admin123',
                'rol' => 'admin'
            ],
            'usuario' => [
                'id' => 2,
                'nombre' => 'Usuario Normal',
                'contrasena' => 'usuario123',
                'rol' => 'usuario'
            ]
        ];
        
        // Verificar si el usuario existe y la contraseña es correcta
        if (isset($usuarios_temp[$usuario]) && $usuarios_temp[$usuario]['contrasena'] === $contrasena) {
            // Login exitoso
            $_SESSION['usuario_id'] = $usuarios_temp[$usuario]['id']; // ID numérico
            $_SESSION['usuario_nombre'] = $usuarios_temp[$usuario]['nombre'];
            $_SESSION['usuario_usuario'] = $usuario;
            $_SESSION['usuario_rol'] = $usuarios_temp[$usuario]['rol'];
            $_SESSION['autenticado'] = true;
            
            // Redirigir según rol
            if ($usuarios_temp[$usuario]['rol'] === 'admin') {
                header('Location: ../admin/dashboard.php');
                exit();
            } else {
                header('Location: ../index.php');
                exit();
            }
        } else {
            $error_login = 'Usuario o contraseña incorrectos.';
        }
    }
}

// ===== PROCESAR LOGOUT =====
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>