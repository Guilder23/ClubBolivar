<div class="noticia-view">
    <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
    
    <div class="noticia-meta">
        <p><strong>Autor:</strong> <span id="autor"></span></p>
        <p><strong>Fecha:</strong> <?php echo date('d/m/Y H:i', strtotime($noticia['fecha_creacion'])); ?></p>
        <p><strong>Estado:</strong> <span class="estado-badge estado-<?php echo $noticia['estado']; ?>"><?php echo ucfirst($noticia['estado']); ?></span></p>
    </div>

    <div class="noticia-contenido">
        <?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?>
    </div>

    <div class="modal-actions">
        <button class="btn-primary" onclick="abrirModalAdmin('modalEditarNoticia', 'editar', <?php echo $noticia['id']; ?>); cerrarModalAdmin('modalVerNoticia');">Editar</button>
        <button class="btn-secondary" onclick="cerrarModalAdmin('modalVerNoticia')">Cerrar</button>
    </div>
</div>

<style>
.noticia-view {
    padding: 1rem;
}

.noticia-meta {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
    font-size: 0.9rem;
}

.noticia-meta p {
    margin: 0.5rem 0;
}

.noticia-contenido {
    background: #fff;
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1rem 0;
    line-height: 1.8;
    color: #333;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    justify-content: flex-end;
}
</style>