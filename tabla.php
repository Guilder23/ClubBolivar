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

    <main class="page-container">
        <div class="page-header">
            <h1>Tabla de Posiciones</h1>
            <p class="subtitle">Temporada 2025 - Liga Profesional Boliviana</p>
        </div>

        <div class="page-content">
            <section class="table-section">
                <table class="standings-table">
                    <thead>
                        <tr>
                            <th class="pos">Pos.</th>
                            <th class="team">Equipo</th>
                            <th class="stat">PJ</th>
                            <th class="stat">G</th>
                            <th class="stat">E</th>
                            <th class="stat">P</th>
                            <th class="stat">GF</th>
                            <th class="stat">GC</th>
                            <th class="stat">DG</th>
                            <th class="stat points">Pts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $pos = 1;
                        foreach($tabla_posiciones as $equipo): 
                            $clase_fila = '';
                            if ($pos == 1) $clase_fila = 'lider';
                            elseif ($pos <= 4) $clase_fila = 'clasificado';
                            elseif ($pos >= 10) $clase_fila = 'descendencia';
                        ?>
                        <tr class="<?php echo $clase_fila; ?>">
                            <td class="pos"><strong><?php echo $pos; ?></strong></td>
                            <td class="team"><?php echo $equipo['equipo']; ?></td>
                            <td class="stat"><?php echo $equipo['partidos']; ?></td>
                            <td class="stat"><?php echo $equipo['ganados']; ?></td>
                            <td class="stat"><?php echo $equipo['empatados']; ?></td>
                            <td class="stat"><?php echo $equipo['perdidos']; ?></td>
                            <td class="stat"><?php echo $equipo['gf']; ?></td>
                            <td class="stat"><?php echo $equipo['gc']; ?></td>
                            <td class="stat"><?php echo ($equipo['diferencia_goles'] >= 0 ? '+' : '') . $equipo['diferencia_goles']; ?></td>
                            <td class="stat points"><strong><?php echo $equipo['puntos']; ?></strong></td>
                        </tr>
                        <?php 
                        $pos++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>

                <div class="table-legend">
                    <div class="legend-item lider">Líder</div>
                    <div class="legend-item clasificado">Clasificado a Copa</div>
                    <div class="legend-item descendencia">Zona de Descenso</div>
                </div>
            </section>

            <section class="info-section">
                <h2>Información de la Temporada</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <h3>Formato</h3>
                        <p>Liga Profesional Boliviana - Torneo de todos contra todos</p>
                    </div>
                    <div class="info-card">
                        <h3>Puntuación</h3>
                        <p>Victoria: 3 puntos | Empate: 1 punto | Derrota: 0 puntos</p>
                    </div>
                    <div class="info-card">
                        <h3>Criterio de Desempate</h3>
                        <p>1. Puntos | 2. Diferencia de Goles | 3. Goles a Favor</p>
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
                    <li><a href="mision.php">Misión</a></li>
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
