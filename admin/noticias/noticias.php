<?php
require_once '../../config/database.php';
require_once '../../includes/auth.php';

requerir_admin();

// Procesar acciones
$accion = $_GET['accion'] ?? $_POST['accion'] ?? null;

// CREAR NOTICIA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'crear') {
    $titulo = escapar($_POST['titulo'] ?? '');
    $contenido = escapar($_POST['contenido'] ?? '');
    $estado = escapar($_POST['estado'] ?? 'borrador');
    $usuario_id = $_SESSION['usuario_id'];
    
    if (empty($titulo) || empty($contenido)) {
        $respuesta = ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
    } else {
        $fecha_publicacion = ($estado === 'publicado') ? date('Y-m-d H:i:s') : NULL;
        
        $consulta = "INSERT INTO noticias (titulo, contenido, autor_id, estado, fecha_publicacion) 
                     VALUES ('$titulo', '$contenido', $usuario_id, '$estado', " . ($fecha_publicacion ? "'$fecha_publicacion'" : "NULL") . ")";
        
        if ($conn->query($consulta)) {
            $respuesta = ['exito' => true, 'mensaje' => 'Noticia creada exitosamente'];
        } else {
            $respuesta = ['exito' => false, 'mensaje' => 'Error al crear la noticia: ' . $conn->error];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER NOTICIA PARA EDITAR/VER
if ($accion && in_array($accion, ['editar', 'ver']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $resultado = $conn->query("SELECT * FROM noticias WHERE id = $id LIMIT 1");
    
    if ($resultado && $resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            // Es AJAX, devolver el formulario
            include 'Modals/' . $accion . '.php';
        }
    }
    exit();
}

// ACTUALIZAR NOTICIA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'editar') {
    $id = (int)$_POST['id'];
    $titulo = escapar($_POST['titulo'] ?? '');
    $contenido = escapar($_POST['contenido'] ?? '');
    $estado = escapar($_POST['estado'] ?? 'borrador');
    
    if (empty($titulo) || empty($contenido)) {
        $respuesta = ['exito' => false, 'mensaje' => 'Todos los campos son requeridos'];
    } else {
        $fecha_publicacion = ($estado === 'publicado') ? date('Y-m-d H:i:s') : NULL;
        
        $consulta = "UPDATE noticias SET 
                     titulo = '$titulo',
                     contenido = '$contenido',
                     estado = '$estado',
                     fecha_publicacion = " . ($fecha_publicacion ? "'$fecha_publicacion'" : "NULL") . "
                     WHERE id = $id";
        
        if ($conn->query($consulta)) {
            $respuesta = ['exito' => true, 'mensaje' => 'Noticia actualizada exitosamente'];
        } else {
            $respuesta = ['exito' => false, 'mensaje' => 'Error al actualizar: ' . $conn->error];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// ELIMINAR NOTICIA
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $consulta = "DELETE FROM noticias WHERE id = $id";
    
    if ($conn->query($consulta)) {
        $respuesta = ['exito' => true, 'mensaje' => 'Noticia eliminada exitosamente'];
    } else {
        $respuesta = ['exito' => false, 'mensaje' => 'Error al eliminar: ' . $conn->error];
    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// OBTENER TODAS LAS NOTICIAS
$noticias = [];
$resultado = $conn->query("SELECT n.*, u.nombre FROM noticias n JOIN usuarios u ON n.autor_id = u.id ORDER BY n.fecha_creacion DESC");

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $noticias[] = $fila;
    }
}

$usuario = obtener_usuario_actual();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Noticias - Club Bolívar</title>
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
                    <li><a href="noticias.php" class="active">📰 Gestionar Noticias</a></li>
                    <li><a href="../tabla_posiciones/tabla_posiciones.php">🏆 Gestionar Posiciones</a></li>
                    <li class="divider"></li>
                    <li><a href="../../?logout=1" class="logout">🚪 Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="admin-content">
            <!-- TOP BAR -->
            <div class="admin-topbar">
                <h1>Gestionar Noticias</h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                    <small><?php echo ucfirst($usuario['rol']); ?></small>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="admin-body">
                <div class="noticias-header">
                    <button class="btn-primary" onclick="abrirModalAdmin('modalCrearNoticia', 'crear')">
                        ➕ Crear Nueva Noticia
                    </button>
                </div>

                <!-- TABLA DE NOTICIAS -->
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($noticias)): ?>
                                <?php foreach ($noticias as $noticia): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars(substr($noticia['titulo'], 0, 40)); ?></td>
                                        <td><?php echo htmlspecialchars($noticia['nombre']); ?></td>
                                        <td>
                                            <span class="estado-badge estado-<?php echo $noticia['estado']; ?>">
                                                <?php echo ucfirst($noticia['estado']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($noticia['fecha_creacion'])); ?></td>
                                        <td class="acciones">
                                            <button class="btn-action btn-secondary" onclick="abrirModalAdmin('modalVerNoticia', 'ver', <?php echo $noticia['id']; ?>)">👁️ Ver</button>
                                            <button class="btn-action btn-primary" onclick="abrirModalAdmin('modalEditarNoticia', 'editar', <?php echo $noticia['id']; ?>)">✏️ Editar</button>
                                            <a href="?accion=eliminar&id=<?php echo $noticia['id']; ?>" class="btn-action btn-danger" onclick="return confirmarEliminacion(<?php echo $noticia['id']; ?>, 'noticia')">🗑️ Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No hay noticias registradas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL CREAR NOTICIA -->
    <div id="modalCrearNoticia" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalCrearNoticia')">&times;</span>
            <h2>Crear Nueva Noticia</h2>
            <form method="POST" action="?" class="admin-form" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, () => location.reload())">
                <input type="hidden" name="accion" value="crear">
                
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido:</label>
                    <textarea id="contenido" name="contenido" required></textarea>
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="borrador">Borrador</option>
                        <option value="publicado">Publicado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">💾 Guardar Noticia</button>
            </form>
        </div>
    </div>

    <!-- MODAL VER NOTICIA -->
    <div id="modalVerNoticia" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalVerNoticia')">&times;</span>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR NOTICIA -->
    <div id="modalEditarNoticia" class="modal">
        <div class="modal-content modal-lg">
            <span class="close-modal" onclick="cerrarModalAdmin('modalEditarNoticia')">&times;</span>
            <h2>Editar Noticia</h2>
            <div class="modal-body">
                <!-- Se cargará vía AJAX -->
            </div>
        </div>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/noticias.js"></script>
</body>
</html>