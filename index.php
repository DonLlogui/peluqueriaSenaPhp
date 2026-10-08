<?php
/**
 * Redirección inteligente a la carpeta pública
 * Detecta automáticamente el nombre del proyecto
 */

// Obtener el nombre del proyecto desde la URL
$uri = $_SERVER['REQUEST_URI'];
$script = $_SERVER['SCRIPT_NAME'];

// Detectar la ruta base automáticamente
$base = dirname($script);
if ($base === '\\' || $base === '/') {
    $base = '';
}

// Redirigir a /public/
header('Location: ' . $base . '/public/', true, 301);
exit;