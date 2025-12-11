<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener todas las noticias publicadas ordenadas por fecha descendente
$noticias = [];
if ($conn) {
    $resultado = $conn->query("SELECT n.*, u.nombre as autor FROM noticias n 
                               LEFT JOIN usuarios u ON n.autor_id = u.id 
                               WHERE n.estado = 'publicado' 
                               ORDER BY n.fecha_actualizacion DESC");
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $noticias[] = $fila;
        }
    }
}

// Datos de fallback si no hay conexión
if (empty($noticias)) {
    $noticias = [
        [
            'id' => 1,
            'titulo' => 'Victoria Contando los Minutos',
            'contenido' => 'Fueron 10 minutos largos, porque Independiente buscaba el empate y nuestro equipo parecía estar con las piernas gastadas. El final se hizo esperar y festejamos otro triunfo de visitante, esta vez en la Capital. Una victoria que vale por dos, que nos acerca más al objetivo de la temporada. La defensa se mantuvo sólida ante el asedio rival, mientras que nuestro mediocampo controló los tiempos del juego de manera inteligente. Los delanteros, aunque tuvieron pocas oportunidades, las aprovecharon con eficiencia cuando fue necesario.',
            'imagen' => null,
            'fecha_actualizacion' => '2025-12-09',
            'autor' => 'Administrador'
        ],
        [
            'id' => 2,
            'titulo' => 'Preparación para el Próximo Partido',
            'contenido' => 'El equipo continúa su preparación de cara al próximo enfrentamiento. Los entrenamientos han sido intensivos y el cuerpo técnico ha estado enfocado en mejorar aspectos defensivos y ofensivos que resultaron vulnerables en el último encuentro. La dirigencia confirmó que todos los jugadores se encuentran en óptimas condiciones físicas y mentales para afrontar los desafíos que vienen. Se espera un partido emocionante donde Club Bolívar buscará mantener su racha ganadora.',
            'imagen' => null,
            'fecha_actualizacion' => '2025-12-08',
            'autor' => 'Administrador'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lo Destacado - Club Bolívar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/destacado.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/ultimo.jpg" alt="Destacado">
            <h1>Lo Destacado</h1>
        </div>

        <div class="page-content">
            <section class="content-section">
                <div class="section-header">
                    <h2>Noticias Recientes</h2>
                    <div class="header-line"></div>
                </div>
                
                <?php if (!empty($noticias)): ?>
                    <?php foreach ($noticias as $noticia): ?>
                        <article class="featured-card">
                            <?php 
                            if (!empty($noticia['imagen'])) {
                                $imagen_url = 'assets/img/noticias/' . htmlspecialchars($noticia['imagen']);
                                echo '<img src="' . $imagen_url . '" alt="' . htmlspecialchars($noticia['titulo']) . '">';
                            } else {
                                echo '<img src="assets/img/gol.jpg" alt="Noticias">';
                            }
                            ?>
                            <div class="featured-card-content">
                                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                                <p class="author">Publicado el <?php 
                                    $fecha = strtotime($noticia['fecha_actualizacion']);
                                    $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                    $mes = $meses[date('n', $fecha) - 1];
                                    echo date('d', $fecha) . ' de ' . $mes . ' de ' . date('Y', $fecha);
                                ?> por <?php echo htmlspecialchars($noticia['autor']); ?></p>
                                <p><?php echo htmlspecialchars($noticia['contenido']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #999; padding: 2rem;">No hay noticias publicadas en este momento.</p>
                <?php endif; ?>
            </section>
        </div>

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
            <p style="margin-top: 10px; font-size: 1.1em; font-weight: 700; color: #a8bbd4ff; letter-spacing: 0.5px;">Desarrollado por <strong style="color: #c6d6f1ff;">Guilder Paredes Lovera</strong></p>
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>
</html>
