<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
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
                
                <article class="featured-card">
                    <img src="assets/img/gol.jpg" alt="Gol">
                    <div class="featured-card-content">
                        <h3>Victoria Contando los Minutos</h3>
                        <p class="author">Publicado el 9 de diciembre 2025</p>
                        <p>Fueron 10 minutos largos, porque Independiente buscaba el empate y nuestro equipo parecía estar con las piernas gastadas. El final se hizo esperar y festejamos otro triunfo de visitante, esta vez en la Capital. Una victoria que vale por dos, que nos acerca más al objetivo de la temporada.</p>
                        <p>La defensa se mantuvo sólida ante el asedio rival, mientras que nuestro mediocampo controló los tiempos del juego de manera inteligente. Los delanteros, aunque tuvieron pocas oportunidades, las aprovecharon con eficiencia cuando fue necesario.</p>
                    </div>
                </article>

                <article class="featured-card">
                    <img src="assets/img/stadio.jpg" alt="Estadio">
                    <div class="featured-card-content">
                        <h3>Preparación para el Próximo Partido</h3>
                        <p class="author">Publicado el 8 de diciembre 2025</p>
                        <p>El equipo continúa su preparación de cara al próximo enfrentamiento. Los entrenamientos han sido intensivos y el cuerpo técnico ha estado enfocado en mejorar aspectos defensivos y ofensivos que resultaron vulnerables en el último encuentro.</p>
                        <p>La dirigencia confirmó que todos los jugadores se encuentran en óptimas condiciones físicas y mentales para afrontar los desafíos que vienen. Se espera un partido emocionante donde Club Bolívar buscará mantener su racha ganadora.</p>
                    </div>
                </article>
            </section>
        </div>

        <a href="index.php" class="btn-back">← Volver al inicio</a>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Club Bolívar</h3>
                <p>Institución deportiva referente del país.</p>
            </div>
            <div class="footer-section links">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="tabla.php">Tabla de Posiciones</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 - Todos los derechos reservados Bolivar
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>
</html>
