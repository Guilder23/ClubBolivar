<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
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
