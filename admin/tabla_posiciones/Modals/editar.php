<form method="POST" action="?" class="admin-form" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, () => location.reload())">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id" value="<?php echo $equipo['id']; ?>">
    
    <div class="form-row">
        <div class="form-group">
            <label for="posicion">Posición:</label>
            <input type="number" id="posicion" name="posicion" min="1" value="<?php echo $equipo['posicion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="equipo">Nombre del Equipo:</label>
            <input type="text" id="equipo" name="equipo" value="<?php echo htmlspecialchars($equipo['equipo']); ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="partidos_jugados">Partidos Jugados:</label>
            <input type="number" id="partidos_jugados" name="partidos_jugados" min="0" value="<?php echo $equipo['partidos_jugados']; ?>" required>
        </div>
        <div class="form-group">
            <label for="partidos_ganados">Partidos Ganados:</label>
            <input type="number" id="partidos_ganados" name="partidos_ganados" min="0" value="<?php echo $equipo['partidos_ganados']; ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="partidos_empatados">Partidos Empatados:</label>
            <input type="number" id="partidos_empatados" name="partidos_empatados" min="0" value="<?php echo $equipo['partidos_empatados']; ?>" required>
        </div>
        <div class="form-group">
            <label for="partidos_perdidos">Partidos Perdidos:</label>
            <input type="number" id="partidos_perdidos" name="partidos_perdidos" min="0" value="<?php echo $equipo['partidos_perdidos']; ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="goles_favor">Goles a Favor:</label>
            <input type="number" id="goles_favor" name="goles_favor" min="0" value="<?php echo $equipo['goles_favor']; ?>" required>
        </div>
        <div class="form-group">
            <label for="goles_contra">Goles en Contra:</label>
            <input type="number" id="goles_contra" name="goles_contra" min="0" value="<?php echo $equipo['goles_contra']; ?>" required>
        </div>
    </div>

    <button type="submit" class="btn-primary">Actualizar Equipo</button>
</form>