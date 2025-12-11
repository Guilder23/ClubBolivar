<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia - Club Bolívar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/historia.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="section-content">
        <h1>La Historia</h1>
        <img src="assets/img/historia.jpg" alt="Historia" class="section-image">
        
        <h2>Club Bolívar: Una Historia de Gloria</h2>
        
        <p>La delantera de Bolívar campeón en 1958</p>
        
        <p>Ganarle a Litoral era una hazaña y nada menos por 3-0 en el partido definitorio. Era el 13 de mayo de 1951. Ambos concluyeron con 21 puntos, en un torneo que contaba con nueve equipos. Esa fue la primera estrella celeste en 1950.</p>

        <p>Litoral venía de ser el campeón amateur en 1947, 1948 y 1949, con un equipazo que era la base de la selección nacional y, en realidad, era el único equipo profesional, porque los dirigentes de la fabrica Soligno querían tener los mejores jugadores de Bolivia. Antonio "Guatón" Valencia, Gaffuri, Bustamante, Caparelli y Greco eran los pilares del equipo tricolor que llevaba los colores de la bandera italiana (verde, blanco y rojo).</p>

        <p>La fabrica Soligno contaba con 3.000 trabajadores, por tanto, Litoral tenía una de las barras más numerosas.</p>

        <p>Bolívar empezó con altibajos en el torneo y Unión Maestranza parecía encaminarse al título con victorias rutilantes para satisfacción de los viacheños y habitantes de El Alto que seguían a los rojinegros. Justamente, la victoria frente a Maestranza por 2-1 fue decisiva para que el equipo celeste, de camisas con botones, pantalón azul y medias grises, sumara 20 puntos igualando a Litoral.</p>

        <p>Para sorpresa de todos, en el partido definitorio del título, Bolívar se preparó rigurosamente y planteó un partido defensivo, pero en cada contragolpe que encabezaba Ugarte temblaba la portería de Gaffuri, que al final se llevó tres goles en la bolsa. Dos goles de Víctor Brown y uno de Mario Mena sellaron la victoria.</p>

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
