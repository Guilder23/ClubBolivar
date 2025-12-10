<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener tabla de posiciones (datos de ejemplo)
$tabla_posiciones = [
    ['equipo' => 'Club Bolívar', 'partidos' => 5, 'ganados' => 4, 'empatados' => 1, 'perdidos' => 0, 'gf' => 12, 'gc' => 2, 'diferencia_goles' => 10, 'puntos' => 13],
    ['equipo' => 'Strongest', 'partidos' => 5, 'ganados' => 3, 'empatados' => 2, 'perdidos' => 0, 'gf' => 10, 'gc' => 3, 'diferencia_goles' => 7, 'puntos' => 11],
    ['equipo' => 'The Strongest', 'partidos' => 5, 'ganados' => 3, 'empatados' => 0, 'perdidos' => 2, 'gf' => 9, 'gc' => 5, 'diferencia_goles' => 4, 'puntos' => 9],
    ['equipo' => 'Alianza', 'partidos' => 5, 'ganados' => 2, 'empatados' => 1, 'perdidos' => 2, 'gf' => 8, 'gc' => 7, 'diferencia_goles' => 1, 'puntos' => 7],
    ['equipo' => 'Real Santa Cruz', 'partidos' => 5, 'ganados' => 1, 'empatados' => 0, 'perdidos' => 4, 'gf' => 5, 'gc' => 11, 'diferencia_goles' => -6, 'puntos' => 3],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Posiciones - Club Bolívar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/tabla.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="section-content">
        <h1>Tabla de Posiciones</h1>
        <p style="text-align: center; font-size: 1.1rem; color: #718096; margin-bottom: 2rem;">Temporada 2025 - Liga Profesional Boliviana</p>

        <div class="standings-wrapper">
            <table class="standings-table">
                <thead>
                    <tr>
                        <th>Pos.</th>
                        <th>Equipo</th>
                        <th>PJ</th>
                        <th>G</th>
                        <th>E</th>
                        <th>P</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>DG</th>
                        <th>Pts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $pos = 1;
                    foreach($tabla_posiciones as $equipo): 
                    ?>
                    <tr>
                        <td><span class="position-badge"><?php echo $pos; ?></span></td>
                        <td><strong><?php echo $equipo['equipo']; ?></strong></td>
                        <td><?php echo $equipo['partidos']; ?></td>
                        <td><?php echo $equipo['ganados']; ?></td>
                        <td><?php echo $equipo['empatados']; ?></td>
                        <td><?php echo $equipo['perdidos']; ?></td>
                        <td><?php echo $equipo['gf']; ?></td>
                        <td><?php echo $equipo['gc']; ?></td>
                        <td><?php echo ($equipo['diferencia_goles'] >= 0 ? '+' : '') . $equipo['diferencia_goles']; ?></td>
                        <td><strong><?php echo $equipo['puntos']; ?></strong></td>
                    </tr>
                    <?php 
                        $pos++;
                        endforeach; 
                        ?>
                </tbody>
            </table>
        </div>

        <a href="index.php" class="btn">← Volver al inicio</a>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Club Bolívar</h3>
                <p>Institución deportiva referente del país.</p>
            </div>
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="mision.php">Misión</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 - Todos los derechos reservados Bolivar
        </div>
    </footer>

    <script src="assets/js/tabla.js"></script>
</body>
</html>
