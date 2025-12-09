<?php
// Incluir configuración
require_once '../config/database.php';

// Verificar que sea admin
requerir_admin();

$usuario = obtener_usuario_actual();

// Datos de ejemplo (sin BD)
$estadisticas = [
    'noticias' => 1,
    'noticias_publicadas' => 1,
    'equipos' => 5,
    'lider' => 'Club Bolívar'
];

$noticias_recientes = [
    [
        'titulo' => 'Bienvenido a Club Bolívar',
        'autor' => 'Administrador',
        'estado' => 'Publicado',
        'fecha' => '09/12/2025 18:27'
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Club Bolívar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin/dashboard.css">
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Club Bolívar Admin</h3>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
                    <li><a href="noticias/noticias.php">📰 Gestionar Noticias</a></li>
                    <li><a href="tabla_posiciones/tabla_posiciones.php">🏆 Gestionar Posiciones</a></li>
                    <li class="divider"></li>
                    <li><a href="../includes/auth.php?logout=1" class="logout">🚪 Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="admin-content">
            <!-- TOP BAR -->
            <div class="admin-topbar">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                    <small><?php echo ucfirst($usuario['rol']); ?></small>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="admin-body">
                <div class="dashboard-grid">
                    <!-- TARJETA: NOTICIAS -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Noticias</h3>
                            <span class="card-icon">📰</span>
                        </div>
                        <div class="card-body">
                            <p class="card-number"><?php echo $estadisticas['noticias']; ?></p>
                            <p class="card-label">Noticias registradas</p>
                            <a href="noticias/noticias.php" class="btn-card">Ver todos →</a>
                        </div>
                    </div>

                    <!-- TARJETA: NOTICIAS PUBLICADAS -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Publicadas</h3>
                            <span class="card-icon">✅</span>
                        </div>
                        <div class="card-body">
                            <p class="card-number"><?php echo $estadisticas['noticias_publicadas']; ?></p>
                            <p class="card-label">Noticias publicadas</p>
                            <a href="noticias/noticias.php" class="btn-card">Gestionar →</a>
                        </div>
                    </div>

                    <!-- TARJETA: EQUIPOS -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Equipos</h3>
                            <span class="card-icon">🏆</span>
                        </div>
                        <div class="card-body">
                            <p class="card-number"><?php echo $estadisticas['equipos']; ?></p>
                            <p class="card-label">Equipos en tabla</p>
                            <a href="tabla_posiciones/tabla_posiciones.php" class="btn-card">Gestionar →</a>
                        </div>
                    </div>

                    <!-- TARJETA: LÍDER -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Líder</h3>
                            <span class="card-icon">⭐</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($estadisticas['lider']); ?></p>
                            <p class="card-label">Equipo en primer lugar</p>
                        </div>
                    </div>
                </div>

                <!-- ÚLTIMAS NOTICIAS -->
                <section class="dashboard-section">
                    <h2>Últimas Noticias</h2>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($noticias_recientes as $noticia) {
                                $estado_clase = $noticia['estado'] === 'Publicado' ? 'estado-publicado' : 'estado-borrador';
                                echo '
                                <tr>
                                    <td>' . htmlspecialchars($noticia['titulo']) . '</td>
                                    <td>' . htmlspecialchars($noticia['autor']) . '</td>
                                    <td><span class="estado-badge ' . $estado_clase . '">' . $noticia['estado'] . '</span></td>
                                    <td>' . $noticia['fecha'] . '</td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>

    <script src="../assets/js/admin/admin.js"></script>
</body>
</html>