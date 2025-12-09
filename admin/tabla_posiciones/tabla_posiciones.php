<?php
require_once '../../config/database.php';
require_once '../../includes/auth.php';

requerir_admin();

// Procesar acciones
$accion = $_GET['accion'] ?? $_POST['accion'] ?? null;

// CREAR POSICIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'crear') {
    $posicion = (int)($_POST['posicion'] ?? 0);
    $equipo = escapar($_POST['equipo'] ?? '');
    $partidos_jugados = (int)($_POST['partidos_jugados'] ?? 0);
    $partidos_ganados = (int)($_POST['partidos_ganados'] ?? 0);
    $partidos_empatados = (int)($_POST['partidos_empatados'] ?? 0);
    $partidos_perdidos = (int)($_POST['partidos_perdidos'] ?? 0);
    $goles_favor = (int)($_POST['goles_favor'] ?? 0);
    $goles_contra = (int)($_POST['goles_contra'] ?? 0);
    
    if (empty($equipo) || $posicion === 0) {
        $respuesta = ['exito' => false, 'mensaje' => 'Posición y equipo son requeridos'];
    } else {
        $consulta = "INSERT INTO tabla_posiciones 
                     (posicion, equipo, partidos_jugados, partidos_ganados, partidos_empatados, partidos_perdidos, goles_favor, goles_contra, estado) 
                     VALUES ($posicion, '$equipo', $partidos_jugados, $partidos_ganados, $partidos_empatados, $partidos_perdidos, $goles_favor, $goles_contra, 'activo')";
        
        if ($conn->query($consulta)) {
            $respuesta = ['exito' => true, 'mensaje' => 'Equipo agregado exitosamente'];
        } else {
            $respuesta = ['exito' => false, 'mensaje' => 'Error: ' . $conn->error];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// ACTUALIZAR POSICIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'editar') {
    $id = (int)$_POST['id'];
    $posicion = (int)($_POST['posicion'] ?? 0);
    $equipo = escapar($_POST['equipo'] ?? '');
    $partidos_jugados = (int)($_POST['partidos_jugados'] ?? 0);
    $partidos_ganados = (int)($_POST['partidos_ganados'] ?? 0);
    $partidos_empatados = (int)($_POST['partidos_empatados'] ?? 0);
    $partidos_perdidos = (int)($_POST['partidos_perdidos'] ?? 0);
    $goles_favor = (int)($_POST['goles_favor'] ?? 0);
    $goles_contra = (int)($_POST['goles_contra'] ?? 0);
    
    if (empty($equipo) || $posicion === 0) {
        $respuesta = ['exito' => false, 'mensaje' => 'Posición y equipo son requeridos'];
    } else {
        $consulta = "UPDATE tabla_posiciones SET 
                     posicion = $posicion,
                     equipo = '$equipo',
                     partidos_jugados = $partidos_jugados,
                     partidos_ganados = $partidos_ganados,
                     partidos_empatados = $partidos_empatados,
                     partidos_perdidos = $partidos_perdidos,
                     goles_favor = $goles_favor,
                     goles_contra = $goles_contra
                     WHERE id = $id";
        
        if ($conn->query($consulta)) {
            $respuesta = ['exito' => true, 'mensaje' => 'Equipo actualizado exitosamente'];
        } else {
            $respuesta = ['exito' => false, 'mensaje' => 'Error: ' . $conn->error];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER EQUIPO PARA EDITAR/VER
if ($accion && in_array($accion, ['editar', 'ver']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $resultado = $conn->query("SELECT * FROM tabla_posiciones WHERE id = $id LIMIT 1");
    
    if ($resultado && $resultado->num_rows > 0) {
        $equipo = $resultado->fetch_assoc();
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            include 'Modals/' . $accion . '.php';
        }
    }
    exit();
}

// ELIMINAR EQUIPO
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $consulta = "DELETE FROM tabla_posiciones WHERE id = $id";
    
    if ($conn->query($consulta)) {
        $respuesta = ['exito' => true, 'mensaje' => 'Equipo eliminado exitosamente'];
    } else {
        $respuesta = ['exito' => false, 'mensaje' => 'Error al eliminar: ' . $conn->error];
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER TODOS LOS EQUIPOS
$equipos = [];
$resultado = $conn->query("SELECT * FROM tabla_posiciones WHERE estado = 'activo' ORDER BY posicion ASC");

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $equipos[] = $fila;
    }
}

$usuario = obtener_usuario_actual();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Tabla de Posiciones - Club Bolívar</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin/noticias.css">
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
                    <li><a href="../dashboard.php">📊 Dashboard</a></li>
                    <li><a href="../noticias/noticias.php">📰 Gestionar Noticias</a></li>
                    <li><a href="tabla_posiciones.php" class="active">🏆 Gestionar Posiciones</a></li>
                    <li class="divider"></li>
                    <li><a href="../../?logout=1" class="logout">🚪 Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="admin-content">
            <!-- TOP BAR -->
            <div class="admin-topbar">
                <h1>Gestionar Tabla de Posiciones</h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                    <small><?php echo ucfirst($usuario['rol']); ?></small>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="admin-body">
                <div class="noticias-header">
                    <button class="btn-primary" onclick="abrirModalAdmin('modalCrearEquipo', 'crear')">
                        ➕ Agregar Equipo
                    </button>
                </div>

                <!-- TABLA DE EQUIPOS -->
                <div class="table-container">
                    <table class="admin-table">
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($equipos)): ?>
                                <?php foreach ($equipos as $eq): ?>
                                    <tr>
                                        <td><?php echo $eq['posicion']; ?></td>
                                        <td><?php echo htmlspecialchars($eq['equipo']); ?></td>
                                        <td><?php echo $eq['partidos_jugados']; ?></td>
                                        <td><?php echo $eq['partidos_ganados']; ?></td>
                                        <td><?php echo $eq['partidos_empatados']; ?></td>
                                        <td><?php echo $eq['partidos_perdidos']; ?></td>
                                        <td><?php echo $eq['goles_favor']; ?></td>
                                        <td><?php echo $eq['goles_contra']; ?></td>
                                        <td><?php echo $eq['diferencia_goles']; ?></td>
                                        <td><strong><?php echo $eq['puntos']; ?></strong></td>
                                        <td class="acciones">
                                            <button class="btn-action btn-secondary" onclick="abrirModalAdmin('modalVerEquipo', 'ver', <?php echo $eq['id']; ?>)">👁️ Ver</button>
                                            <button class="btn-action btn-primary" onclick="abrirModalAdmin('modalEditarEquipo', 'editar', <?php echo $eq['id']; ?>)">✏️ Editar</button>
                                            <a href="?accion=eliminar&id=<?php echo $eq['id']; ?>" class="btn-action btn-danger" onclick="return confirmarEliminacion(<?php echo $eq['id']; ?>, 'equipo')">🗑️ Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11" class="text-center">No hay equipos registrados</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL CREAR EQUIPO -->
    <div id="modalCrearEquipo" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalCrearEquipo')">&times;</span>
            <h2>Agregar Nuevo Equipo</h2>
            <form method="POST" action="?" class="admin-form" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, () => location.reload())">
                <input type="hidden" name="accion" value="crear">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="posicion">Posición:</label>
                        <input type="number" id="posicion" name="posicion" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="equipo">Nombre del Equipo:</label>
                        <input type="text" id="equipo" name="equipo" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="partidos_jugados">Partidos Jugados:</label>
                        <input type="number" id="partidos_jugados" name="partidos_jugados" min="0" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="partidos_ganados">Partidos Ganados:</label>
                        <input type="number" id="partidos_ganados" name="partidos_ganados" min="0" value="0" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="partidos_empatados">Partidos Empatados:</label>
                        <input type="number" id="partidos_empatados" name="partidos_empatados" min="0" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="partidos_perdidos">Partidos Perdidos:</label>
                        <input type="number" id="partidos_perdidos" name="partidos_perdidos" min="0" value="0" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="goles_favor">Goles a Favor:</label>
                        <input type="number" id="goles_favor" name="goles_favor" min="0" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="goles_contra">Goles en Contra:</label>
                        <input type="number" id="goles_contra" name="goles_contra" min="0" value="0" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">💾 Guardar Equipo</button>
            </form>
        </div>
    </div>

    <!-- MODAL VER EQUIPO -->
    <div id="modalVerEquipo" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalVerEquipo')">&times;</span>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR EQUIPO -->
    <div id="modalEditarEquipo" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalEditarEquipo')">&times;</span>
            <h2>Editar Equipo</h2>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
</body>
</html>