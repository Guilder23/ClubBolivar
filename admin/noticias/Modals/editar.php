<form method="POST" action="?" class="admin-form" enctype="multipart/form-data" onsubmit="event.preventDefault(); enviarFormularioAdmin(this, recargarTablaNoticias);">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">
    
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
    </div>

    <div class="form-group">
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <div class="preview-container">
            <?php if ($noticia['imagen']): ?>
                <img id="imagenPreview" src="/assets/img/noticias/<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="Imagen actual" class="imagen-preview">
            <?php else: ?>
                <div id="imagenPreview" class="imagen-preview-placeholder">Sin imagen</div>
            <?php endif; ?>
        </div>
        <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImagenEditar(event)">
        <small style="color: #718096;">JPG, PNG o GIF (máximo 5MB)</small>
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="borrador" <?php echo $noticia['estado'] === 'borrador' ? 'selected' : ''; ?>>Borrador</option>
            <option value="publicado" <?php echo $noticia['estado'] === 'publicado' ? 'selected' : ''; ?>>Publicado</option>
            <option value="cancelado" <?php echo $noticia['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
        </select>
    </div>

    <button type="submit" class="btn-primary">Actualizar Noticia</button>
</form>