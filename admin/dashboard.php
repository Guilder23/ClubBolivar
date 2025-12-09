<?php
require_once '../config/database.php';
require_once '../includes/auth.php';

requerir_admin();

$usuario = obtener_usuario_actual();
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
                    <li><a href="../?logout=1" class="logout">🚪 Cerrar Sesión</a></li>
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
                            <?php
                            $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias");
                            $fila = $resultado->fetch_assoc();
                            echo '<p class="card-number">' . $fila['total'] . '</p>';
                            ?>
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
                            <?php
                            $resultado = $conn->query("SELECT COUNT(*) as total FROM noticias WHERE estado = 'publicado'");
                            $fila = $resultado->fetch_assoc();
                            echo '<p class="card-number">' . $fila['total'] . '</p>';
                            ?>
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
                            <?php
                            $resultado = $conn->query("SELECT COUNT(*) as total FROM tabla_posiciones WHERE estado = 'activo'");
                            $fila = $resultado->fetch_assoc();
                            echo '<p class="card-number">' . $fila['total'] . '</p>';
                            ?>
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
                            <?php
                            $resultado = $conn->query("SELECT equipo FROM tabla_posiciones WHERE estado = 'activo' ORDER BY posicion ASC LIMIT 1");
                            $fila = $resultado->fetch_assoc();
                            $lider = $fila ? $fila['equipo'] : 'N/A';
                            echo '<p class="card-text">' . htmlspecialchars($lider) . '</p>';
                            ?>
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
                            $resultado = $conn->query("
                                SELECT n.*, u.nombre FROM noticias n
                                JOIN usuarios u ON n.autor_id = u.id
                                ORDER BY n.fecha_creacion DESC
                                LIMIT 5
                            ");
                            
                            if ($resultado && $resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    $estado_clase = $fila['estado'] === 'publicado' ? 'estado-publicado' : ($fila['estado'] === 'borrador' ? 'estado-borrador' : 'estado-cancelado');
                                    echo '
                                    <tr>
                                        <td>' . htmlspecialchars($fila['titulo']) . '</td>
                                        <td>' . htmlspecialchars($fila['nombre']) . '</td>
                                        <td><span class="estado-badge ' . $estado_clase . '">' . ucfirst($fila['estado']) . '</span></td>
                                        <td>' . date('d/m/Y H:i', strtotime($fila['fecha_creacion'])) . '</td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center">No hay noticias</td></tr>';
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