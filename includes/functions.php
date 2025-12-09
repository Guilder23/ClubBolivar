<?php
// ===== ARCHIVO DE FUNCIONES GLOBALES =====
// Este archivo simplemente incluye config/database.php que contiene todas las funciones

// Incluir la configuración y funciones de la BD
if (!defined('DB_HOST')) {
    require_once __DIR__ . '/../config/database.php';
}
?>
