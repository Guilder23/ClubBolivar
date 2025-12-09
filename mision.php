<?php
// Incluir funciones globales
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión y Visión - Club Bolívar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mision.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="page-container">
        <div class="page-header">
            <img src="assets/img/principal.png" alt="Club Bolívar">
            <h1>Misión y Visión</h1>
        </div>

        <div class="page-content">
            <section class="content-section">
                <div class="section-header">
                    <h2>Nuestra Misión</h2>
                    <div class="header-line"></div>
                </div>
                <div class="section-body">
                    <p>Al ser una institución deportiva dedicada al fútbol profesional y otras disciplinas deportivas, debe fortificarse cada vez más para tener el equipo más competitivo del país y que pueda competir con éxito a nivel internacional, formar integralmente a deportistas de primer nivel, lograr más lauros, y hacer partícipe a la sociedad de sus proyectos y metas.</p>
                    <p>Entre los objetivos se apuntaba a consolidar el patrimonio deportivo adquirido y fortificarlo, alcanzar metas definidas, capaz de mantenerse con sus propios recursos y ser espejo y modelo de organización para las demás instituciones deportivas y sociales de Bolivia.</p>
                </div>
            </section>

            <section class="content-section">
                <div class="section-header">
                    <h2>Nuestra Visión</h2>
                    <div class="header-line"></div>
                </div>
                <div class="section-body">
                    <p>Bolívar debe mantener la insignia de institución referente en el plano deportivo nacional e internacional, reconocida por sus lauros, talentos deportivos, dirigentes de primer nivel e institución que contribuye al proceso de desarrollo e identidad del país.</p>
                    <p>Bolívar es la principal marca deportiva del país, referente de integración boliviana y orgullo para todos los que vivimos en este país.</p>
                </div>
            </section>

            <section class="content-section">
                <div class="section-header">
                    <h2>Objetivos Estratégicos</h2>
                    <div class="header-line"></div>
                </div>
                <div class="objectives-grid">
                    <div class="objective-card">
                        <h3>Competitividad</h3>
                        <p>Tener el equipo más competitivo del país con presencia a nivel internacional.</p>
                    </div>
                    <div class="objective-card">
                        <h3>Formación</h3>
                        <p>Formar integralmente a deportistas de primer nivel en nuestras categorías.</p>
                    </div>
                    <div class="objective-card">
                        <h3>Patrimonio</h3>
                        <p>Consolidar y fortalecer el patrimonio deportivo e institucional del Club.</p>
                    </div>
                    <div class="objective-card">
                        <h3>Sustentabilidad</h3>
                        <p>Mantener recursos propios que garanticen la sostenibilidad institucional.</p>
                    </div>
                </div>
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
