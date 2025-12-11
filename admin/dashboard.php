<?php
// Incluir configuración
require_once '../config/database.php';

// Verificar que sea admin
requerir_admin();

$usuario = obtener_usuario_actual();

// Obtener estadísticas de la base de datos
$estadisticas = [
    'noticias_total' => 0,
    'noticias_publicadas' => 0,
    'noticias_borrador' => 0,
    'noticias_canceladas' => 0,
    'equipos_total' => 0,
    'equipos_publicados' => 0,
    'equipos_borrador' => 0,
    'equipos_cancelados' => 0,
    'lider' => 'N/A'
];

$noticias_recientes = [];

if ($conn) {
    // Contar noticias por estado
    $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['noticias_total'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias WHERE estado = 'publicado'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['noticias_publicadas'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias WHERE estado = 'borrador'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['noticias_borrador'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias WHERE estado = 'cancelado'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['noticias_canceladas'] = $row['total'];
    }
    
    // Contar equipos por estado
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tabla_posiciones");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['equipos_total'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tabla_posiciones WHERE estado = 'publicado'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['equipos_publicados'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tabla_posiciones WHERE estado = 'borrador'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['equipos_borrador'] = $row['total'];
    }
    
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tabla_posiciones WHERE estado = 'cancelado'");
    if ($resultado) {
        $row = $resultado->fetch_assoc();
        $estadisticas['equipos_cancelados'] = $row['total'];
    }
    
    // Obtener líder (equipo en posición 1)
    $resultado = $conn->query("SELECT equipo FROM tabla_posiciones WHERE posicion = 1 LIMIT 1");
    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $estadisticas['lider'] = $row['equipo'];
    }
    
    // Obtener top 3 equipos
    $estadisticas['top_3'] = [];
    $resultado = $conn->query("SELECT posicion, equipo, puntos FROM tabla_posiciones WHERE estado = 'publicado' ORDER BY puntos DESC LIMIT 3");
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $estadisticas['top_3'][] = $fila;
        }
    }
    
    // Obtener últimas 3 noticias
    $noticias_recientes = [];
    $resultado = $conn->query("SELECT id, titulo, usuario_id, estado, fecha_actualizacion FROM noticias ORDER BY fecha_actualizacion DESC LIMIT 3");
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Obtener nombre del autor
            $usuario_id = (int)$fila['usuario_id'];
            $res_autor = $conn->query("SELECT nombre FROM usuarios WHERE id = $usuario_id");
            $autor = 'Desconocido';
            if ($res_autor && $res_autor->num_rows > 0) {
                $row_autor = $res_autor->fetch_assoc();
                $autor = $row_autor['nombre'];
            }
            
            $noticias_recientes[] = [
                'titulo' => $fila['titulo'],
                'autor' => $autor,
                'estado' => ucfirst($fila['estado']),
                'fecha' => date('d/m/Y H:i', strtotime($fila['fecha_actualizacion']))
            ];
        }
    }
    
    // Si no hay noticias, mostrar ejemplos
    if (empty($noticias_recientes)) {
        $noticias_recientes = [
            [
                'titulo' => 'Bienvenido a Club Bolívar',
                'autor' => 'Administrador',
                'estado' => 'Publicado',
                'fecha' => '10/12/2025 20:30'
            ],
            [
                'titulo' => 'Últimas Noticias del Club',
                'autor' => 'Administrador',
                'estado' => 'Publicado',
                'fecha' => '10/12/2025 19:15'
            ],
            [
                'titulo' => 'Próximos Partidos',
                'autor' => 'Administrador',
                'estado' => 'Borrador',
                'fecha' => '10/12/2025 18:00'
            ]
        ];
    }
} else {
    // Datos de ejemplo si no hay BD
    $estadisticas = [
        'noticias_total' => 1,
        'noticias_publicadas' => 1,
        'noticias_borrador' => 0,
        'noticias_canceladas' => 0,
        'equipos_total' => 5,
        'equipos_publicados' => 5,
        'equipos_borrador' => 0,
        'equipos_cancelados' => 0,
        'lider' => 'Club Bolívar',
        'top_3' => [
            ['posicion' => 1, 'equipo' => 'Club Bolívar', 'puntos' => 13],
            ['posicion' => 2, 'equipo' => 'Strongest', 'puntos' => 11],
            ['posicion' => 3, 'equipo' => 'The Strongest', 'puntos' => 9]
        ]
    ];
    $noticias_recientes = [
        [
            'titulo' => 'Bienvenido a Club Bolívar',
            'autor' => 'Administrador',
            'estado' => 'Publicado',
            'fecha' => '09/12/2025 18:27'
        ]
    ];
}
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
                <h3>BOLIVAR por siempre</h3>
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
                    <!-- TARJETA: NOTICIAS TOTAL -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Noticias</h3>
                            <span class="card-icon">📰</span>
                        </div>
                        <div class="card-body">
                            <p class="card-number"><?php echo $estadisticas['noticias_total']; ?></p>
                            <p class="card-label">Noticias registradas</p>
                            <div class="card-stats">
                                <span class="stat-item">📌 Publicadas: <?php echo $estadisticas['noticias_publicadas']; ?></span>
                                <span class="stat-item">📝 Borrador: <?php echo $estadisticas['noticias_borrador']; ?></span>
                                <span class="stat-item">❌ Canceladas: <?php echo $estadisticas['noticias_canceladas']; ?></span>
                            </div>
                            <a href="noticias/noticias.php" class="btn-card">Ver todos →</a>
                        </div>
                    </div>

                    <!-- TARJETA: EQUIPOS TOTAL -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Equipos</h3>
                            <span class="card-icon">🏆</span>
                        </div>
                        <div class="card-body">
                            <p class="card-number"><?php echo $estadisticas['equipos_total']; ?></p>
                            <p class="card-label">Equipos en tabla</p>
                            <div class="card-stats">
                                <span class="stat-item">📌 Publicados: <?php echo $estadisticas['equipos_publicados']; ?></span>
                                <span class="stat-item">📝 Borrador: <?php echo $estadisticas['equipos_borrador']; ?></span>
                                <span class="stat-item">❌ Cancelados: <?php echo $estadisticas['equipos_cancelados']; ?></span>
                            </div>
                            <a href="tabla_posiciones/tabla_posiciones.php" class="btn-card">Gestionar →</a>
                        </div>
                    </div>

                    <!-- TARJETA: TOP 3 EQUIPOS -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Top 3</h3>
                            <span class="card-icon">🏅</span>
                        </div>
                        <div class="card-body">
                            <div class="top-3-list">
                                <?php 
                                if (!empty($estadisticas['top_3'])) {
                                    foreach ($estadisticas['top_3'] as $idx => $equipo) {
                                        $medal = ['🥇', '🥈', '🥉'][$idx] ?? '🏅';
                                        echo '<div class="top-3-item">';
                                        echo '<span class="medal">' . $medal . '</span>';
                                        echo '<span class="team-name">' . htmlspecialchars($equipo['equipo']) . '</span>';
                                        echo '<span class="points">' . $equipo['puntos'] . ' pts</span>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p style="color: #718096;">No hay equipos publicados</p>';
                                }
                                ?>
                            </div>
                            <a href="tabla_posiciones/tabla_posiciones.php" class="btn-card">Ver tabla →</a>
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
                            if (!empty($noticias_recientes)) {
                                foreach ($noticias_recientes as $noticia) {
                                    $estado_lower = strtolower($noticia['estado']);
                                    $estado_clase = 'estado-' . $estado_lower;
                                    echo '
                                    <tr>
                                        <td>' . htmlspecialchars($noticia['titulo']) . '</td>
                                        <td>' . htmlspecialchars($noticia['autor']) . '</td>
                                        <td><span class="estado-badge ' . $estado_clase . '">' . $noticia['estado'] . '</span></td>
                                        <td>' . $noticia['fecha'] . '</td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '<tr><td colspan="4" style="text-align: center; color: #718096;">No hay noticias registradas</td></tr>';
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