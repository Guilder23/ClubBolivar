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

<!-- Modal de Login -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModalLogin()">&times;</span>
        <h2>Iniciar Sesión</h2>
        <form id="formLogin" method="POST" action="includes/auth.php">
            <input type="hidden" name="accion" value="login">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn-primary">Entrar</button>
        </form>
        <div id="mensajeLogin"></div>
    </div>
</div>
