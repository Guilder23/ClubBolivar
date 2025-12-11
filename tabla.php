<?php
// Incluir configuración
require_once __DIR__ . '/config/database.php';

// Obtener tabla de posiciones de la base de datos
$tabla_posiciones = [];

if ($conn) {
    $query = "SELECT * FROM tabla_posiciones WHERE estado = 'publicado' ORDER BY puntos DESC, diferencia_goles DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tabla_posiciones[] = $row;
        }
    }
} else {
    // Datos de ejemplo si no hay conexión a BD
    $tabla_posiciones = [
        ['posicion' => 1, 'equipo' => 'Club Bolívar', 'partidos_jugados' => 5, 'partidos_ganados' => 4, 'partidos_empatados' => 1, 'partidos_perdidos' => 0, 'goles_favor' => 12, 'goles_contra' => 2, 'diferencia_goles' => 10, 'puntos' => 13, 'estado' => 'publicado'],
        ['posicion' => 2, 'equipo' => 'Strongest', 'partidos_jugados' => 5, 'partidos_ganados' => 3, 'partidos_empatados' => 2, 'partidos_perdidos' => 0, 'goles_favor' => 10, 'goles_contra' => 3, 'diferencia_goles' => 7, 'puntos' => 11, 'estado' => 'publicado'],
        ['posicion' => 3, 'equipo' => 'The Strongest', 'partidos_jugados' => 5, 'partidos_ganados' => 3, 'partidos_empatados' => 0, 'partidos_perdidos' => 2, 'goles_favor' => 9, 'goles_contra' => 5, 'diferencia_goles' => 4, 'puntos' => 9, 'estado' => 'publicado'],
        ['posicion' => 4, 'equipo' => 'Alianza', 'partidos_jugados' => 5, 'partidos_ganados' => 2, 'partidos_empatados' => 1, 'partidos_perdidos' => 2, 'goles_favor' => 8, 'goles_contra' => 7, 'diferencia_goles' => 1, 'puntos' => 7, 'estado' => 'publicado'],
        ['posicion' => 5, 'equipo' => 'Real Santa Cruz', 'partidos_jugados' => 5, 'partidos_ganados' => 1, 'partidos_empatados' => 0, 'partidos_perdidos' => 4, 'goles_favor' => 5, 'goles_contra' => 11, 'diferencia_goles' => -6, 'puntos' => 3, 'estado' => 'publicado'],
    ];
}
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
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $posicion = 1;
                    foreach($tabla_posiciones as $equipo): 
                    ?>
                    <tr>
                        <td><span class="position-badge"><?php echo $posicion; ?></span></td>
                        <td><strong><?php echo $equipo['equipo']; ?></strong></td>
                        <td><?php echo $equipo['partidos_jugados']; ?></td>
                        <td><?php echo $equipo['partidos_ganados']; ?></td>
                        <td><?php echo $equipo['partidos_empatados']; ?></td>
                        <td><?php echo $equipo['partidos_perdidos']; ?></td>
                        <td><?php echo $equipo['goles_favor']; ?></td>
                        <td><?php echo $equipo['goles_contra']; ?></td>
                        <td><?php echo ($equipo['diferencia_goles'] >= 0 ? '+' : '') . $equipo['diferencia_goles']; ?></td>
                        <td><strong><?php echo $equipo['puntos']; ?></strong></td>
                        <td>
                            <span class="estado-badge estado-<?php echo strtolower($equipo['estado']); ?>">
                                <?php echo ucfirst($equipo['estado']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php 
                        $posicion++;
                        endforeach; 
                        ?>
                </tbody>
            </table>
        </div>

        <a href="index.php" class="btn">← Volver al inicio</a>
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

    <script src="assets/js/tabla.js"></script>
</body>
</html>
