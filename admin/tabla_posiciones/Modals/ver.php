<div class="equipo-view">
    <h3><?php echo htmlspecialchars($equipo['equipo']); ?></h3>
    
    <div class="equipo-stats">
        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-label">Posición</span>
                <span class="stat-value"><?php echo $equipo['posicion']; ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Puntos</span>
                <span class="stat-value"><?php echo $equipo['puntos']; ?></span>
            </div>
        </div>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-label">Partidos Jugados</span>
                <span class="stat-value"><?php echo $equipo['partidos_jugados']; ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Ganados</span>
                <span class="stat-value"><?php echo $equipo['partidos_ganados']; ?></span>
            </div>
        </div>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-label">Empatados</span>
                <span class="stat-value"><?php echo $equipo['partidos_empatados']; ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Perdidos</span>
                <span class="stat-value"><?php echo $equipo['partidos_perdidos']; ?></span>
            </div>
        </div>

        <div class="stat-row">
            <div class="stat-item">
                <span class="stat-label">Goles a Favor</span>
                <span class="stat-value"><?php echo $equipo['goles_favor']; ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Goles en Contra</span>
                <span class="stat-value"><?php echo $equipo['goles_contra']; ?></span>
            </div>
        </div>

        <div class="stat-row">
            <div class="stat-item full-width">
                <span class="stat-label">Diferencia de Goles</span>
                <span class="stat-value"><?php echo $equipo['diferencia_goles'] >= 0 ? '+' : ''; ?><?php echo $equipo['diferencia_goles']; ?></span>
            </div>
        </div>

        <div class="stat-row">
            <div class="stat-item full-width">
                <span class="stat-label">Estado</span>
                <span class="estado-badge estado-<?php echo strtolower($equipo['estado']); ?>"><?php echo ucfirst($equipo['estado']); ?></span>
            </div>
        </div>
    </div>

    <div class="modal-actions">
        <button class="btn-secondary" onclick="cerrarModalAdmin('modalVerEquipo')">Cerrar</button>
    </div>
</div>

<style>
.equipo-view {
    padding: 1rem;
}

.equipo-stats {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1rem 0;
}

.stat-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.stat-row.last {
    margin-bottom: 0;
}

.stat-item {
    background: #fff;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    border-left: 4px solid #5a7bb7;
}

.stat-item.full-width {
    grid-column: 1 / -1;
}

.stat-label {
    display: block;
    color: #5a7bb7;
    font-size: 0.85rem;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.stat-value {
    display: block;
    color: #1e3a5f;
    font-size: 1.8rem;
    font-weight: bold;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    justify-content: flex-end;
}
</style>