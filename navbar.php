<?php
// ===== NAVBAR INCLUIBLE PARA TODAS LAS PÁGINAS =====
// Incluir en todas las páginas: <?php include 'navbar.php'; ?>

// Incluir configuración y funciones
require_once __DIR__ . '/config/database.php';
?>

<nav class="navbar-fixed">
    <div class="logo">Bolívar por Siempre</div>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="mision.php">Misión y Visión</a></li>
        <li><a href="opinion.php">Opinión</a></li>
        <li><a href="destacado.php">Lo Último</a></li>
        <li><a href="historia.php">Historia</a></li>
        <li><a href="tabla.php">Tabla</a></li>
        <?php if(estoy_autenticado()): ?>
            <li><a href="admin/dashboard.php" style="color: #51cf66; font-weight: 600;">⚙️ Admin</a></li>
            <li><a href="includes/auth.php?logout=1">Salir</a></li>
        <?php else: ?>
            <li><a href="#" class="btn-login" onclick="abrirModalLogin(event)" style="background: linear-gradient(135deg, #5a7bb7, #1e3a5f); color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Modal de Login Mejorado -->
<div id="loginModal" class="modal">
    <div class="modal-content modal-login">
        <span class="close" onclick="cerrarModalLogin()">&times;</span>
        <div class="login-header">
            <h3>Acceso Administrativo</h3>
            <p>Panel de Control - Bolivar por siempre</p>
        </div>
        <form id="formLogin" method="POST" action="includes/auth.php" class="form-login">
            <input type="hidden" name="accion" value="login">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
            </div>
            <button type="submit" class="btn-login-submit">Iniciar Sesión</button>
        </form>
        <div id="mensajeLogin" class="mensaje-login"></div>
    </div>
</div>

<style>
    .modal-login {
        min-width: 380px;
        border-radius: 12px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        background: white;
        overflow: hidden;
    }

    .login-header {
        background: linear-gradient(135deg, #1e3a5f 0%, #5a7bb7 100%);
        color: white;
        padding: 30px 25px;
        text-align: center;
    }

    .login-header h2 {
        margin: 0;
        font-size: 1.6em;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .login-header p {
        margin: 0;
        font-size: 0.95em;
        opacity: 0.9;
    }

    .form-login {
        padding: 30px 25px;
    }

    .form-login .form-group {
        margin-bottom: 20px;
    }

    .form-login label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1e3a5f;
        font-size: 0.95em;
    }

    .form-login input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1em;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s ease;
    }

    .form-login input:focus {
        outline: none;
        border-color: #5a7bb7;
        box-shadow: 0 0 0 3px rgba(90, 123, 183, 0.1);
    }

    .btn-login-submit {
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #5a7bb7, #1e3a5f);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.05em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-login-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 58, 95, 0.3);
    }

    .btn-login-submit:active {
        transform: translateY(0);
    }

    .mensaje-login {
        margin-top: 15px;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 0.95em;
        text-align: center;
    }

    .mensaje-login.error {
        background-color: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    .mensaje-login.success {
        background-color: #efe;
        color: #3c3;
        border: 1px solid #cfc;
    }
</style>
