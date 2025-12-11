<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

// Si ya está autenticado como admin, redirigir al panel
if (es_admin()) {
    header('Location: admin/dashboard.php');
    exit();
}

// Obtener noticias publicadas
$noticias = [];
$resultado = $conn->query("
    SELECT * FROM noticias 
    WHERE estado = 'publicado' 
    ORDER BY fecha_publicacion DESC 
    LIMIT 4
");

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $noticias[] = $fila;
    }
}

// Obtener tabla de posiciones
$tabla_posiciones = [];
$resultado = $conn->query("
    SELECT * FROM tabla_posiciones 
    WHERE estado = 'activo'
    ORDER BY posicion ASC
");

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $tabla_posiciones[] = $fila;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolivar por siempre - Inicio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar-fixed">
        <div class="logo">Bolivar por siempre</div>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#noticias">Noticias</a></li>
            <li><a href="#tabla">Tabla de Posiciones</a></li>
            <?php if (estoy_autenticado()): ?>
                <li><a href="admin/dashboard.php">Panel Admin</a></li>
                <li><a href="?logout=1" class="logout-btn">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="#" class="btn-login" onclick="abrirModalLogin(event)">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="page-container">
        <!-- HERO SECTION -->
        <div class="page-header">
            <img src="assets/img/principal.png" alt="Club Bolívar">
            <h1>Bolivar por siempre</h1>
        </div>

        <!-- NOTICIAS SECTION -->
        <section class="content-section" id="noticias">
            <div class="section-header">
                <h2>Últimas Noticias</h2>
                <div class="header-line"></div>
            </div>
            
            <?php if (!empty($noticias)): ?>
                <div class="noticias-grid">
                    <?php foreach ($noticias as $noticia): ?>
                        <article class="noticia-card">
                            <?php if (!empty($noticia['imagen'])): ?>
                                <img src="assets/img/uploads/<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                            <?php else: ?>
                                <img src="assets/img/principal.png" alt="Imagen por defecto">
                            <?php endif; ?>
                            <div class="noticia-content">
                                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                                <p class="noticia-fecha"><?php echo date('d/m/Y H:i', strtotime($noticia['fecha_publicacion'])); ?></p>
                                <p class="noticia-resumen">
                                    <?php 
                                    $resumen = substr($noticia['contenido'], 0, 150);
                                    echo htmlspecialchars($resumen);
                                    if (strlen($noticia['contenido']) > 150) echo '...';
                                    ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-content">
                    <p>No hay noticias publicadas en este momento.</p>
                </div>
            <?php endif; ?>
        </section>

        <!-- TABLA DE POSICIONES SECTION -->
        <section class="content-section" id="tabla">
            <div class="section-header">
                <h2>Tabla de Posiciones</h2>
                <div class="header-line"></div>
            </div>

            <?php if (!empty($tabla_posiciones)): ?>
                <div class="tabla-container">
                    <table class="standings-table">
                        <thead>
                            <tr>
                                <th>Pos</th>
                                <th>Equipo</th>
                                <th>PJ</th>
                                <th>PG</th>
                                <th>PE</th>
                                <th>PP</th>
                                <th>GF</th>
                                <th>GC</th>
                                <th>DG</th>
                                <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabla_posiciones as $equipo): ?>
                                <tr <?php echo $equipo['equipo'] === 'Club Bolívar' ? 'class="destacado"' : ''; ?>>
                                    <td><strong><?php echo $equipo['posicion']; ?></strong></td>
                                    <td><?php echo htmlspecialchars($equipo['equipo']); ?></td>
                                    <td><?php echo $equipo['partidos_jugados']; ?></td>
                                    <td><?php echo $equipo['partidos_ganados']; ?></td>
                                    <td><?php echo $equipo['partidos_empatados']; ?></td>
                                    <td><?php echo $equipo['partidos_perdidos']; ?></td>
                                    <td><?php echo $equipo['goles_favor']; ?></td>
                                    <td><?php echo $equipo['goles_contra']; ?></td>
                                    <td><?php echo $equipo['diferencia_goles']; ?></td>
                                    <td><strong><?php echo $equipo['puntos']; ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-content">
                    <p>No hay datos en la tabla de posiciones.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Bolivar por siempre - Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- MODAL DE LOGIN -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModalLogin()">&times;</span>
            <h2>Iniciar Sesión</h2>
            
            <?php if (!empty($error_login)): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error_login); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="form-login">
                <input type="hidden" name="accion" value="login">
                
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>

                <button type="submit" class="btn-submit">Iniciar Sesión</button>
            </form>

            <div class="login-info">
                <p><strong>Usuario de prueba:</strong> admin</p>
                <p><strong>Contraseña de prueba:</strong> admin123</p>
            </div>
        </div>
    </div>

    <script src="assets/js/index.js"></script>
</body>
</html>