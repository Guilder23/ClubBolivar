<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Procesar envío de comentario
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['comentario'])) {
    $nombre = escapar($_POST['nombre'] ?? '');
    $comentario = escapar($_POST['comentario'] ?? '');
    
    if (!empty($nombre) && !empty($comentario)) {
        if ($conn) {
            $consulta = "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')";
            if ($conn->query($consulta)) {
                // Guardar mensaje en sesión
                $_SESSION['mensaje_comentario'] = 'Comentario publicado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
                // Redirigir para evitar duplicados al recargar
                header("Location: opinion.php");
                exit();
            } else {
                $_SESSION['mensaje_comentario'] = 'Error al publicar el comentario';
                $_SESSION['tipo_mensaje'] = 'error';
            }
        }
    } else {
        $_SESSION['mensaje_comentario'] = 'Por favor completa todos los campos';
        $_SESSION['tipo_mensaje'] = 'error';
    }
}

// Recuperar mensaje de sesión si existe
if (isset($_SESSION['mensaje_comentario'])) {
    $mensaje = $_SESSION['mensaje_comentario'];
    $tipo_mensaje = $_SESSION['tipo_mensaje'];
    // Eliminar el mensaje de la sesión después de mostrarlo una vez
    unset($_SESSION['mensaje_comentario']);
    unset($_SESSION['tipo_mensaje']);
}

// Obtener comentarios
$comentarios = [];
if ($conn) {
    $resultado = $conn->query("SELECT nombre, comentario, fecha_creacion FROM comentarios ORDER BY fecha_creacion DESC");
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $comentarios[] = $fila;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opinión - Club Bolívar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/opinion.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/opinion.jpeg" alt="Opinión">
            <h1>Opinión</h1>
        </div>

        <div class="page-content">
            <article class="opinion-article">
                <h2>Victoria Contando los Minutos</h2>
                <p class="meta">Por la redacción | 9 de diciembre de 2025</p>
                
                <p>Fueron 10 minutos largos, porque Independiente buscaba el empate y nuestro equipo parecía estar con las piernas gastadas. El final se hizo esperar y festejamos otro triunfo de visitante, esta vez en la Capital. Una victoria que vale por dos, que nos acerca más al objetivo de la temporada.</p>

                <p>La defensa se mantuvo sólida ante el asedio rival, mientras que nuestro mediocampo controló los tiempos del juego de manera inteligente. Los delanteros, aunque tuvieron pocas oportunidades, las aprovecharon con eficiencia cuando fue necesario.</p>

                <h3>Un análisis detallado</h3>

                <p>El partido comenzó con un Independiente que buscaba presionar desde el inicio, pero nuestro equipo supo mantener la calma y jugar de manera ordenada. La primera mitad fue equilibrada, con pocas emociones pero con clara intención de ambos equipos de imponer su estilo.</p>

                <p>En el segundo tiempo, cuando parecía que todo se iba a un empate sin mayores alegrías, apareció la magia que caracteriza a nuestro equipo. Un contragolpe bien ejecutado y la definición de nuestros delanteros hizo la diferencia.</p>

                <h3>Reflexión Final</h3>

                <p>Estos son los triunfos que valen más, aquellos en los que el equipo sufre, se expone, pero al final saca la victoria de visitante. Es el tipo de resultado que te mantiene vivo en la competencia y que te da la confianza necesaria para los próximos desafíos.</p>

                <p>Ahora toca seguir trabajando, mantener la concentración y prepararse para lo que viene. El camino aún es largo, pero con este tipo de actuaciones, sabemos que estamos en el rumbo correcto.</p>
            </article>

            <!-- SECCIÓN DE COMENTARIOS -->
            <section class="comentarios-section">
                <h2>Opiniones de Nuestros Seguidores</h2>
                
                <!-- COMENTARIOS PUBLICADOS -->
                <div class="comentarios-lista">
                    <h3>Comentarios (<?php echo count($comentarios); ?>)</h3>
                    
                    <?php if (!empty($comentarios)): ?>
                        <?php foreach ($comentarios as $com): ?>
                            <div class="comentario-item">
                                <div class="comentario-header">
                                    <strong><?php echo htmlspecialchars($com['nombre']); ?></strong>
                                    <span class="comentario-fecha"><?php echo date('d/m/Y H:i', strtotime($com['fecha_creacion'])); ?></span>
                                </div>
                                <p class="comentario-texto"><?php echo nl2br(htmlspecialchars($com['comentario'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #999; text-align: center; padding: 2rem;">No hay comentarios aún. ¡Sé el primero en comentar!</p>
                    <?php endif; ?>
                </div>

                <hr style="margin: 2.5rem 0; border: none; border-top: 1px solid #e2e8f0;">

                <!-- FORMULARIO -->
                <h2 style="margin-top: 2.5rem;">Deja tu Opinión</h2>
                
                <?php if (!empty($mensaje)): ?>
                    <div class="mensaje-alerta" id="mensajeAlerta" style="background: <?php echo ($tipo_mensaje === 'success') ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo ($tipo_mensaje === 'success') ? '#155724' : '#721c24'; ?>; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                    <script>
                        // Ocultar el mensaje después de 3 segundos
                        setTimeout(function() {
                            var alerta = document.getElementById('mensajeAlerta');
                            if (alerta) {
                                alerta.style.transition = 'opacity 0.5s ease';
                                alerta.style.opacity = '0';
                                setTimeout(function() {
                                    alerta.style.display = 'none';
                                }, 500);
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <form method="POST" class="comentario-form">
                    <div class="form-group">
                        <label for="nombre">Tu Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="comentario">Tu Comentario:</label>
                        <textarea id="comentario" name="comentario" rows="5" placeholder="Comparte tu opinión sobre el artículo..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-enviar">📝 Enviar Comentario</button>
                </form>
            </section>

        <a href="index.php" class="btn-back">← Volver al inicio</a>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Club Bolívar</h3>
                <p>Institución deportiva referente del país con una historia rica en éxitos y tradición.</p>
            </div>
            <div class="footer-section links">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="tabla.php">Tabla de Posiciones</a></li>
                    <li><a href="destacado.php">Lo Destacado</a></li>
                    <li><a href="opinion.php">Opinión</a></li>
                </ul>
            </div>
            <div class="footer-section admin">
                <h3>Administración</h3>
                <ul>
                    <li><a href="admin/">Panel de Admin</a></li>
                    <li><a href="config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 - Club Bolívar - Todos los derechos reservados
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>
</html>
