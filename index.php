<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener tabla de posiciones (datos de ejemplo)
$tabla_posiciones = [
    ['equipo' => 'Club Bolívar', 'partidos' => 5, 'ganados' => 4, 'empatados' => 1, 'perdidos' => 0, 'gf' => 12, 'gc' => 2, 'diferencia_goles' => 10, 'puntos' => 13],
    ['equipo' => 'Strongest', 'partidos' => 5, 'ganados' => 3, 'empatados' => 2, 'perdidos' => 0, 'gf' => 10, 'gc' => 3, 'diferencia_goles' => 7, 'puntos' => 11],
    ['equipo' => 'The Strongest', 'partidos' => 5, 'ganados' => 3, 'empatados' => 0, 'perdidos' => 2, 'gf' => 9, 'gc' => 5, 'diferencia_goles' => 4, 'puntos' => 9],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolivar por Siempre</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="layout-bolivar">
        <!-- Sidebar con misión -->
        <aside class="sidebar" id="mision">
            <span class="sidebar-title">MISIÓN Y VISIÓN</span>
            <p class="sidebar-desc">Hace poco más de un año y medio lanzábamos públicamente, un primer esbozo del propósito que nos anima a apoyar desde donde estemos a la institución deportiva más grande del país, porque nacimos cobijados por esa frazada celeste de triunfos y glorias.
            Algunos oficiosos corrieron hasta las puertas del presidente de la entidad para tergiversar nuestras propuestas, creyendo que estábamos tras sus puestos de funcionarios; nada más falaz, porque somos profesionales que tenemos nuestra ocupación diaria. A raíz de esto recibimos una respuesta poco educada, menospreciando nuestro noble afán. No respondimos porque somos enemigos de las polémicas en casa.
            ¿Qué decíamos entonces?</p>
            <a href="mision.php" class="card-btn">Ver más</a>
        </aside>

        <section class="main-content">
            <!-- Imagen principal -->
            <div class="hero-image">
                <img src="assets/img/principal.png" alt="Club Bolívar">
            </div>

            <!-- Card Noticias -->
            <div class="card-main card-1 card-with-image" id="noticias">
                <div class="card-header-image">
                    <img src="assets/img/gol.jpg" alt="Noticias">
                </div>
                <div class="card-content">
                    <span class="card-title">NOTICIAS</span>
                    <p class="card-desc">Mantente informado con las últimas noticias, eventos y comunicados oficiales del Club Bolívar.</p>
                    <a href="destacado.php" class="card-btn">Ver más</a>
                </div>
            </div>

            <!-- Card Opinión -->
            <div class="card-main card-2 card-with-image" id="opinion">
                <div class="card-header-image">
                    <img src="assets/img/opinion.jpeg" alt="Opinión">
                </div>
                <div class="card-content">
                    <span class="card-title">OPINIÓN</span>
                    <p class="card-desc">Victoria contando los minutos
Fueron 10 minutos largos, porque Independiente buscaba el empate y nuestro equipo parecía estar con las piernas gastadas. El final se hizo esperar y festejamos otro triunfo de visitante, esta vez en la Capital.</p>
                    <a href="opinion.php" class="card-btn">Ver más</a>
                </div>
            </div>

            <!-- Card Lo Último -->
            <div class="card-main card-3 card-with-image" id="ultimo">
                <div class="card-header-image">
                    <img src="assets/img/ultimo.jpg" alt="Lo Último">
                </div>
                <div class="card-content">
                    <span class="card-title">LO ÚLTIMO</span>
                    <p class="card-desc">Tres minutos de pausa. Debido a las altas temperaturas, la FIFA anunció que previa decisión del árbitro habrá tres minutos de hidratación en cada tiempo (cooling break)</p>
                    <a href="destacado.php" class="card-btn">Ver más</a>
                </div>
            </div>

            <!-- Card Historia -->
            <div class="card-main card-4 card-with-image" id="historia">
                <div class="card-header-image">
                    <img src="assets/img/historia.jpg" alt="Historia">
                </div>
                <div class="card-content">
                    <span class="card-title">HISTORIA</span>
                    <p class="card-desc">Ganarle a Litoral era una hazaña y nada menos por 3-0 en el partido definitorio. Era el 13 de mayo de 1951. Ambos concluyeron con 21 puntos, en un torneo que contaba con nueve equipos. Esa fue la primera estrella celeste en 1950.</p>
                    <a href="historia.php" class="card-btn">Ver más</a>
                </div>
            </div>

            <!-- Tabla de Posiciones -->
            <div class="card-main card-6" id="tabla">
                <span class="card-title">TABLA DE POSICIONES</span>
                <table class="tabla-posiciones">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>PJ</th>
                            <th>G</th>
                            <th>E</th>
                            <th>P</th>
                            <th>DG</th>
                            <th>Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tabla_posiciones as $equipo): ?>
                        <tr>
                            <td><?php echo $equipo['equipo']; ?></td>
                            <td><?php echo $equipo['partidos']; ?></td>
                            <td><?php echo $equipo['ganados']; ?></td>
                            <td><?php echo $equipo['empatados']; ?></td>
                            <td><?php echo $equipo['perdidos']; ?></td>
                            <td><?php echo $equipo['diferencia_goles']; ?></td>
                            <td><strong><?php echo $equipo['puntos']; ?></strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="tabla.php" class="card-btn" style="margin-top: 15px;">Ver más</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>Mi Sitio Web</h3>
                <p>Proyecto deportivo con noticias, tabla de posiciones y mucho más.</p>
            </div>

            <div class="footer-section links">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#noticias">Noticias</a></li>
                    <li><a href="#tabla">Tabla de Posiciones</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-section social">
                <h3>Redes Sociales</h3>
                <div class="social-icons">
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                    <a href="#">Twitter</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            © 2025 - Todos los derechos reservados Bolivar
        </div>
    </footer>

    <script src="assets/js/index.js"></script>
</body>
</html>
